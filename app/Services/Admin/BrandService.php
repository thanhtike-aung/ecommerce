<?php

namespace App\Services\Admin;

use App\Models\Brand;
use App\Repositories\Admin\BrandRepository;
use App\Repositories\Admin\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BrandService implements BrandServiceInterface
{
    public function __construct(
        protected readonly BrandRepositoryInterface $brandRepositoryInterface
    ) {
    }

    public function get(): Collection
    {
        return $this->brandRepositoryInterface->get();
    }

    public function getById(int $id): Model
    {
        return $this->brandRepositoryInterface->getById($id);
    }

    public function create(array $data): Model
    {
        return $this->brandRepositoryInterface->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $brand = $this->brandRepositoryInterface->getById($id);
        $brand->update($data);
        return $brand;
    }

    public function delete(int $id): void
    {
        $brand = $this->brandRepositoryInterface->getById($id);
        $brand->delete();
    }
}
