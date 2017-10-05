<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {

    return view('welcome');
});

Route::get('callStack', function() {
    $master = new \App\Http\Controllers\code\CallStack();
    $createJobs = $master->callStack();
    return $createJobs;
});


Route::get('sample-restful-apis', function()
{
    return array(
        1 => "expertphp",
        2 => "demo"
    );
});

Route::group(array('prefix' => 'api'), function() {
    //Route::resource('details',['uses' => 'APIController@create' , 'as' => 'name']);
    Route::get('ifscCode/{id}',['uses' => 'APIController@getDetails' , 'as' => 'name']);
    Route::get('branchDetails',['uses' => 'APIController@getDetails' , 'as' => 'name']);
    //Route::get('foo', ['uses' => 'FooController@method', 'as' => 'name']);
});
