<?php

namespace App\Services\Customer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    /**
     * Get all active products for customers with pagination
     */
    public function getActiveProducts(int $perPage = 12): LengthAwarePaginator;

    /**
     * Get featured products only
     */
    public function getFeaturedProducts(int $limit = 8): Collection;

    /**
     * Get a specific product with its details
     */
    public function getProductWithDetails(int $productId): Model;

    /**
     * Search products by name, description, or other attributes
     */
    public function searchProducts(?string $search = null, ?int $categoryId = null, ?int $brandId = null, ?string $sortBy = null, ?string $priceRange = null, int $perPage = 12): LengthAwarePaginator;

    /**
     * Get product by slug for SEO-friendly URLs
     */
    public function getProductBySlug(string $slug): Model;

    /**
     * Get related products for a specific product
     */
    public function getRelatedProducts(int $productId, int $limit = 4): Collection;

    /**
     * Get products by category
     */
    public function getProductsByCategory(int $categoryId, int $perPage = 12): LengthAwarePaginator;

    /**
     * Get products by brand
     */
    public function getProductsByBrand(int $brandId, int $perPage = 12): LengthAwarePaginator;

    /**
     * Get new arrivals (recently added products)
     */
    public function getNewArrivals(int $limit = 8): Collection;
}
