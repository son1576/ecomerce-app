<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $product = Product::findOrfail($request->product);
        return $dataTable->render('admin.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product_id;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Created successfully', 'success');

        return redirect()->route('admin.products-variant.index', ['product' => $request->product_id]);
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
        $variant = ProductVariant::findOrfail($id);
        return view('admin.product.variant.edit', compact('variant'));
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
        $varinat->name = $request->name;
        $varinat->status = $request->status;
        $varinat->save();

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('admin.products-variant.index', ['product' => $varinat->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $varinat = ProductVariant::findOrFail($id);
        // $variantItemCheck = ProductVariantItem::where('product_variant_id', $varinat->id)->count();
        // if($variantItemCheck > 0){
        //     return response(['status' => 'error', 'message' => 'This variant contain variant items in it delete the variant items first for delete this variant!']);
        // }
        $varinat->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);

    }

    public function changeStatus(Request $request)
    {
        $varinat = ProductVariant::findOrFail($request->id);
        $varinat->status = $request->status == 'true' ? 1 : 0;
        $varinat->save();

        return response(['message' => 'Status has been updated!']);
    }
}
