<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Admin\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
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
        $categories = $this->categoryServiceInterface->get()->load('products', 'parent');
        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = $this->categoryServiceInterface->getParentCategories();
        return view('pages.admin.category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryServiceInterface->create($request->validated());
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = $this->categoryServiceInterface->getById($category->id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = $this->categoryServiceInterface->getParentCategories($category->id);
        return view('pages.admin.category.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        // Handle featured checkbox (if not checked, it won't be in the request)
        if (!isset($validatedData['featured'])) {
            $validatedData['featured'] = 0;
        }

        // Handle file upload if a new image is provided
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('categories', 'images');
            $validatedData['thumbnail'] = $path;
        }

        $this->categoryServiceInterface->update($category->id, $validatedData);
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoryId = (int)$id;
        $this->categoryServiceInterface->delete($categoryId);
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!',
        ]);
    }
}
