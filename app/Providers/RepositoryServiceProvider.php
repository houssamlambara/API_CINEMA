<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\FilmInterface;
use App\Repository\ClassRepository\FilmRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Enregistre les bindings dans le container.
     */
    public function register()
    {
        $this->app->bind(FilmInterface::class, FilmRepository::class);
    }

    /**
     * Bootstrap les services.
     */
    public function boot()
    {
        //
    }
}
