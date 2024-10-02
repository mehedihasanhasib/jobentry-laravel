<?php

use App\Http\Middleware\AuthenticatedRecruiter;
use Illuminate\Support\Facades\Route;

Route::domain('recruiter.localhost')->group(function () {
    Route::middleware([AuthenticatedRecruiter::class])->group(function(){
        Route::name('recruiter.')->group(function () {
            Route::get('/', function () {
                return view('recruiter.dashboard.index');
            })->name('dashboard');
        });
    });
});
