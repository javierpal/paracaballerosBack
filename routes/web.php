<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, If-Modified-Since, Cache-Control, Pragma, X-XSRF-TOKEN");

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getNews','BackEndController@getNews');
Route::get('/getTendencia','BackEndController@getTendencia');
Route::get('/getLeftNews','BackEndController@getLeftNews');
Route::get('/getNoticia','BackEndController@getNoticia');
Route::get('/Autenticate','BackEndController@Autenticate');
Route::get('/findAdmin','BackEndController@findAdmin');
Route::post('/uploadFile','BackEndController@uploadFile');