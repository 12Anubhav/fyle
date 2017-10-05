<?php

namespace App\app\Http\Controllers\BackendModel;

use Illuminate\Database\Eloquent\Model;
use DB;

class branches extends Model
{
    protected $table = "branches";
    public $id;
    public $ifsc;
    public $bank_ids = array();
    public $city;
    public $district;
    public $state;

    public function __construct( $array = array() )
    {
        
            $this->ifsc = array_key_exists("ifsc" , $array) ? strtoupper(trim($array['ifsc'])) : null;
            $this->bank_ids = array_key_exists("bank_id" , $array) ? ($array['bank_id']) : null;
            $this->city = array_key_exists("city" , $array) ? (trim($array['city'])) : null;
            $this->district = array_key_exists("district" , $array) ? (trim($array['district'])) : null;
            $this->state = array_key_exists("state" , $array) ? (trim($array['state'])) : null;
    }


    public function getBankDetailFromIfsc()
    {
        if( $this->ifsc != NULL ){
            try{
                $bankDetailResponse = DB::table($this->table)
                    ->select('*')
                    ->where('ifsc','=',$this->ifsc)->get();
                if( count( $bankDetailResponse ) > 0 )
                    return $bankDetailResponse;
                else
                    return "no data found";
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }

        }else{
            throw new \Exception("Ifsc code not found");
        }
    }

    public function getData(){

        try{

            $dataResponse = DB::table($this->table);
            if( $this->ifsc )
                $dataResponse->where('ifsc','=',$this->ifsc);
            if( count( bank_ids ) > 0 )
                $dataResponse->where('ifsc','=',$this->ifsc);


        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }


    }
}
