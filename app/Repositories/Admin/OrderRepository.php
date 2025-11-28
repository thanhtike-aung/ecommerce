<?php

namespace App\Repositories\Admin;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    public function get(): Collection
    {
        return Order::with(['user', 'orderItems'])->latest()->get();
    }

    public function getById(int $id): Model
    {
        return Order::with(['user', 'orderItems.product'])->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return Order::create($data);
    }
}
