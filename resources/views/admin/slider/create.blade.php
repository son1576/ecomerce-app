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
                            <h4>Create Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf  
                              <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner" id="banner" class="form-control" value="{{ old('banner') }}">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Starting Price</label>
                                    <input type="text" name="starting_price" id="starting_price" class="form-control" value="{{ old('starting_price') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Button URL</label>
                                    <input type="text" name="btn_url" id="btn_url" class="form-control" value="{{ old('btn_url') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Serial</label>
                                    <input type="text" name="serial" class="form-control" id="" value="{{ old('serial') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="" value="{{ old('status') }}">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
