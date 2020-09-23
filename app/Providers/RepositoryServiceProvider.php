<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    TenantRepositoryInterface,
    CategoryRepositoryInterface,
    TableRepositoryInterface,
    ProductRepositoryInterface,
    ClientRepositoryInterface,
    OrderRepositoryInterface,
    EvaluationRepositoryInterface,
};
use App\Repositories\{
    TenantRepository,
    CategoryRepository,
    TableRepository,
    ProductRepository,
    ClientRepository,
    OrderRepository,
    EvaluationRepository,
};


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->bind(
            TableRepositoryInterface::class,
            TableRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class,
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );
        $this->app->bind(
            EvaluationRepositoryInterface::class,
            EvaluationRepository::class,
        );
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
