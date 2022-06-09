@extends('layouts.admin')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <br>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ isset($data) ? 'Edit' : 'Add' }} Language</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" action="{{ !isset($data) ? route('admin.languages.store') : route('admin.languages.update', $data->id) }}" enctype="multipart/form-data" class="kt-form">
                        @isset($data) @method('PUT') @endisset
                        @csrf
                        <div class="form-group row">
                            <label for="file" class="col-lg-3 col-form-label text-lg-right">Upload Language Icon:</label>
                            <div class="col-lg-6">
                                <input type="file" id="file-input" name="icon" />
                                @error('icon')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                                <div id="thumb-output">
                                    @if(isset($data) && !is_null($data->icon))
                                        <img src="{{ asset('uploads/' . $data->icon) }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Language Code:</label>
                            <div class="col-lg-6">
                                <input type="text"
                                       name="language_code"
                                       class="form-control"
                                       placeholder="Language Code*"
                                       value="{{ $data->language_code ?? old('language_code') }}">
                                @error('language_code')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-lg btn-outline-primary">{{ isset($data) ? 'Update' : 'Create' }} Language</button>
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
