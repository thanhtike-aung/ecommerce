<?php

namespace App\Providers;

use App\Repositories\Admin\BrandRepository;
use App\Repositories\Admin\BrandRepositoryInterface;
use App\Services\Admin\BrandService;
use App\Services\Admin\BrandServiceInterface;
use App\Repositories\Customer\BrandRepository as CustomerBrandRepository;
use App\Repositories\Customer\BrandRepositoryInterface as CustomerBrandRepositoryInterface;
use App\Services\Customer\BrandService as CustomerBrandService;
use App\Services\Customer\BrandServiceInterface as CustomerBrandServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Admin bindings
        $this->app->bind(BrandServiceInterface::class, BrandService::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);

        // Customer bindings
        $this->app->bind(CustomerBrandServiceInterface::class, CustomerBrandService::class);
        $this->app->bind(CustomerBrandRepositoryInterface::class, CustomerBrandRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
