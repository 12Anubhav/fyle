<?php

namespace App\Http\Controllers\code;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Stack extends Controller
{
    protected $stack;
    protected $limit;
    protected $stackLimit;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct($limit = 10)
    {
        // here stack will be stored in a string with delimiter -:- as array and object cannot be used
        $this->stack = '';
        $this->limit = $limit;
        $this->checkStackLimit();
    }

    public function checkStackLimit()
    {
        $stringCount = explode("-:-" , $this->stack);
        if( count( $stringCount ) > $this->limit ){
            return true;
        } else {
            return false;
        }
    }

    public function push($item)
    {
        if( $this->checkStackLimit() == false ){
            $this->stack .= $item."-:-";
        } else {
            throw new \Exception('Stack is full!');
        }
    }

    public function index()
    {
        //
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
}
