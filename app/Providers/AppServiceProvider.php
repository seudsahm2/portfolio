<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\About;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LoginAdminActionsMiddleware;
use Illuminate\Support\Facades\Route;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('admin', AdminMiddleware::class);
        Route::aliasMiddleware('log_admin',LoginAdminActionsMiddleware::class);
        // Bind $about to the header every time it's rendered
        View::composer('partials.header', function ($view) {
            $about = About::first(); // Fetch the first About record
            $view->with('about', $about); // Pass it to the view
        });
    }
}
