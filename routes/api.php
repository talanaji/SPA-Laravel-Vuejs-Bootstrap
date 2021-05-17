<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
 

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/createpost','App\Http\Controllers\PostController@createpost');
Route::post('/updatepost/{postid}','App\Http\Controllers\PostController@updatepost');
Route::get('/getposts','App\Http\Controllers\PostController@getposts');