<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MovieDBService;
class MovieDBServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MovieDBService::class, function ($app) {
            return new MovieDBService(
                uri: config('services.moviedb.uri'),
                api_key: config('services.moviedb.api_key'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}