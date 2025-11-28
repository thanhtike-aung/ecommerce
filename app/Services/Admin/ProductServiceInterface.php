<?php

namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface
{
    public function get(): Collection;

    public function getById(int $id): Model;

    public function create(array $data): Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id): void;

    public function getAllReviews(): Collection;

    public function updateReviewStatus(int $id, int $status): Model;

    public function deleteReview(int $id): void;
}
