<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiChildCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Bảo vệ API bằng Sanctum
    }

    // Get list Child Categories
    public function index()
    {
        return response()->json(ChildCategory::all(), 200);
    }

    //Create new Child Category
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|max:200|unique:child_categories,name',
            'status' => 'required|boolean',
        ]);

        $childCategory = ChildCategory::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return response()->json($childCategory, 201);
    }
    // Update Child Category
    public function update(Request $request, $id)
    {
        $childCategory = ChildCategory::find($id);
        if (!$childCategory) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|max:200|unique:child_categories,name,' . $id,
            'status' => 'required|boolean',
        ]);

        $childCategory->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return response()->json($childCategory, 200);
    }

    // Delete Child Category
    public function destroy($id)
    {
        $childCategory = ChildCategory::find($id);
        if (!$childCategory) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $childCategory->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    // Change Status Child Category
    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::find($request->id);
        if (!$childCategory) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $childCategory->status = $request->status == 'true' ? 1 : 0;
        $childCategory->save();

        return response()->json(['message' => 'Status updated successfully'], 200);
    }
    public function getSubCategories(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
    ]);

    $subCategories = SubCategory::where('category_id', $request->category_id)
        ->where('status', 1)
        ->get();

    return response()->json($subCategories, 200);
}

}
