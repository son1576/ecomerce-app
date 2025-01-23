@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Variant Item</h4>
                            <div class="card-header-action">

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-variant-item.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Variant Name</label>
                                    <input type="text" name="variant_name" id="variant_name" class="form-control"
                                        value="{{ $variant->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="name">Item Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="name">Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" name="price" id="price" class="form-control"
                                        value="{{ old('price') }}">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="variant_id" class="form-control"
                                        value="{{ $variant->id }}">
                                </div>
                                
                                <div class="form-group">
                                    <input type="hidden" name="product_id" class="form-control"
                                        value="{{ $product->id }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Is Default</label>
                                    <select name="is_default" class="form-control" id=""
                                        value="{{ old('status') }}">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="" value="{{ old('status') }}">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
