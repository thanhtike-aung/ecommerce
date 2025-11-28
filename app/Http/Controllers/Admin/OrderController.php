<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\Admin\OrderServiceInterface;
use App\Services\Admin\ProductServiceInterface;
use App\Services\Admin\CustomerServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected readonly OrderServiceInterface $orderServiceInterface,
        protected readonly ProductServiceInterface $productServiceInterface,
        protected readonly CustomerServiceInterface $customerServiceInterface
    )
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderServiceInterface->get();
        return view('pages.admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = $this->customerServiceInterface->get();
        $products = $this->productServiceInterface->get();
        return view('pages.admin.order.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $this->orderServiceInterface->create($request->validated());
        return redirect()->route('admin.order.index')->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = $this->orderServiceInterface->getById($order->id);
        return view('pages.admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customers = $this->customerServiceInterface->get();
        $products = $this->productServiceInterface->get();
        $order = $this->orderServiceInterface->getById($order->id);
        return view('pages.admin.order.edit', compact('order', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->orderServiceInterface->update($order->id, $request->validated());
        return redirect()->route('admin.order.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderId = (int)$id;
        $this->orderServiceInterface->delete($orderId);
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully!',
        ]);
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled,refunded',
        ]);

        $this->orderServiceInterface->updateStatus($id, $request->status);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!',
        ]);
    }

    /**
     * Update payment status.
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string|in:pending,paid,failed,refunded',
        ]);

        $this->orderServiceInterface->updatePaymentStatus($id, $request->payment_status);

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully!',
        ]);
    }
}
