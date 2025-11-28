<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Review;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        protected readonly ProductRepositoryInterface $productRepositoryInterface
    ) {
    }

    public function get(): Collection
    {
        return $this->productRepositoryInterface->get();
    }

    public function getById(int $id): Model
    {
        return $this->productRepositoryInterface->getById($id);
    }

    public function create(array $data): Model
    {
        // The thumbnail is now handled in the controller
        // We don't need to process it here anymore
        return $this->productRepositoryInterface->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $product = $this->productRepositoryInterface->getById($id);

        // The thumbnail is now handled in the controller
        // We only need to delete the old one if a new one is provided
        // But we don't need to process the upload here

        $product->update($data);
        return $product;
    }

    public function delete(int $id): void
    {
        $product = $this->productRepositoryInterface->getById($id);

        // Delete the product's thumbnail if it exists
        if ($product->thumbnail) {
            Storage::disk('images')->delete($product->thumbnail);
        }

        // Delete associated product images
        foreach ($product->images as $image) {
            Storage::disk('images')->delete($image->image);
            $image->delete();
        }

        $product->delete();
    }

    public function getAllReviews(): Collection
    {
        return Review::with(['product', 'user'])->orderBy('created_at', 'desc')->get();
    }

    public function updateReviewStatus(int $id, int $status): Model
    {
        $review = Review::findOrFail($id);
        $review->status = $status;
        $review->save();
        return $review;
    }

    public function deleteReview(int $id): void
    {
        $review = Review::findOrFail($id);
        $review->delete();
    }
}
