<?php

namespace App\Repositories\Customer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    /**
     * Get all active categories for customers
     */
    public function getActiveCategories(): Collection;

    /**
     * Get featured categories only
     */
    public function getFeaturedCategories(): Collection;

    /**
     * Get a specific category with its products
     */
    public function getCategoryWithProducts(int $categoryId): Model;

    /**
     * Get category by slug for SEO-friendly URLs
     */
    public function getCategoryBySlug(string $slug): Model;

    /**
     * Get parent categories with their children
     */
    public function getParentCategoriesWithChildren(): Collection;

    /**
     * Get categories with product count
     */
    public function getCategoriesWithProductCount(): Collection;

    /**
     * Get child categories for a specific parent category
     */
    public function getChildCategories(int $parentId): Collection;
}
