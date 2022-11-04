<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::apiResource('contact',\App\Http\Controllers\ContactController::class);

Route::post('/register',[ApiAuthController::class,'register']);
Route::post('/login',[ApiAuthController::class,'login']);
Route::post('/logout',[ApiAuthController::class,'logout'])->middleware('auth:sanctum');
