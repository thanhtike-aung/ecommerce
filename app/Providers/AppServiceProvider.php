<?php

namespace App\Providers;

use App\Repositories\Admin\BrandRepository;
use App\Repositories\Admin\BrandRepositoryInterface;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CategoryRepositoryInterface;
use App\Repositories\Admin\CustomerRepository;
use App\Repositories\Admin\CustomerRepositoryInterface;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\OrderRepositoryInterface;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\ProductRepositoryInterface;
use App\Services\Admin\BrandService;
use App\Services\Admin\BrandServiceInterface;
use App\Services\Admin\CategoryService;
use App\Services\Admin\CategoryServiceInterface;
use App\Services\Admin\CustomerService;
use App\Services\Admin\CustomerServiceInterface;
use App\Services\Admin\OrderService;
use App\Services\Admin\OrderServiceInterface;
use App\Services\Admin\ProductService;
use App\Services\Admin\ProductServiceInterface;
use App\Repositories\Customer\BrandRepository as CustomerBrandRepository;
use App\Repositories\Customer\BrandRepositoryInterface as CustomerBrandRepositoryInterface;
use App\Repositories\Customer\CategoryRepository as CustomerCategoryRepository;
use App\Repositories\Customer\CategoryRepositoryInterface as CustomerCategoryRepositoryInterface;
use App\Repositories\Customer\ProductRepository as CustomerProductRepository;
use App\Repositories\Customer\ProductRepositoryInterface as CustomerProductRepositoryInterface;
use App\Services\Customer\BrandService as CustomerBrandService;
use App\Services\Customer\BrandServiceInterface as CustomerBrandServiceInterface;
use App\Services\Customer\CategoryService as CustomerCategoryService;
use App\Services\Customer\CategoryServiceInterface as CustomerCategoryServiceInterface;
use App\Services\Customer\ProductService as CustomerProductService;
use App\Services\Customer\ProductServiceInterface as CustomerProductServiceInterface;
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
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        // Customer bindings
        $this->app->bind(CustomerBrandServiceInterface::class, CustomerBrandService::class);
        $this->app->bind(CustomerBrandRepositoryInterface::class, CustomerBrandRepository::class);
        $this->app->bind(CustomerCategoryServiceInterface::class, CustomerCategoryService::class);
        $this->app->bind(CustomerCategoryRepositoryInterface::class, CustomerCategoryRepository::class);
        $this->app->bind(CustomerProductServiceInterface::class, CustomerProductService::class);
        $this->app->bind(CustomerProductRepositoryInterface::class, CustomerProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
