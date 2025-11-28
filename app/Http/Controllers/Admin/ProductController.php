<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Admin\ProductServiceInterface;
use App\Services\Admin\BrandServiceInterface;
use App\Services\Admin\CategoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductServiceInterface $productServiceInterface,
        protected readonly BrandServiceInterface $brandServiceInterface,
        protected readonly CategoryServiceInterface $categoryServiceInterface
    )
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productServiceInterface->get()->load('category', 'brand');
        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = $this->brandServiceInterface->get();
        $categories = $this->categoryServiceInterface->get();
        return view('pages.admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        // Handle file upload if a thumbnail is provided
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products', 'images');
            $validatedData['thumbnail'] = $path;
        }

        // Create the product
        $product = $this->productServiceInterface->create($validatedData);

        // Handle additional product images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products', 'images');

                // Create product image record
                $product->images()->create([
                    'image' => $imagePath,
                    'sort_order' => 0
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $this->productServiceInterface->getById($product->id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = $this->brandServiceInterface->get();
        $categories = $this->categoryServiceInterface->get();
        return view('pages.admin.product.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        // Handle featured checkbox (if not checked, it won't be in the request)
        if (!isset($validatedData['featured'])) {
            $validatedData['featured'] = 0;
        }

        // Handle file upload if a new image is provided
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products', 'images');
            $validatedData['thumbnail'] = $path;
        }

        // Update the product
        $this->productServiceInterface->update($product->id, $validatedData);

        // Handle additional product images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products', 'images');

                // Create product image record
                $product->images()->create([
                    'image' => $imagePath,
                    'sort_order' => 0
                ]);
            }
        }

        // Handle deleted images
        if ($request->has('deleted_images')) {
            $deletedImageIds = $request->input('deleted_images');
            foreach ($deletedImageIds as $imageId) {
                $productImage = $product->images()->find($imageId);
                if ($productImage) {
                    // Delete the image file
                    if (Storage::disk('images')->exists($productImage->image)) {
                        Storage::disk('images')->delete($productImage->image);
                    }

                    // Delete the record
                    $productImage->delete();
                }
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productId = (int)$id;
        $this->productServiceInterface->delete($productId);
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!',
        ]);
    }

    /**
     * Display product reviews.
     */
    public function reviews()
    {
        $reviews = $this->productServiceInterface->getAllReviews();
        return view('pages.admin.product.reviews', compact('reviews'));
    }

    /**
     * Update review status.
     */
    public function updateReviewStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $this->productServiceInterface->updateReviewStatus($id, $status);
        return response()->json([
            'success' => true,
            'message' => 'Review status updated successfully!',
        ]);
    }

    /**
     * Delete review.
     */
    public function deleteReview($id)
    {
        $this->productServiceInterface->deleteReview($id);
        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully!',
        ]);
    }
}
