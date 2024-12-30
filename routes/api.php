<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('show', [UserController::class, 'show']);
    
    Route::put('update', [UserController::class, 'update']);
    
    Route::delete('delete', [UserController::class, 'destroy']);
});