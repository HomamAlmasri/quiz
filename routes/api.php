<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('quiz',QuizController::class);
Route::apiResource('question',QuestionController::class);