<?php

namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderServiceInterface
{
    public function get(): Collection;
    public function getById(int $id): Model;
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function delete(int $id): void;
    public function updateStatus(int $id, string $status): Model;
    public function updatePaymentStatus(int $id, string $paymentStatus): Model;
}
