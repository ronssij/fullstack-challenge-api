<?php

namespace App\Providers;

use App\Support\Weather\Contracts\WeatherInterface;
use App\Support\Weather\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherInterface::class, fn () => new WeatherService());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('limit', function ($perPage = 100) {
            return (int) request()->input('per_page', request()->input('limit', $perPage));
        });
    }
}
