<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\SparepartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/profile', [AuthenticationController::class, 'profile']);
    Route::patch('/profile/update', [AuthenticationController::class, 'updateProfile']);
});



Route::middleware(['auth:sanctum'])->group(function(){
    //service
    Route::post('/service/create', [ServiceController::class, 'create']);
    Route::get('/service/show/user', [ServiceController::class, 'showByUser']);
    Route::get('/service/show/tanggal', [ServiceController::class, 'showByTanggal']);
    Route::delete('/service/delete/{id}', [ServiceController::class, 'delete']);


    //Sparepart
    Route::post('/sparepart/create', [SparepartController::class, 'create']);
    Route::get('/sparepart/get', [SparepartController::class, 'get']);
    Route::get('/sparepart/search/{name}', [SparepartController::class, 'searchSparepart']);
    Route::patch('/sparepart/update/{id}', [SparepartController::class, 'update']);
    Route::delete('/sparepart/delete/{id}', [SparepartController::class, 'delete']);
});