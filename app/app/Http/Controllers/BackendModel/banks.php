<?php

namespace App\app\Http\Controllers\BackendModel;

use Illuminate\Database\Eloquent\Model;
use DB;

class banks extends Model
{
    protected $table = "banks";
    public $id;
    public $name;
    
    public function __construct( $array = array() )
    {
            $this->id = array_key_exists("id" , $array) ? trim($array['id']) : null;
            $this->name = array_key_exists("bankName" , $array) ? (trim($array['bankName'])) : null;
    }
    
    public function getbankIdFromName(){
        if( $this->name != NULL ){
            $response = array();
            try{
                $bankIdResponse = DB::table($this->table)
                    ->select('*')
                    ->where('name','like','%'.$this->name.'%')->get();
                
                if( count( $bankIdResponse ) > 0 ){
                    foreach( $bankIdResponse as $data )
                        $response[$data->id] = $data->name;
                }
                
                return $response;
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }else{
            throw new \Exception("Bank Name Not Found");
        }
    }
}
