<?php

namespace App\Providers;

use App\Repositories\VendaRepository;
use App\Repositories\VendaRepositoryEloquent;
use App\Repositories\VendedorRepository;
use App\Repositories\VendedorRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VendaRepository::class, VendaRepositoryEloquent::class);
        $this->app->bind(VendedorRepository::class, VendedorRepositoryEloquent::class);
    }
}
