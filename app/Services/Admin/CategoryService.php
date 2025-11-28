<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        protected readonly CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
    }

    public function get(): Collection
    {
        return $this->categoryRepositoryInterface->get();
    }

    public function getById(int $id): Model
    {
        return $this->categoryRepositoryInterface->getById($id);
    }

    public function getParentCategories(?int $excludeId = null): Collection
    {
        return $this->categoryRepositoryInterface->getParentCategories($excludeId);
    }

    public function create(array $data): Model
    {
        if (isset($data['thumbnail']) && $data['thumbnail']) {
            $path = $data['thumbnail']->store('categories', 'images');
            $data['thumbnail'] = $path;
        }

        return $this->categoryRepositoryInterface->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $category = $this->categoryRepositoryInterface->getById($id);

        // If there's a new thumbnail, delete the old one if it exists
        if (isset($data['thumbnail']) && $category->thumbnail) {
            Storage::disk('images')->delete($category->thumbnail);
        }

        $category->update($data);
        return $category;
    }

    public function delete(int $id): void
    {
        $category = $this->categoryRepositoryInterface->getById($id);

        // Delete the category's thumbnail if it exists
        if ($category->thumbnail) {
            Storage::disk('images')->delete($category->thumbnail);
        }

        $category->delete();
    }
}
