@extends('layouts.admin')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <br>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ isset($data) ? 'Edit' : 'Add' }} Product</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" action="{{ !isset($data) ? route('admin.products.store') : route('admin.products.update', $data->id) }}" enctype="multipart/form-data" class="kt-form">
                        @isset($data) @method('PUT') @endisset
                        @csrf
                            <div class="form-group row">
                                <label for="file" class="col-lg-3 col-form-label text-lg-right">Upload Product Image:</label>
                                <div class="col-lg-6">
                                    <input type="file" accept="image/*" id="file-input" name="image" />
                                    @error('image')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                    <div id="thumb-output">
                                        @if(isset($data) && !is_null($data->image))
                                            <img src="{{ asset('uploads/' . $data->image) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @foreach($languages as $bin => $l)
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-right">Language Code:</label>
                                    <div class="col-lg-6">
                                        <input type="text"  value="{{ $l->language_code }}" disabled>
                                        <input type="hidden" name="data[{{ $bin }}][language_id]" value="{{ $l->id }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-right">Product Name {{ $l->language_code }}</label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                               name="data[{{ $bin }}][name]"
                                               required
                                               class="form-control"
                                               placeholder="Product Name {{ $l->language_code }}*"
                                               value="{{ (isset($data)) ? $data->translations->where('language_id', $l->id)->first()->name ?? '' : old("data.$bin.name") }}">
                                        @error('data.'.$bin.'.name')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-right">Product Description {{ $l->language_code }}</label>
                                    <div class="col-lg-6">
                                        <textarea
                                            name="data[{{ $bin }}][description]"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Product Description {{ $l->language_code }}"
                                        >{{ (isset($data)) ? $data->translations->where('language_id', $l->id)->first()->description ?? '' : old("data.$bin.description") }}</textarea>
                                        @error('data.'.$bin.'.description')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr/>
                            @endforeach

                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-lg btn-outline-primary">{{ isset($data) ? 'Update' : 'Create' }} Product</button>
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
