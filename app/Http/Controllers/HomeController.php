<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products
        $featuredProducts = Product::where('featured', true)
            ->where('status', true)
            ->take(8)
            ->get();

        // Get featured categories
        $featuredCategories = Category::where('featured', true)
            ->where('status', true)
            ->take(3)
            ->get();

        // Get featured brands
        $featuredBrands = Brand::where('featured', true)
            ->where('status', true)
            ->take(6)
            ->get();

        // Get product count
        $productCount = Product::where('status', true)->count();

        // Get category count
        $categoryCount = Category::where('status', true)->count();

        // Get brand count
        $brandCount = Brand::where('status', true)->count();

        return view('welcome', compact(
            'featuredProducts',
            'featuredCategories',
            'featuredBrands',
            'productCount',
            'categoryCount',
            'brandCount'
        ));
    }
}
