<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiVendorProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'role.api:vendor']);
    }

    /**
     * Get list vendor Product
     */
    public function index()
    {
        $products = Product::where('vendor_id', Auth::id())->get();
        return response()->json(['products' => $products], 200);
    }

    /**
     * Show information of editing product
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->where('vendor_id', Auth::id())->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product], 200);
    }

    /**
     * Create new product
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'status' => 'required|boolean',
            'thumb_image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'vendor_id' => Auth::id(),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => $request->status,
            'thumb_image' => $request->thumb_image,

        ]);

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    /**
     * Update Product
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('vendor_id', Auth::id())->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|max:200',
            'category_id' => 'sometimes|exists:categories,id',
            'brand_id' => 'sometimes|exists:brands,id',
            'price' => 'sometimes|numeric',
            'qty' => 'sometimes|integer',
            'short_description' => 'sometimes|max:600',
            'long_description' => 'sometimes',
            'status' => 'sometimes|boolean',
            'thumb_image' => 'sometimes|string',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'status' => $request->input('status'),
            'thumb_image' => $request->input('thumb_image', $product->thumb_image), // Giữ giá trị cũ nếu không thay đổi
        ]);


        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

    /**
     * delete product
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->where('vendor_id', Auth::id())->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::where('id', $request->id)->where('vendor_id', Auth::id())->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
    // cont after test category APIs~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json(['sub_categories' => $subCategories]);
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->subcategory_id)->get();
        return response()->json(['child_categories' => $childCategories]);
    }
}
