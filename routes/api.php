<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WisataController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function () {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/wisata', [WisataController::class, 'index']);
    Route::get('/wisata/{id}', [WisataController::class, 'show']);
    Route::post('/wisata', [WisataController::class, 'store']);
    Route::put('/wisata/{id}', [WisataController::class, 'update']);
    Route::delete('/wisata/{id}', [WisataController::class, 'destroy']);
});