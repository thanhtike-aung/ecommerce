<?php

namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface
{
    public function get(): Collection;
    public function getById(int $id): Model;
    public function create(array $data): Model;
}
