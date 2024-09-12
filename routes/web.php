<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobsController;
use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Front\EducationController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\TrainingController;

require __DIR__ . '/recruiter.php';
require __DIR__ . '/admin.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.us');



Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::prefix('/profile')->group(function(){
        Route::name('user.profile.')->group(function(){
            Route::get('/personal', [ProfileController::class, 'personal_information'])->name('personal');
            Route::post('/personal/update', [ProfileController::class, 'personal_information_update'])->name('personal.update');

            Route::get('/education', [EducationController::class, 'index'])->name('education');
            Route::post('/education/update', [EducationController::class, 'update'])->name('education.update');

            Route::get('/training', [TrainingController::class, 'index'])->name('training');
        });
    });
});



Route::get('/dashboard', function () {
    return redirect()->route('profile');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
