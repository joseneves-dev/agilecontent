<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->prefix('users')->group(function () {
    Route::get('{id}', [Controller::class, 'show']);
    Route::put('{id}', [Controller::class, 'update']);
    Route::delete('{id}', [Controller::class, 'destroy']);
});
