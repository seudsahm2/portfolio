<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PortfolioController;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('about', AboutController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('resume', ResumeController::class);
    Route::resource('skill', SkillController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('portfolio', PortfolioController::class);
});