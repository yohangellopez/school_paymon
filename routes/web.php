<?php

use App\Http\Controllers\Dashboard\CommunicationController;
use App\Http\Controllers\Dashboard\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AcademyController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\RepresentativeController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\HomeController;



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
      
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware([
    'auth'
])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/home', [DashboardHomeController::class, 'index'])->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])->name('user.index');

        Route::get('/academies', [AcademyController::class, 'index'])->name('academy.index');

        Route::get('/students', [StudentController::class, 'index'])->name('student.index');

        Route::get('/representatives', [RepresentativeController::class, 'index'])->name('representative.index');
        
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollment.index');
        
        Route::get('/communications', [CommunicationController::class, 'index'])->name('communication.index');

    });
});

require __DIR__.'/auth.php';
