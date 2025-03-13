<?php
require __DIR__.'/admin.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;

Route::get('/', [PortfolioController::class, 'index']);
Route::get('/portfolio-details', [PortfolioController::class, 'portfolioDetails']);
Route::get('/service-details', [PortfolioController::class, 'serviceDetails']);

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [PortfolioController::class, 'storeContact'])->name('contact.store');