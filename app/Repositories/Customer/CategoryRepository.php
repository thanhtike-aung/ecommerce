<?php

namespace App\Repositories\Customer;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all active categories for customers
     */
    public function getActiveCategories(): Collection
    {
        return Category::where('status', 1)
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get featured categories only
     */
    public function getFeaturedCategories(): Collection
    {
        return Category::where('status', 1)
            ->where('featured', 1)
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get a specific category with its products
     */
    public function getCategoryWithProducts(int $categoryId): Model
    {
        return Category::where('status', 1)
            ->with(['products' => function ($query) {
                $query->where('status', 1) // Only active products
                      ->orderBy('created_at', 'desc');
            }])
            ->findOrFail($categoryId);
    }

    /**
     * Get category by slug for SEO-friendly URLs
     */
    public function getCategoryBySlug(string $slug): Model
    {
        return Category::where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Get parent categories with their children
     */
    public function getParentCategoriesWithChildren(): Collection
    {
        return Category::where('status', 1)
            ->whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->where('status', 1)
                      ->orderBy('sort', 'desc')
                      ->orderBy('name', 'asc');
            }])
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get categories with product count
     */
    public function getCategoriesWithProductCount(): Collection
    {
        return Category::where('status', 1)
            ->withCount(['products' => function ($query) {
                $query->where('status', 1); // Only count active products
            }])
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get child categories for a specific parent category
     */
    public function getChildCategories(int $parentId): Collection
    {
        return Category::where('status', 1)
            ->where('parent_id', $parentId)
            ->orderBy('sort', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }
}
