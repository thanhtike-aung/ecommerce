<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get user's orders
        $totalOrders = Order::where('user_id', $user->id)->count();
        $recentOrders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Calculate total spent
        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('total_amount');

        // Get pending orders
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Get processing orders
        $processingOrders = Order::where('user_id', $user->id)
            ->where('status', 'processing')
            ->count();

        // Get completed orders
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        return view('pages.customer.dashboard', compact(
            'totalOrders',
            'recentOrders',
            'totalSpent',
            'pendingOrders',
            'processingOrders',
            'completedOrders'
        ));
    }
}
