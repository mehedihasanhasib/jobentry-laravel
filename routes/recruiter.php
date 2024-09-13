<?php

use Illuminate\Support\Facades\Route;

Route::domain('recruiter.jobentry.com')->group(function () {
    Route::name('recruiter.')->group(function () {
        Route::get('/', function () {
            echo "<h1>Recruiter Page</h1>";
        })->name('dashboard');

        Route::get('/about', function () {
            echo "<h1>About Page</h1>";
        })->name('about');
    });
});
