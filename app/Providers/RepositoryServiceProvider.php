<?php

namespace App\Providers;

use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\FilmInterface;
use App\Repository\Interface\SalleInterface;
use App\Repository\Interface\SiegeInterface;
use App\Repository\Interface\SeanceInterface;
use App\Repository\Interface\TicketInterface;
use App\Repository\Interface\PaymentInterface;
use App\Repository\ClassRepository\FilmRepository;
use App\Repository\Interface\ReservationInterface;
use App\Repository\ClassRepository\SiegeRepository;
use App\Repository\ClassRepository\SalleRepository; 
use App\Repository\ClassRepository\SeanceRepository;
use App\Repository\ClassRepository\TicketRepository;
use App\Repository\ClassRepository\PaymentRepository;
use App\Repository\ClassRepository\ReservationRepository;


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

        // Associe l'interface SiegeInterface à la classe SiegeRepository
        $this->app->bind(SiegeInterface::class, SiegeRepository::class);

        // Lier l'interface SalleInterface à SalleRepository
        $this->app->bind(SalleInterface::class, SalleRepository::class);

        $this->app->bind(PaymentInterface::class, PaymentRepository::class);
        $this->app->bind(PaymentService::class, PaymentService::class);

        
        $this->app->bind(TicketInterface::class, TicketRepository::class);

    }

    public function boot()
    {
        //
    }
}
