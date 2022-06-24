@extends('layouts.admin')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>
        @error("general")
        @enderror
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ isset($data) ? 'Edit' : 'Add' }} Depending Question</h3>
                    </div>
                </div>
                @error('general')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
                <div class="kt-portlet__body">
                    <form method="post" action="{{ !isset($data) ? route('admin.depending_questions.store') : route('admin.depending_questions.update', $data->id) }}" enctype="multipart/form-data" class="kt-form">
                        @isset($data) @method('PUT') @endisset
                        @csrf
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="form-label">Select Answer</label>
                                    <select name="answer_id" class="form-control">
                                        <option value="">Select Answer</option>
                                        @foreach($answers as $t)
                                            <option {{ isset($data) && $data->answer_id == $t->id ? 'selected' : (old("answer_id") == $t->id ? 'selected' : '') }} value="{{ $t->id }}">{{ $t->translations_string('answer') }}</option>
                                        @endforeach
                                    </select>
                                    @error("answer_id")
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="form-label">Select Depending Question</label>
                                    <select name="question_id" class="form-control">
                                        <option value="">Select Depending Question</option>
                                        @foreach($questions as $t)
                                            <option {{ isset($data) && $data->question_id == $t->id ? 'selected' : (old("question_id") == $t->id ? 'selected' : '') }} value="{{ $t->id }}">{{ $t->translations_string('question') }}</option>
                                        @endforeach
                                    </select>
                                    @error("question_id")
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-lg btn-outline-primary">{{ isset($data) ? 'Update' : 'Create' }} Depending Question</button>
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
    <script src="{{asset('assets/js/pages/components/forms/widgets/my-select.js')}}" type="text/javascript"></script>
@endsection
