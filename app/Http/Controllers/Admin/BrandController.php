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
        return view('pages.admin.brand.show', compact('brand'));
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
        $validatedData = $request->validated([
            'slug' => 'required', Rule::unique('brands', 'slug')->whereNull('deleted_at'),
            'name' => 'required', Rule::unique('brands', 'name')->whereNull('deleted_at'),
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
            'featured' => 'required|in:0,1',
        ]);
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
        return redirect()->route('admin.brand.index')->with('success', 'Brand deleted successfully!');
    }
}
