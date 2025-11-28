<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function get(): Collection
    {
        return Category::orderBy('sort', 'desc')->get();
    }

    public function getById(int $id): Model
    {
        return Category::with(['parent', 'children', 'products'])->findOrFail($id);
    }

    public function getParentCategories(?int $excludeId = null): Collection
    {
        $query = Category::whereNull('parent_id')->orderBy('name');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }

    public function create(array $data): Model
    {
        return Category::create($data);
    }
}
