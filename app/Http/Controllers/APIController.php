<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\app\Http\Controllers\BackendModel\branches;
use App\app\Http\Controllers\BackendModel\banks;
use App\app\Http\Controllers\BackendModel\BranchesHelper;
use DB;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }
    /*
     * function takes
     * ifsc , bankName , city and page as input parameters
     * IF IFSC is mentioned other filters are not required , if mentioned will be discarded
     * if page=number is not mentioned by default first page data will be displayed
     * By Default 20 is the limit for data display
     *
     * */
    public function getDetails(Request $request){

        try{

            $searchArray = array();
            
            if(  strpos("ifscCode" , $request->getRequestUri()) === false  ){
                $searchArray['ifsc'] = $request->route('id');
            }else{
                $searchArray['ifsc'] = $request->has('ifsc') ? $request->ifsc : null;
            }

            $searchArray['bankName'] = $request->has('bankName') ? $request->bankName : null;
            $searchArray['city'] = $request->has('city') ? $request->city : null;
            $currentPage = $request->has('page') ? (int)$request->page : 1;
            $searchArray['item_per_page'] = 20;
            $searchArray['page'] = $currentPage;
            
            $allDetails = BranchesHelper::getBranchDetails($searchArray);
            if( count( $allDetails) > 0 ){
                return response($this->responseData(true , $allDetails , 200) , 200);
            }else {
                return response($this->responseData(false , 'No Data Found' , 401) , 200);
            }

        }catch(\Exception $e){
            
            return response($this->responseData(false , 'Some Error Occurred' , 404) , 500);
        }

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function responseData($success = true , $data , $statusCode)
    {
        return ["message" => $success , "status" => $statusCode  ,"data" => $data ];
    }
}
