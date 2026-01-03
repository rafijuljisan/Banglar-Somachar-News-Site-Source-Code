@extends('layouts.admin')

@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">Manage Photocard Frames</h4>
                <ul class="links">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="javascript:;">Tools</a></li>
                    <li><a href="{{ route('admin.photocard.index') }}">Photocard Frames</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="add-product-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area">
                        @include('includes.admin.form-both')
                        
                        {{-- Upload Form --}}
                        <form id="geniusformdata" action="{{ route('admin.photocard.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="left-area">
                                        <h4 class="heading">Upload New Frame *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="img-upload">
                                        <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/images/noimage.png') }});">
                                            <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i> Upload Image</label>
                                            <input type="file" name="frame" class="img-upload" id="image-upload" required>
                                        </div>
                                    </div>
                                    <button class="addProductSubmit-btn" type="submit">Add Frame</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        {{-- List Existing Frames --}}
                        <h4 class="heading text-center">Existing Frames</h4>
                        <div class="row">
                            @foreach($frames as $frame)
                            <div class="col-md-3 col-sm-6">
                                <div class="card" style="margin-bottom: 20px;">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/images/frames/'.$frame->image) }}" style="width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                        <a href="{{ route('admin.photocard.delete', $frame->id) }}" class="btn btn-danger btn-sm" style="margin-top: 10px;">Delete</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection