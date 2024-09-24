<?php

use Illuminate\Support\Facades\Route;

Route::domain('admin.localhost')->group(function(){
    Route::get('/', function(){
        echo "<h1>Admin Page</h1>";
    });
});