<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\UserInterface;
use App\Repository\ClassRepository\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
