<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobsController;
use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Front\ProfileController;


require __DIR__ . '/recruiter.php';
require __DIR__ . '/admin.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.us');


Route::prefix('/profile')->group(function(){
    Route::name('user.profile.')->group(function(){
        Route::get('/personal', [ProfileController::class, 'personal_information'])->name('personal');
        Route::get('/education', [ProfileController::class, 'education_information'])->name('education');
    });
});

Route::get('/test', function(){
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
