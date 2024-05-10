<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthenticationController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function(){
    //service
    Route::post('/service/create', [ServiceController::class, 'createService']);
    Route::get('/service/get/user', [ServiceController::class, 'getUser']);
    Route::get('/service/get/tanggal', [ServiceController::class, 'getTanggal']);
});