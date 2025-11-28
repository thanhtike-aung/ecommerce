<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Customer\CategoryServiceInterface;
use App\Services\Customer\ProductServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected readonly CategoryServiceInterface $categoryServiceInterface,
        protected readonly ProductServiceInterface $productServiceInterface
    )
    {
        // Customer-specific middleware can be added here
    }

    /**
     * Display a listing of active categories for customers.
     */
    public function index()
    {
        $featuredCategories = $this->categoryServiceInterface->getFeaturedCategories();
        $parentCategories = $this->categoryServiceInterface->getParentCategoriesWithChildren();

        return view('pages.customer.category.index', compact('featuredCategories', 'parentCategories'));
    }

    /**
     * Display the specified category with its products.
     */
    public function show(Category $category)
    {
        // Only show active categories to customers
        if (!$category->status) {
            abort(404);
        }

        $categoryWithProducts = $this->categoryServiceInterface->getCategoryWithProducts($category->id);
        $childCategories = $this->categoryServiceInterface->getChildCategories($category->id);

        return view('pages.customer.category.show', compact('categoryWithProducts', 'childCategories'));
    }

    /**
     * Display the specified category with its products using slug.
     */
    public function showBySlug(string $slug)
    {
        try {
            $category = $this->categoryServiceInterface->getCategoryBySlug($slug);
            $categoryWithProducts = $this->categoryServiceInterface->getCategoryWithProducts($category->id);
            $childCategories = $this->categoryServiceInterface->getChildCategories($category->id);

            return view('pages.customer.category.show', compact('categoryWithProducts', 'childCategories'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Get categories for AJAX requests (e.g., filtering, search)
     */
    public function getCategories(Request $request)
    {
        $featured = $request->get('featured');
        $withProducts = $request->get('with_products', false);

        if ($withProducts) {
            $categories = $this->categoryServiceInterface->getCategoriesWithProductCount();
        } else if ($featured) {
            $categories = $this->categoryServiceInterface->getFeaturedCategories();
        } else {
            $categories = $this->categoryServiceInterface->getActiveCategories();
        }

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    /**
     * Get parent categories with children for navigation
     */
    public function getCategoryTree()
    {
        $categoryTree = $this->categoryServiceInterface->getParentCategoriesWithChildren();

        return response()->json([
            'success' => true,
            'categories' => $categoryTree
        ]);
    }
}
