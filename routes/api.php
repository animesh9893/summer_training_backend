<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Youtube;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: *' );


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("/test",[Youtube::class,"test"]);
Route::get("/test",[Youtube::class,"test"]);

Route::get('/data',[Youtube::class,"getData"]);
Route::post('/data',[Youtube::class,"getData"]);
