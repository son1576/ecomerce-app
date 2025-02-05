<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiBrandController extends Controller
{
    /**
     * Get the list of all brands.
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json(['brands' => $brands], 200);
    }

    /**
     * Create a new brand.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'logo' => 'required|string',
            'is_featured' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $brand = Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $request->logo,
            'is_featured' => $request->is_featured,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Brand created successfully', 'brand' => $brand], 201);
    }

    /**
     * Get details of a specific brand.
     */
    public function edit($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        return response()->json(['brand' => $brand], 200);
    }

    /**
     * Update an existing brand.
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|max:200',
            'logo' => 'sometimes|string',
            'is_featured' => 'sometimes|boolean',
            'status' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $brand->update([
            'name' => $request->input('name', $brand->name),
            'slug' => Str::slug($request->input('name', $brand->name)),
            'logo' => $request->input('logo', $brand->logo),
            'is_featured' => $request->input('is_featured', $brand->is_featured),
            'status' => $request->input('status', $brand->status),
        ]);

        return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand], 200);
    }

    /**
     * Delete a brand.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $brand->delete();

        return response()->json(['message' => 'Brand deleted successfully'], 200);
    }

    /**
     * Change the status of a brand.
     */
    public function changeStatus(Request $request)
    {
        $brand = Brand::find($request->id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        return response()->json(['message' => 'Status has been updated'], 200);
    }
}
