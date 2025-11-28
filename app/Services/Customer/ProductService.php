<?php

namespace App\Services\Customer;

use App\Repositories\Customer\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        protected readonly ProductRepositoryInterface $productRepositoryInterface
    ) {
    }

    /**
     * Get all active products for customers with pagination
     */
    public function getActiveProducts(int $perPage = 12): LengthAwarePaginator
    {
        return $this->productRepositoryInterface->getActiveProducts($perPage);
    }

    /**
     * Get featured products only
     */
    public function getFeaturedProducts(int $limit = 8): Collection
    {
        return $this->productRepositoryInterface->getFeaturedProducts($limit);
    }

    /**
     * Get a specific product with its details
     */
    public function getProductWithDetails(int $productId): Model
    {
        return $this->productRepositoryInterface->getProductWithDetails($productId);
    }

    /**
     * Search products by name, description, or other attributes
     */
    public function searchProducts(?string $search = null, ?int $categoryId = null, ?int $brandId = null, ?string $sortBy = null, ?string $priceRange = null, int $perPage = 12): LengthAwarePaginator
    {
        return $this->productRepositoryInterface->searchProducts($search, $categoryId, $brandId, $sortBy, $priceRange, $perPage);
    }

    /**
     * Get product by slug for SEO-friendly URLs
     */
    public function getProductBySlug(string $slug): Model
    {
        return $this->productRepositoryInterface->getProductBySlug($slug);
    }

    /**
     * Get related products for a specific product
     */
    public function getRelatedProducts(int $productId, int $limit = 4): Collection
    {
        return $this->productRepositoryInterface->getRelatedProducts($productId, $limit);
    }

    /**
     * Get products by category
     */
    public function getProductsByCategory(int $categoryId, int $perPage = 12): LengthAwarePaginator
    {
        return $this->productRepositoryInterface->getProductsByCategory($categoryId, $perPage);
    }

    /**
     * Get products by brand
     */
    public function getProductsByBrand(int $brandId, int $perPage = 12): LengthAwarePaginator
    {
        return $this->productRepositoryInterface->getProductsByBrand($brandId, $perPage);
    }

    /**
     * Get new arrivals (recently added products)
     */
    public function getNewArrivals(int $limit = 8): Collection
    {
        return $this->productRepositoryInterface->getNewArrivals($limit);
    }
}
