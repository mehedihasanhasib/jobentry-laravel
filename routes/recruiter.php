<?php

use Illuminate\Support\Facades\Route;

Route::domain('recruiter.localhost')->group(function () {
    Route::name('recruiter.')->group(function () {
        Route::get('/', function () {
            return view('recruiter.dashboard.index');
        })->name('dashboard');

        Route::get('/about', function () {
            echo "<h1>About Page</h1>";
        })->name('about');
    });
});
