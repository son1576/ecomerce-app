<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        /** Check product vendor */
        if($product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        return $dataTable->render('vendor.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $varinat = new ProductVariant();
        $varinat->product_id = $request->product;
        $varinat->name = $request->name;
        $varinat->status = $request->status;
        $varinat->save();

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('vendor.products-variant.index', ['product' => $request->product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        /** Check product vendor */
        if($variant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }
        return view('vendor.product.variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $varinat = ProductVariant::findOrFail($id);
        /** Check product vendor */
        if($varinat->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }
        $varinat->name = $request->name;
        $varinat->status = $request->status;
        $varinat->save();

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('vendor.variant.index', ['product' => $varinat->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);

        /** Check product vendor */
        if($variant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        $variantItemCheck = ProductVariantItem::where('product_variant_id', $variant->id)->count();
        if($variantItemCheck > 0){
            return response(['status' => 'error', 'message' => 'This variant contain variant items in it delete the variant items first for delete this variant!']);
        }
        $variant->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();

        return response(['message' => 'Status has been updated!']);
    }
}
