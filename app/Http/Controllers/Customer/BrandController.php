<?php

namespace App\Http\Controllers\Customer;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Services\Customer\BrandServiceInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(
        protected readonly BrandServiceInterface $brandServiceInterface
    )
    {
        // Customer-specific middleware can be added here
    }

    /**
     * Display a listing of active brands for customers.
     */
    public function index()
    {
        $brands = $this->brandServiceInterface->getBrandsWithProductCount();
        return view('pages.customer.brand.index', compact('brands'));
    }

    /**
     * Display the specified brand with its products.
     */
    public function show(Brand $brand)
    {
        // Only show active brands to customers
        if (!$brand->status) {
            abort(404);
        }

        $brandWithProducts = $this->brandServiceInterface->getBrandWithProducts($brand->id);
        return view('pages.customer.brand.show', compact('brandWithProducts'));
    }

    /**
     * Get brands for AJAX requests (e.g., filtering, search)
     */
    public function getBrands(Request $request)
    {
        $search = $request->get('search');
        $featured = $request->get('featured');

        $brands = $this->brandServiceInterface->searchBrands($search, $featured);

        return response()->json([
            'success' => true,
            'brands' => $brands
        ]);
    }

    /**
     * Get featured brands for homepage or special sections
     */
    public function getFeaturedBrands()
    {
        $featuredBrands = $this->brandServiceInterface->getFeaturedBrands();

        return response()->json([
            'success' => true,
            'brands' => $featuredBrands
        ]);
    }
}
