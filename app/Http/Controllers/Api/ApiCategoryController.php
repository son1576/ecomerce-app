<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    /**
     * Get all categories.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Create a new category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'icon' => ['required', 'not_in:empty'],
            'status' => ['required']
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully!',
            'data' => $category
        ]);
    }

    /**
     * Get a specific category by ID.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found!'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Update a category.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found!'
            ], 404);
        }

        $request->validate([
            'name' => ['required', 'max:200'],
            'icon' => ['required', 'not_in:empty'],
            'status' => ['required']
        ]);

        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully!',
            'data' => $category
        ]);
    }

    /**
     * Delete a category.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found!'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully!'
        ]);
    }

    /**
     * Change the status of the category.
     */
    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);

        // Change the status of the category
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category status updated successfully!',
            'data' => $category
        ]);
    }
}
