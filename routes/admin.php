<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\Professions;

// Secure admin routes with middleware
Route::prefix('secure-admin-panel')->middleware(['auth', 'admin', 'log_admin', 'throttle:30,1'])->group(function () {
    Route::resource('hero', HeroController::class);
    Route::resource('about', AboutController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('resume', ResumeController::class);
    Route::resource('skill', SkillController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('education', EducationController::class);
    Route::resource('professions', Professions::class);
});
