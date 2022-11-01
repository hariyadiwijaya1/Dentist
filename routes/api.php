<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [AuthController::class,'logout']);
    Route::middleware('Admin')->group(function () {
        //isina naon ajg
    });
});

/* BUAT AUTHENTICATION */
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);

/* ROUTE DOCTOR */
Route::get('doctors', [DoctorController::class,'index']);
Route::post('doctors', [DoctorController::class,'store']);
Route::delete('doctors/{doctor}', [DoctorController::class,'destroy']);
Route::put('doctors/{doctor}', [DoctorController::class,'update']);
Route::get('doctors/{doctor}',[DoctorController::class,'show']);


/* ROUTE PRODUCT */
Route::get('products', [ProductController::class,'index']);
Route::post('products', [ProductController::class,'store']);
Route::delete('products/{product}', [ProductController::class,'destroy']);
Route::put('products/{product}', [ProductController::class,'update']);
Route::get('products/{product}',[ProductController::class,'show']);
// Route::post('login', 'AuthController@login');
