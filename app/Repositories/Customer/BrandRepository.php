<?php

namespace App\Repositories\Customer;

use App\Models\Brand;
use App\Repositories\Customer\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BrandRepository implements BrandRepositoryInterface
{
    /**
     * Get all active brands for customers
     */
    public function getActiveBrands(): Collection
    {
        return Brand::where('status', 1)
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get featured brands only
     */
    public function getFeaturedBrands(): Collection
    {
        return Brand::where('status', 1)
            ->where('featured', 1)
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get a specific brand with its products
     */
    public function getBrandWithProducts(int $brandId): Model
    {
        return Brand::where('status', 1)
            ->with(['products' => function ($query) {
                $query->where('status', 1) // Only active products
                      ->orderBy('name', 'asc');
            }])
            ->findOrFail($brandId);
    }

    /**
     * Search brands by name or description
     */
    public function searchBrands(?string $search = null, ?bool $featured = null): Collection
    {
        $query = Brand::where('status', 1);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($featured !== null) {
            $query->where('featured', $featured);
        }

        return $query->orderBy('sort', 'desc')
                    ->orderBy('name', 'asc')
                    ->get();
    }

    /**
     * Get brand by slug for SEO-friendly URLs
     */
    public function getBrandBySlug(string $slug): Model
    {
        return Brand::where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Get brands with product count
     */
    public function getBrandsWithProductCount(): Collection
    {
        return Brand::where('status', 1)
            ->withCount(['products' => function ($query) {
                $query->where('status', 1); // Only count active products
            }])
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }
}
