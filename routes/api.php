<?php

use App\Http\Controllers\ApplicantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'throttle:60,1', 'company.filter'])->group(function () {
    Route::get('/applicants', [ApplicantController::class, 'index']);
    Route::get('/applicants/{id}', [ApplicantController::class, 'show']);
    Route::post('/applicants', [ApplicantController::class, 'store']);
    Route::put('/applicants/{id}', [ApplicantController::class, 'update']);
    Route::delete('/applicants/{id}', [ApplicantController::class, 'destroy']);
    Route::get('/applicants/download-cv/{id}', [ApplicantController::class, 'downloadCV']);
});
