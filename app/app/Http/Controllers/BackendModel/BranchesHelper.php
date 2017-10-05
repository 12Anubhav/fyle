<?php

namespace App\app\Http\Controllers\BackendModel;

use Illuminate\Database\Eloquent\Model;
use DB;

class BranchesHelper extends Model
{
    public static function getBranchDetailFromIfsc($ifscCode)
    {
        try{

            $response = DB::table('branches as br')
                ->join('banks as bn','bn.id','=','br.bank_id')
                ->select('bn.name' , 'br.branch' , 'br.address' , 'br.city' , 'br.district' , 'br.state')
                ->where('br.ifsc','=',$ifscCode)->get();

            return $response;

        }catch(\Exception $e){
            // log error message $e->getMessage();

        }
    }
    
    public static function getBranchDetails( $array = array() ){
        try{

            $page = array_key_exists("page" , $array) ? $array['page'] : 1;
            $items_per_page = array_key_exists("item_per_page" , $array) ? $array['item_per_page'] : 20;
            $offset = ($page - 1) * $items_per_page;

            $ifsc = array_key_exists("ifsc" , $array) ? $array['ifsc'] : null;
            $bankName = array_key_exists("bankName" , $array) ? $array['bankName'] : null;
            $city = array_key_exists("city" , $array) ? $array['city'] : null;

            if($ifsc == null && $bankName == null && $city == null)
                return ['totalRows' => 0 , 'data' => 'No Input Received'];

            $response = DB::table('branches as br')
                ->join('banks as bn','bn.id','=','br.bank_id')
                ->select('bn.name' , 'br.branch' , 'br.address' , 'br.city' , 'br.district' , 'br.state');


            if( $ifsc != NULL  ){
                $response->where('br.ifsc','=',$ifsc);
            } else {
                if( $bankName != NULL )
                    $response->where('bn.name','like','%'.$bankName.'%');
                if( $city != NULL )
                    $response->where('br.city','like','%'.$city.'%');
            }

            $totalRows = $response->count();
            $result = $response->skip($offset)->take($items_per_page)->get();

            return ['totalRows' => $totalRows , 'data' => $result];

        }catch(\Exception $e){
            // log exception $e->getMeesage();
           // print_r($e->getMessage());
            return false;
        }
    }
    
}
