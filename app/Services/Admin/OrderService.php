<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\Admin\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        protected readonly OrderRepositoryInterface $orderRepositoryInterface
    ) {
    }

    public function get(): Collection
    {
        return $this->orderRepositoryInterface->get();
    }

    public function getById(int $id): Model
    {
        return $this->orderRepositoryInterface->getById($id);
    }

    public function create(array $data): Model
    {
        // Start a database transaction
        return DB::transaction(function () use ($data) {
            // Create the order first
            $orderData = $this->prepareOrderData($data);
            $order = $this->orderRepositoryInterface->create($orderData);

            // Process order items if they exist
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $price = $product->getCurrentPrice();
                    $quantity = $item['quantity'];
                    $total = $price * $quantity;

                    // Create order item
                    $order->orderItems()->create([
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_sku' => $product->sku,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total' => $total,
                        'options' => $item['options'] ?? null,
                    ]);

                    // Update product stock
                    $product->stock_qty -= $quantity;
                    $product->save();
                }
            }

            return $order;
        });
    }

    public function update(int $id, array $data): Model
    {
        $order = $this->orderRepositoryInterface->getById($id);

        // Prepare order data
        $orderData = $this->prepareOrderData($data);

        // Update order
        $order->update($orderData);

        return $order;
    }

    public function delete(int $id): void
    {
        $order = $this->orderRepositoryInterface->getById($id);

        // Delete order items first
        $order->orderItems()->delete();

        // Delete order
        $order->delete();
    }

    public function updateStatus(int $id, string $status): Model
    {
        $order = $this->orderRepositoryInterface->getById($id);
        $order->status = $status;
        $order->save();

        return $order;
    }

    public function updatePaymentStatus(int $id, string $paymentStatus): Model
    {
        $order = $this->orderRepositoryInterface->getById($id);
        $order->payment_status = $paymentStatus;
        $order->save();

        return $order;
    }

    /**
     * Prepare order data for creation or update
     */
    private function prepareOrderData(array $data): array
    {
        // Process shipping address data if it exists in structured format
        if (isset($data['shipping_address_data']) && is_array($data['shipping_address_data'])) {
            $data['shipping_address'] = json_encode($data['shipping_address_data']);
        }

        // Process billing address data if it exists in structured format
        if (isset($data['billing_address_data']) && is_array($data['billing_address_data'])) {
            $data['billing_address'] = json_encode($data['billing_address_data']);
        }

        $orderData = [
            'user_id' => $data['user_id'],
            'status' => $data['status'] ?? 'pending',
            'payment_status' => $data['payment_status'] ?? 'pending',
            'payment_method' => $data['payment_method'] ?? null,
            'shipping_address' => $data['shipping_address'] ?? null,
            'billing_address' => $data['billing_address'] ?? null,
            'shipping_method' => $data['shipping_method'] ?? null,
            'tracking_number' => $data['tracking_number'] ?? null,
            'notes' => $data['notes'] ?? null,
            'total_amount' => $data['total_amount'] ?? 0,
        ];

        // Generate order number for new orders
        if (!isset($data['id'])) {
            $orderData['order_number'] = $this->generateOrderNumber();
        }

        return $orderData;
    }

    /**
     * Generate a unique order number
     */
    private function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $timestamp = now()->format('YmdHis');
        $random = rand(1000, 9999);

        return $prefix . $timestamp . '-' . $random;
    }
}
