<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\SeanceInterface;
use App\Repository\ClassRepository\SeanceRepository;
use App\Repository\Interface\FilmInterface;  // Import FilmInterface
use App\Repository\ClassRepository\FilmRepository; // Import FilmRepository

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind SeanceInterface to SeanceRepository
        $this->app->bind(SeanceInterface::class, SeanceRepository::class);

        // Bind FilmInterface to FilmRepository
        $this->app->bind(FilmInterface::class, FilmRepository::class);
    }

    public function boot()
    {
        //
    }
}
