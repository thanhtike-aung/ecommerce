<?php

namespace App\Services\Admin;

use App\Models\Brand;
use App\Repositories\Admin\BrandRepository;
use App\Repositories\Admin\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        if (isset($data['thumbnail']) && $data['thumbnail']) {
            $path = $data['thumbnail']->store('brands', 'images');
            $data['thumbnail'] = $path;
        }

        return $this->brandRepositoryInterface->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $brand = $this->brandRepositoryInterface->getById($id);

        // If there's a new thumbnail, delete the old one if it exists
        if (isset($data['thumbnail']) && $brand->thumbnail) {
            Storage::disk('images')->delete($brand->thumbnail);
        }

        $brand->update($data);
        return $brand;
    }

    public function delete(int $id): void
    {
        $brand = $this->brandRepositoryInterface->getById($id);

        // Delete the brand's thumbnail if it exists
        if ($brand->thumbnail) {
            Storage::disk('images')->delete($brand->thumbnail);
        }

        $brand->delete();
    }
}
