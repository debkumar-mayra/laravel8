<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

Route::group(['namespace' => 'Api'], function () {
    Route::post("register", [AuthController::class, 'register']);
    Route::post("login", [AuthController::class, 'login']);
	Route::get('unauthorised',[AuthController::class, 'unauthorised'])->name('api.unauthorised');


    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get("profile", [AuthController::class, 'profile']);
        Route::get("logout", [AuthController::class, 'logout']);
    
    });


});


