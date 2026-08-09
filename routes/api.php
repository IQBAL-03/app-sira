<?php
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\DueController;

Route::apiResource('complaints', ComplaintController::class);
Route::apiResource('letters', LetterRequestController::class);
Route::apiResource('dues', DueController::class);
?>