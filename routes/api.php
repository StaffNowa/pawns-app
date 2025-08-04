<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profiling-questions', [ProfileController::class, 'getQuestions']);
    Route::get('/wallet', [WalletController::class, 'getWallet']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
    Route::post('/claim', [PointsController::class, 'claimPoints']);
});
