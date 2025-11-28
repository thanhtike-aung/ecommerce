<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Customer\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductServiceInterface $productServiceInterface
    )
    {
        // Customer-specific middleware can be added here
    }

    /**
     * Display a listing of active products for customers.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category');
        $brandId = $request->get('brand');
        $sortBy = $request->get('sort', 'newest');
        $priceRange = $request->get('price_range');
        $perPage = $request->get('per_page', 12);

        $products = $this->productServiceInterface->searchProducts(
            $search, $categoryId, $brandId, $sortBy, $priceRange, $perPage
        );

        $featuredProducts = $this->productServiceInterface->getFeaturedProducts(4);
        $newArrivals = $this->productServiceInterface->getNewArrivals(4);

        return view('pages.customer.product.index', compact(
            'products', 'featuredProducts', 'newArrivals', 'search', 'categoryId', 'brandId', 'sortBy', 'priceRange'
        ));
    }

    /**
     * Display the specified product with its details.
     */
    public function show(Product $product)
    {
        // Only show active products to customers
        if (!$product->status) {
            abort(404);
        }

        $productWithDetails = $this->productServiceInterface->getProductWithDetails($product->id);
        $relatedProducts = $this->productServiceInterface->getRelatedProducts($product->id);

        return view('pages.customer.product.show', compact('productWithDetails', 'relatedProducts'));
    }

    /**
     * Display products by category.
     */
    public function byCategory(Request $request, int $categoryId)
    {
        $sortBy = $request->get('sort', 'newest');
        $perPage = $request->get('per_page', 12);

        $products = $this->productServiceInterface->getProductsByCategory($categoryId, $perPage);

        return view('pages.customer.product.by_category', compact('products', 'categoryId', 'sortBy'));
    }

    /**
     * Display products by brand.
     */
    public function byBrand(Request $request, int $brandId)
    {
        $sortBy = $request->get('sort', 'newest');
        $perPage = $request->get('per_page', 12);

        $products = $this->productServiceInterface->getProductsByBrand($brandId, $perPage);

        return view('pages.customer.product.by_brand', compact('products', 'brandId', 'sortBy'));
    }

    /**
     * Get products for AJAX requests (e.g., filtering, search)
     */
    public function getProducts(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category');
        $brandId = $request->get('brand');
        $sortBy = $request->get('sort');
        $priceRange = $request->get('price_range');
        $perPage = $request->get('per_page', 12);

        $products = $this->productServiceInterface->searchProducts(
            $search, $categoryId, $brandId, $sortBy, $priceRange, $perPage
        );

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

    /**
     * Get featured products for homepage or special sections
     */
    public function getFeaturedProducts()
    {
        $featuredProducts = $this->productServiceInterface->getFeaturedProducts();

        return response()->json([
            'success' => true,
            'products' => $featuredProducts
        ]);
    }

    /**
     * Get new arrivals for homepage or special sections
     */
    public function getNewArrivals()
    {
        $newArrivals = $this->productServiceInterface->getNewArrivals();

        return response()->json([
            'success' => true,
            'products' => $newArrivals
        ]);
    }
}
