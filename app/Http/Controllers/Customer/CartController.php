<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = $this->getCart();
        return view('pages.customer.cart.index', compact('cart'));
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product is in stock
        if (!$product->isInStock() || $product->stock_qty < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Product is out of stock or requested quantity exceeds available stock.'
            ], 400);
        }

        $cart = $this->getCart();

        // Check if product already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Update existing cart item
            $cartItem->quantity += $request->quantity;
            $cartItem->total = $cartItem->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            $price = $product->isOnSale() ? $product->sale_price : $product->price;

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $price,
                'total' => $price * $request->quantity,
            ]);
        }

        // Update cart totals
        $this->updateCartTotals($cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart_count' => $cart->total_quantity,
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function updateCartItem(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);
        $product = Product::findOrFail($cartItem->product_id);

        // Check if product is in stock
        if (!$product->isInStock() || $product->stock_qty < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Product is out of stock or requested quantity exceeds available stock.'
            ], 400);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->total = $cartItem->price * $cartItem->quantity;
        $cartItem->save();

        $cart = $this->getCart();
        $this->updateCartTotals($cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'cart_count' => $cart->total_quantity,
            'item_total' => $cartItem->total,
            'cart_total' => $cart->total_price,
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function removeCartItem(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);
        $cartItem->delete();

        $cart = $this->getCart();
        $this->updateCartTotals($cart);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'cart_count' => $cart->total_quantity,
            'cart_total' => $cart->total_price,
        ]);
    }

    /**
     * Clear the entire cart.
     */
    public function clearCart()
    {
        $cart = $this->getCart();
        $cart->items()->delete();

        $this->updateCartTotals($cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
        ]);
    }

    /**
     * Get or create a cart for the current user/session.
     */
    protected function getCart()
    {
        if (Auth::check()) {
            // User is logged in, get cart by user_id
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        } else {
            // User is not logged in, get cart by session_id
            $sessionId = session()->get('cart_session_id');

            if (!$sessionId) {
                $sessionId = Str::uuid();
                session()->put('cart_session_id', $sessionId);
            }

            $cart = Cart::firstOrCreate([
                'session_id' => $sessionId,
            ]);
        }

        return $cart;
    }

    /**
     * Update cart totals based on cart items.
     */
    protected function updateCartTotals(Cart $cart)
    {
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($cart->items as $item) {
            $totalQuantity += $item->quantity;
            $totalPrice += $item->total;
        }

        $cart->total_quantity = $totalQuantity;
        $cart->total_price = $totalPrice;
        $cart->save();

        return $cart;
    }
}
