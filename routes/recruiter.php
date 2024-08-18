<?php

use Illuminate\Support\Facades\Route;

Route::domain('recruiter.jobentry.com')->group(function(){
    Route::get('/', function(){
        echo "<h1>Recruiter Page</h1>";
    });
});