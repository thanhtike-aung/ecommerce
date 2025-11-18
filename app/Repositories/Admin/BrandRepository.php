<?php

namespace App\Repositories\Admin;

use App\Models\Brand;
use App\Repositories\Admin\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BrandRepository implements BrandRepositoryInterface
{
    public function get(): Collection
    {
        return Brand::all();
    }

    public function getById(int $id): Model
    {
        return Brand::findOrFail($id);
    }

    public function create(array $data): Model
    {
        return Brand::create($data);
    }

    public function update(int $id, array $data): Model
    {
        $brand = Brand::findOrFail($id);
        $brand->update($data);
        return $brand;
    }

    public function delete(int $id): void
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
    }
}
