<?php

namespace App\Services\Customer;

use App\Repositories\Customer\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        protected readonly CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
    }

    /**
     * Get all active categories for customers
     */
    public function getActiveCategories(): Collection
    {
        return $this->categoryRepositoryInterface->getActiveCategories();
    }

    /**
     * Get featured categories only
     */
    public function getFeaturedCategories(): Collection
    {
        return $this->categoryRepositoryInterface->getFeaturedCategories();
    }

    /**
     * Get a specific category with its products
     */
    public function getCategoryWithProducts(int $categoryId): Model
    {
        return $this->categoryRepositoryInterface->getCategoryWithProducts($categoryId);
    }

    /**
     * Get category by slug for SEO-friendly URLs
     */
    public function getCategoryBySlug(string $slug): Model
    {
        return $this->categoryRepositoryInterface->getCategoryBySlug($slug);
    }

    /**
     * Get parent categories with their children
     */
    public function getParentCategoriesWithChildren(): Collection
    {
        return $this->categoryRepositoryInterface->getParentCategoriesWithChildren();
    }

    /**
     * Get categories with product count
     */
    public function getCategoriesWithProductCount(): Collection
    {
        return $this->categoryRepositoryInterface->getCategoriesWithProductCount();
    }

    /**
     * Get child categories for a specific parent category
     */
    public function getChildCategories(int $parentId): Collection
    {
        return $this->categoryRepositoryInterface->getChildCategories($parentId);
    }
}
