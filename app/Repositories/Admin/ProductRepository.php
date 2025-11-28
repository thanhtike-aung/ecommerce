<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    public function get(): Collection
    {
        return Product::orderBy('created_at', 'desc')->get();
    }

    public function getById(int $id): Model
    {
        return Product::with(['category', 'brand', 'images', 'reviews'])->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return Product::create($data);
    }
}
