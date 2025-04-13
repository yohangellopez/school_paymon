<?php

use App\Http\Controllers\Api\AcademyController;
use App\Http\Controllers\Api\CommunicationController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Academies & Courses CRUD
    Route::apiResource('academies', AcademyController::class);
    Route::apiResource('courses', CourseController::class); // Added
    
    // Enrollments & Payments
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::apiResource('payments', PaymentController::class);
    
    // Communications
    Route::post('communications/send', [CommunicationController::class, 'send']);
    Route::apiResource('communications', CommunicationController::class);
});