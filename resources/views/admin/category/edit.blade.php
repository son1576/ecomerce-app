@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div class="">
                                        <button class="btn btn-primary" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" role="iconpicker" name="icon"
                                            data-icon="{{ $category->icon }}"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $category->name }}">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control" id="">
                                            <option {{ $category->status === 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $category->status === 0 ? 'selected' : '' }} value="0">Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
