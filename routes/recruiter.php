<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticatedRecruiter;
use App\Http\Controllers\Recruiter\Auth\LoginController;
use App\Http\Controllers\Recruiter\Auth\RegistrationController;

Route::domain('recruiter.localhost')->group(function () {
    Route::name('recruiter.')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::get('/signup', [RegistrationController::class, 'create'])->name('register');
        Route::post('/signup', [RegistrationController::class, 'store'])->name('register');

        Route::middleware([AuthenticatedRecruiter::class])->group(function () {
            Route::get('/', function () {
                return view('recruiter.dashboard.index');
            })->name('dashboard');
        });
    });
});
