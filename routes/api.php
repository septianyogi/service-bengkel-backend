<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SparepartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
Route::post('/register', [AuthenticationController::class, 'register']);
Route::get('/profile/{id}', [AuthenticationController::class, 'profile']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    // Route::get('/profile/{id}', [AuthenticationController::class, 'profile']);
    Route::patch('/profile/update', [AuthenticationController::class, 'updateProfile']);

    //category
    Route::get('/category', [CategoryController::class, 'get']);
    Route::post('/category/add', [CategoryController::class, 'add']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete']);
    
});

Route::middleware(['auth:sanctum'])->group(function(){

    //mobil
    Route::post('/car/add', [CarController::class, 'add']);
    Route::get('/car/get', [CarController::class, 'get']);


    //service
    Route::post('/service/create', [ServiceController::class, 'create']);
    Route::get('/service/show/user/{id}', [ServiceController::class, 'showByUser']);
    Route::get('/service/show/all', [ServiceController::class, 'showByTanggal']);
    Route::patch('/service/updateStatus/{id}', [ServiceController::class, 'updateStatus']);
    Route::delete('/service/delete/{id}', [ServiceController::class, 'delete']);


    //Sparepart
    Route::post('/sparepart/create', [SparepartController::class, 'create']);
    // Route::patch('/sparepart/addStock/{id}', [SparepartController::class, 'addStock']);
    Route::get('/sparepart/get', [SparepartController::class, 'get']);
    Route::get('/sparepart/search/{name}', [SparepartController::class, 'searchSparepart']);
    Route::patch('/sparepart/update/{id}', [SparepartController::class, 'update']);
    Route::delete('/sparepart/delete/{id}', [SparepartController::class, 'delete']);


    //Penjualan
    Route::get('/order/getAll', [OrderController::class, 'getAll']);
    ROute::get('/order/getByUser', [OrderController::class, 'getByUser']);
    Route::post('/order/create/{id}', [OrderController::class, 'createOrder']);
    Route::post('/order/pembayaran/{id}', [OrderController::class, 'pembayaran']);
    Route::patch('/order/konfirmasi/{id}', [OrderController::class, 'konfirmasi']);
    Route::delete('/order/delete/{id}', [OrderController::class, 'delete']);
});