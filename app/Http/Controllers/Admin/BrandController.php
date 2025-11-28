<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\Admin\BrandServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function __construct(
        protected readonly BrandServiceInterface $brandServiceInterface
    )
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandServiceInterface->get()->load('products');
        return view('pages.admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        info("this?");
        return view('pages.admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $this->brandServiceInterface->create($request->validated());
        return redirect()->route('admin.brand.index')->with('success', 'Brand created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $brand = $this->brandServiceInterface->getById($brand->id);
        return response()->json($brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('pages.admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $validatedData = $request->validated();

        // Handle featured checkbox (if not checked, it won't be in the request)
        if (!isset($validatedData['featured'])) {
            $validatedData['featured'] = 0;
        }

        // Handle file upload if a new image is provided
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('brands', 'images');
            $validatedData['thumbnail'] = $path;
        }

        $this->brandServiceInterface->update($brand->id, $validatedData);
        return redirect()->route('admin.brand.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brandId = (int)$id;
        $this->brandServiceInterface->delete($brandId);
        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully!',
        ]);
    }
}
