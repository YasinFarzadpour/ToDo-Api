<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

/**
 * @group Category management
 *
 * APIs for managing Categories
 */
class CategoryController extends Controller
{
    /**
     * Get All Categories
     *
     * This endpoint Gives you Categories.
     * @authenticated
     */
    public function index(): CategoryCollection
    {
        $categories = Category::paginate();
        return new CategoryCollection($categories);
    }

    /**
     * show single Category
     *
     * This endpoint Gives you Single Category.
     * @authenticated
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * store a Category
     *
     * This endpoint stores Category.
     * @authenticated
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return new CategoryResource($category);
    }

    /**
     * updates a Category
     *
     * This endpoint updates Category.
     * @authenticated
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * delete a Category
     *
     * This endpoint delete Category.
     * @authenticated
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
