<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\APIs\AdminApisController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//api routes backend
Route::get('/zepto-apps/login',[AdminApisController::class,'doLogin']);
Route::post('/zepto-apps/registration',[AdminApisController::class,'registration']);
Route::get('/zepto-apps/get-datas',[AdminApisController::class,'getData']);
Route::post('/zepto-apps/delete/{id}',[AdminApisController::class,'deleteData']);
Route::post('/zepto-apps/update/{id}',[AdminApisController::class,'updateData']);
Route::get('/zepto-apps/search',[AdminApisController::class,'searchData']);

