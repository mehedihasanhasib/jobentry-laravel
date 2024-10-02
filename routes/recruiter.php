<?php

use App\Http\Controllers\Recruiter\LoginController;
use App\Http\Controllers\Recruiter\RegistrationController;
use App\Http\Middleware\AuthenticatedRecruiter;
use Illuminate\Support\Facades\Route;

Route::domain('recruiter.localhost')->group(function () {
    Route::name('recruiter.')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::get('/signup', [RegistrationController::class, 'create'])->name('register');

        Route::middleware([AuthenticatedRecruiter::class])->group(function () {
            Route::get('/', function () {
                return view('recruiter.dashboard.index');
            })->name('dashboard');
        });
    });
});
