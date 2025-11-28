<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total counts
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        // Get monthly growth percentages
        $currentMonthOrders = Order::whereMonth('created_at', now()->month)->count();
        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)->count();
        $orderGrowth = $lastMonthOrders > 0 ? round((($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100) : 0;

        $currentMonthRevenue = Order::whereMonth('created_at', now()->month)->sum('total_amount');
        $lastMonthRevenue = Order::whereMonth('created_at', now()->subMonth()->month)->sum('total_amount');
        $revenueGrowth = $lastMonthRevenue > 0 ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100) : 0;

        $currentMonthProducts = Product::whereMonth('created_at', now()->month)->count();
        $lastMonthProducts = Product::whereMonth('created_at', now()->subMonth()->month)->count();
        $productGrowth = $lastMonthProducts > 0 ? round((($currentMonthProducts - $lastMonthProducts) / $lastMonthProducts) * 100) : 0;

        $currentMonthCustomers = User::where('role', 'customer')->whereMonth('created_at', now()->month)->count();
        $lastMonthCustomers = User::where('role', 'customer')->whereMonth('created_at', now()->subMonth()->month)->count();
        $customerGrowth = $lastMonthCustomers > 0 ? round((($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100) : 0;

        // Get recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get top selling products
        $topSellingProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'desc')
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'totalRevenue',
            'orderGrowth',
            'revenueGrowth',
            'productGrowth',
            'customerGrowth',
            'recentOrders',
            'topSellingProducts'
        ));
    }
}
