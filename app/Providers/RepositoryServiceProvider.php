<?php

namespace App\Providers;

use App\Repository\MRD\MrdRepository;
use App\Repository\MRD\EloquentMrdRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MrdRepository::class, EloquentMrdRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
