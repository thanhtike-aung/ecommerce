<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Repositories\Admin\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CustomerService implements CustomerServiceInterface
{
    public function __construct(
        protected readonly CustomerRepositoryInterface $customerRepositoryInterface
    ) {
    }

    public function get(): Collection
    {
        return $this->customerRepositoryInterface->get();
    }

    public function getById(int $id): Model
    {
        return $this->customerRepositoryInterface->getById($id);
    }

    public function create(array $data): Model
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Set role as customer
        $data['role'] = 'customer';

        return $this->customerRepositoryInterface->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $customer = $this->customerRepositoryInterface->getById($id);

        // Hash password only if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Remove password from data if it's empty to avoid overwriting with empty string
            unset($data['password']);
        }

        // Ensure role remains as customer
        $data['role'] = 'customer';

        $customer->update($data);
        return $customer;
    }

    public function delete(int $id): void
    {
        $customer = $this->customerRepositoryInterface->getById($id);
        $customer->delete();
    }
}
