<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticatedRecruiter;
use App\Http\Controllers\Recruiter\Auth\LoginController;
use App\Http\Controllers\Recruiter\Auth\RegistrationController;
use App\Http\Controllers\Recruiter\RecruiterDashboardController;
use App\Http\Controllers\Recruiter\RecruiterJobsController;

Route::domain('recruiter.localhost')->group(function () {
    Route::name('recruiter.')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store'])->name('login');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::get('/signup', [RegistrationController::class, 'create'])->name('register');
        Route::post('/signup', [RegistrationController::class, 'store'])->name('register');

        Route::middleware([AuthenticatedRecruiter::class])->group(function () {
            Route::get('/', [RecruiterDashboardController::class, 'index'])->name('dashboard');

            Route::get('/jobs', [RecruiterJobsController::class, 'index'])->name('jobs');
            Route::get('/jobs/create', [RecruiterJobsController::class, 'create'])->name('jobs.create');
            Route::post('/jobs/store', [RecruiterJobsController::class, 'store'])->name('jobs.store');
        });
    });
});
