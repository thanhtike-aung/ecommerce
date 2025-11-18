<?php

namespace App\Services\Customer;

use App\Models\Brand;
use App\Repositories\Customer\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BrandService implements BrandServiceInterface
{
    public function __construct(
        protected readonly BrandRepositoryInterface $brandRepositoryInterface
    ) {
    }

    /**
     * Get all active brands for customers
     */
    public function getActiveBrands(): Collection
    {
        return $this->brandRepositoryInterface->getActiveBrands();
    }

    /**
     * Get featured brands only
     */
    public function getFeaturedBrands(): Collection
    {
        return $this->brandRepositoryInterface->getFeaturedBrands();
    }

    /**
     * Get a specific brand with its products
     */
    public function getBrandWithProducts(int $brandId): Model
    {
        return $this->brandRepositoryInterface->getBrandWithProducts($brandId);
    }

    /**
     * Search brands by name or description
     */
    public function searchBrands(?string $search = null, ?bool $featured = null): Collection
    {
        return $this->brandRepositoryInterface->searchBrands($search, $featured);
    }

    /**
     * Get brand by slug for SEO-friendly URLs
     */
    public function getBrandBySlug(string $slug): Model
    {
        return $this->brandRepositoryInterface->getBrandBySlug($slug);
    }

    /**
     * Get brands with product count
     */
    public function getBrandsWithProductCount(): Collection
    {
        return $this->brandRepositoryInterface->getBrandsWithProductCount();
    }
}
