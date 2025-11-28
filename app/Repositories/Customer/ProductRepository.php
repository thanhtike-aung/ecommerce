<?php

namespace App\Repositories\Customer;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all active products for customers with pagination
     */
    public function getActiveProducts(int $perPage = 12): LengthAwarePaginator
    {
        return Product::where('status', 1)
            ->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get featured products only
     */
    public function getFeaturedProducts(int $limit = 8): Collection
    {
        return Product::where('status', 1)
            ->where('featured', 1)
            ->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get a specific product with its details
     */
    public function getProductWithDetails(int $productId): Model
    {
        return Product::where('status', 1)
            ->with(['category', 'brand', 'images', 'reviews'])
            ->findOrFail($productId);
    }

    /**
     * Search products by name, description, or other attributes
     */
    public function searchProducts(?string $search = null, ?int $categoryId = null, ?int $brandId = null, ?string $sortBy = null, ?string $priceRange = null, int $perPage = 12): LengthAwarePaginator
    {
        $query = Product::where('status', 1)
            ->with(['category', 'brand']);

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('short_description', 'LIKE', "%{$search}%")
                  ->orWhere('long_description', 'LIKE', "%{$search}%")
                  ->orWhere('sku', 'LIKE', "%{$search}%");
            });
        }

        // Apply category filter
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Apply brand filter
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        // Apply price range filter
        if ($priceRange) {
            list($min, $max) = explode('-', $priceRange);
            $query->whereBetween('price', [(float)$min, (float)$max]);
        }

        // Apply sorting
        if ($sortBy) {
            switch ($sortBy) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate($perPage);
    }

    /**
     * Get product by slug for SEO-friendly URLs
     */
    public function getProductBySlug(string $slug): Model
    {
        return Product::where('status', 1)
            ->where('slug', $slug)
            ->with(['category', 'brand', 'images', 'reviews'])
            ->firstOrFail();
    }

    /**
     * Get related products for a specific product
     */
    public function getRelatedProducts(int $productId, int $limit = 4): Collection
    {
        $product = Product::findOrFail($productId);

        return Product::where('status', 1)
            ->where('id', '!=', $productId)
            ->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id)
                      ->orWhere('brand_id', $product->brand_id);
            })
            ->with(['category', 'brand'])
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    /**
     * Get products by category
     */
    public function getProductsByCategory(int $categoryId, int $perPage = 12): LengthAwarePaginator
    {
        return Product::where('status', 1)
            ->where('category_id', $categoryId)
            ->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get products by brand
     */
    public function getProductsByBrand(int $brandId, int $perPage = 12): LengthAwarePaginator
    {
        return Product::where('status', 1)
            ->where('brand_id', $brandId)
            ->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get new arrivals (recently added products)
     */
    public function getNewArrivals(int $limit = 8): Collection
    {
        return Product::where('status', 1)
            ->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
