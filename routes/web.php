<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContactController;

Route::get('/', [PortfolioController::class, 'index'])->name('welcome');

// Contact Form Route
Route::post('/contact', [UserContactController::class, 'storeContact'])->name('contact.save');
Route::get('/experiences', [PortfolioController::class, 'allExperiences'])->name('experiences.all');
Route::get('/trainings', [PortfolioController::class, 'allTrainings'])->name('trainings.all');

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include admin routes
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';