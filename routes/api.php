<?php

use App\Http\Controllers\OptionController;
use App\Http\Controllers\PatientAnswerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RangeController;
use App\Http\Controllers\ResultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('quiz', QuizController::class);
Route::apiResource('question', QuestionController::class);
Route::apiResource('option', OptionController::class);
Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
Route::post('/quizzes/{quiz}/{patient}/patient-answers', [PatientAnswerController::class, 'storeMany'])
    ->name('patientAnswer.store');
Route::get('/quizzes/{quiz}/{patient}/result', [PatientAnswerController::class, 'shows']);
Route::post('/quiz/{quiz}/range', [RangeController::class, 'store']);
// Route::apiResource('/quiz/{quiz}', ResultController::class);