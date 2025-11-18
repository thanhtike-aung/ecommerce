<?php

namespace App\Repositories\Customer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BrandRepositoryInterface
{
    /**
     * Get all active brands for customers
     */
    public function getActiveBrands(): Collection;

    /**
     * Get featured brands only
     */
    public function getFeaturedBrands(): Collection;

    /**
     * Get a specific brand with its products
     */
    public function getBrandWithProducts(int $brandId): Model;

    /**
     * Search brands by name or description
     */
    public function searchBrands(?string $search = null, ?bool $featured = null): Collection;

    /**
     * Get brand by slug for SEO-friendly URLs
     */
    public function getBrandBySlug(string $slug): Model;

    /**
     * Get brands with product count
     */
    public function getBrandsWithProductCount(): Collection;
}
