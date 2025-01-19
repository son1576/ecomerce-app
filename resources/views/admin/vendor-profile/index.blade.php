@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile</h1>
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
                            <h4>Update Vendor Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendor-profile.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="banner">Preview</label>
                                    <img width="200" src="{{asset($profile->banner)}}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner" id="banner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ $profile->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{ $profile->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{ $profile->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="summernote" name="description" >{{ $profile->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" name="fb_link" class="form-control" id=""
                                        value="{{ $profile->fb_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="">X</label>
                                    <input type="text" name="tw_link" class="form-control" id=""
                                        value="{{ $profile->tw_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" name="insta_link" class="form-control" id=""
                                        value="{{ $profile->insta_link }}">
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
