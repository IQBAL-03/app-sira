<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\DueController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Complaints
    Route::get('/complaints', [ComplaintController::class, 'index']);
    Route::get('/complaints/{id}', [ComplaintController::class, 'show']);
    Route::post('/complaints', [ComplaintController::class, 'store']);
    
    // Letters
    Route::get('/letters', [LetterRequestController::class, 'index']);
    Route::get('/letters/{id}', [LetterRequestController::class, 'show']);
    Route::post('/letters', [LetterRequestController::class, 'store']);
    
    // Dues
    Route::get('/dues', [DueController::class, 'index']);
    Route::get('/dues/{id}', [DueController::class, 'show']);
    Route::post('/dues', [DueController::class, 'store']);

    // Admin Only Routes
    Route::middleware('role:admin')->group(function () {
        // Complaints Management
        Route::put('/complaints/{id}', [ComplaintController::class, 'update']);
        Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy']);
        
        // Letters Management
        Route::put('/letters/{id}', [LetterRequestController::class, 'update']);
        Route::delete('/letters/{id}', [LetterRequestController::class, 'destroy']);
        
        // Dues Management
        Route::put('/dues/{id}', [DueController::class, 'update']);
        Route::delete('/dues/{id}', [DueController::class, 'destroy']);
    });
});