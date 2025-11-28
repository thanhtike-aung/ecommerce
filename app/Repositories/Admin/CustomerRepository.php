<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function get(): Collection
    {
        return User::where('role', 'customer')->latest()->get();
    }

    public function getById(int $id): Model
    {
        return User::findOrFail($id);
    }

    public function create(array $data): Model
    {
        return User::create($data);
    }
}
