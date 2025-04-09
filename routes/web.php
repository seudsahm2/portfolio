<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController; // Add this
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContactController;

Route::get('/', [PortfolioController::class, 'index'])->name('welcome'); // Updated
// Contact Form Route
Route::post('/contact', [UserContactController::class, 'storeContact'])->name('contact.save');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';