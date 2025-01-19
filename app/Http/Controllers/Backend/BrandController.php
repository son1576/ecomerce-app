<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Traits\ImageUploadsTrait;
use Str;

class BrandController extends Controller
{
    use ImageUploadsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'logo' => ['required', 'image', 'max:2000'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);

        $logoPath = $this->uploadImage($request, 'logo', 'uploads');

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->logo = $logoPath;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr('Created successfully', 'success');
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'logo' => ['image', 'max:2000'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);
        
        $brand = Brand::findOrFail($id);
        
        $logoPath = $this->updateImage($request, 'logo', 'uploads', $brand->logo);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->logo = empty(!$logoPath) ? $logoPath : $brand->logo;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr('Updated successfully', 'success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->logo);
        $brand->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    /**
     * Change status of the specified resource.
     */
    public function changeStatus(Request $request) {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 1 ? 0 : 1;
        $brand->save();

        return response(['message' => 'Status has been updated']);
    }
}
