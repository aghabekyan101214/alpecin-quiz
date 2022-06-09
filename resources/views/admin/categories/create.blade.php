@extends('layouts.admin')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <br>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ isset($category) ? 'Edit' : 'Add' }} Category</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" action="{{ !isset($category) ? route('admin.categories.store') : route('admin.categories.update', $category->id) }}" enctype="multipart/form-data" class="kt-form">
                        @isset($category) @method('PUT') @endisset
                        @csrf
                        <div class="form-group row">
                            <label for="file" class="col-lg-3 col-form-label text-lg-right">Upload Category Image:</label>
                            <div class="col-lg-6">
                                <input type="file" id="file-input" name="image" />
                                @error('image')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                                <div id="thumb-output">
                                    @if(isset($category) && !is_null($category->image))
                                        <img src="{{ asset('uploads/' . $category->image) }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Category Name:</label>
                            <div class="col-lg-6">
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Category Name*"
                                       value="{{ $category->name ?? old('name') }}">
                                @error('name')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Category Description:</label>
                            <div class="col-lg-6">
                                <textarea
                                       rows="10"
                                       name="description"
                                       class="form-control"
                                       placeholder="Category Description*">{{ $category->description ?? old('description') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Choose Category Type*:</label>
                            <div class="col-lg-6">
                                <select
                                    name="type"
                                    class="form-control">
                                    <option disabled selected>Choose Type*</option>
                                    @foreach($type_choices as $bin => $c)
                                        <option @if(old('type') == $bin or (isset($category->type) && $category->type == $bin)) selected @endif value="{{ $bin }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-lg btn-outline-primary">{{ isset($category) ? 'Update' : 'Create' }} Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('scripts')
    <script src="{{asset('assets/js/pages/components/forms/file-upload/my-upload-image.js')}}" type="text/javascript"></script>
@endsection
