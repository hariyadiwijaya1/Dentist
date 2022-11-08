<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;

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

/* ROUTE CART */
Route::get('carts/{cart}',[CartController::class,'show']);
Route::post('carts', [CartController::class,'store']);
Route::put('carts/{cart}', [CartController::class,'update']);
Route::delete('carts/{cart}', [CartController::class,'destroy']);

/* ROUTE TRANSACTION */
Route::get('transactions', [TransactionController::class,'index']);
Route::post('transactions', [TransactionController::class,'store']);
Route::delete('transactions/{transaction}', [TransactionController::class,'destroy']);
Route::put('transactions/{transaction}', [TransactionController::class,'update']);
Route::get('transactions/{id}',[TransactionController::class,'show']);

