<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the checkout page
     */
    public function index()
    {
        // Get the current user's cart
        $cart = Cart::where('user_id', Auth::id())->first();

        // If cart doesn't exist or is empty, redirect to cart page
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Your cart is empty. Please add products to your cart before checkout.');
        }

        // Get user's information for pre-filling the checkout form
        $user = Auth::user();

        return view('pages.customer.checkout.index', compact('cart', 'user'));
    }

    /**
     * Process the checkout
     */
    public function process(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'billing_same_as_shipping' => 'nullable|boolean',
            'billing_name' => 'required_if:billing_same_as_shipping,0|nullable|string|max:255',
            'billing_email' => 'required_if:billing_same_as_shipping,0|nullable|email|max:255',
            'billing_phone' => 'required_if:billing_same_as_shipping,0|nullable|string|max:20',
            'billing_address' => 'required_if:billing_same_as_shipping,0|nullable|string|max:500',
            'billing_city' => 'required_if:billing_same_as_shipping,0|nullable|string|max:100',
            'billing_state' => 'required_if:billing_same_as_shipping,0|nullable|string|max:100',
            'billing_zip' => 'required_if:billing_same_as_shipping,0|nullable|string|max:20',
            'billing_country' => 'required_if:billing_same_as_shipping,0|nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Get the current user's cart
        $cart = Cart::where('user_id', Auth::id())->first();

        // If cart doesn't exist or is empty, redirect to cart page
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Your cart is empty. Please add products to your cart before checkout.');
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Format shipping address
            $shippingAddress = json_encode([
                'name' => $validated['shipping_name'],
                'email' => $validated['shipping_email'],
                'phone' => $validated['shipping_phone'],
                'address' => $validated['shipping_address'],
                'city' => $validated['shipping_city'],
                'state' => $validated['shipping_state'],
                'zip' => $validated['shipping_zip'],
                'country' => $validated['shipping_country'],
            ]);

            // Format billing address
            if ($request->has('billing_same_as_shipping') && $request->billing_same_as_shipping) {
                $billingAddress = $shippingAddress;
            } else {
                $billingAddress = json_encode([
                    'name' => $validated['billing_name'],
                    'email' => $validated['billing_email'],
                    'phone' => $validated['billing_phone'],
                    'address' => $validated['billing_address'],
                    'city' => $validated['billing_city'],
                    'state' => $validated['billing_state'],
                    'zip' => $validated['billing_zip'],
                    'country' => $validated['billing_country'],
                ]);
            }

            // Create a new order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cod', // Cash on delivery
                'total_amount' => $cart->total_price,
                'shipping_address' => $shippingAddress,
                'billing_address' => $billingAddress,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items from cart items
            foreach ($cart->items as $cartItem) {
                $product = Product::find($cartItem->product_id);

                // Check if product is still in stock
                if (!$product || !$product->isInStock() || $product->stock_qty < $cartItem->quantity) {
                    throw new \Exception("Product {$product->name} is out of stock or has insufficient quantity.");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku ?? '',
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'total' => $cartItem->total,
                ]);

                // Update product stock
                $product->stock_qty -= $cartItem->quantity;
                $product->save();
            }

            // Clear the cart
            $cart->items()->delete();
            $cart->total_price = 0;
            $cart->total_quantity = 0;
            $cart->save();

            // Commit the transaction
            DB::commit();

            // Redirect to order confirmation page
            return redirect()->route('customer.checkout.confirmation', ['order' => $order->id])
                ->with('success', 'Your order has been placed successfully!');

        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'An error occurred while processing your order: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the order confirmation page
     */
    public function confirmation($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        // Check if the order belongs to the current user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.customer.checkout.confirmation', compact('order'));
    }
}
