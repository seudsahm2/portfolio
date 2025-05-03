<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\About;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\RestrictIPMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Console\Commands\GenerateSitemap; 
use Illuminate\Console\Application as Artisan;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSitemap::class,
            ]);
        }
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        // Bind $about to the header every time it's rendered
        View::composer('partials.header', function ($view) {
            $about = About::first(); // Fetch the first About record
            $view->with('about', $about); // Pass it to the view
        });
    }
}
