<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\ReservationInterface;
use App\Repository\ClassRepository\ReservationRepository;
use App\Repository\Interface\SeanceInterface;
use App\Repository\ClassRepository\SeanceRepository;
use App\Repository\Interface\FilmInterface;  
use App\Repository\ClassRepository\FilmRepository; 

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Lier l'interface SeanceInterface à SeanceRepository
        $this->app->bind(SeanceInterface::class, SeanceRepository::class);

        // Lier l'interface FilmInterface à FilmRepository
        $this->app->bind(FilmInterface::class, FilmRepository::class);

        // Lier l'interface ReservationInterface à ReservationRepository
        $this->app->bind(ReservationInterface::class, ReservationRepository::class);
    }

    public function boot()
    {
        //
    }
}
