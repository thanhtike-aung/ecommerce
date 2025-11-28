<?php

namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    public function get(): Collection;

    public function getById(int $id): Model;

    public function getParentCategories(?int $excludeId = null): Collection;

    public function create(array $data): Model;
}
