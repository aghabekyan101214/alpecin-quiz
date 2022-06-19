@extends('layouts.admin')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ isset($data) ? 'Edit' : 'Add' }} Combination</h3>
                    </div>
                </div>
                @error('general')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
                <div class="kt-portlet__body">
                    <form method="post" action="{{ !isset($data) ? route('admin.combinations.store') : route('admin.combinations.update', $data->id) }}" enctype="multipart/form-data" class="kt-form">
                        @isset($data) @method('PUT') @endisset
                        @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Select Products</label>
                                <div class="col-lg-6">
                                    <select multiple required name="product_ids[]" class="form-control kt-select2" id="my-kt_select2_1">
                                        <option value="">Select Products</option>
                                        @foreach($products as $p)
                                            <option {{ !is_null(old('product_ids')) ? in_array($p->id, old('product_ids')) ? 'selected' : '' : (isset($data) && in_array($p->id, $data->products->pluck('product_id')->toArray()) ? 'selected' : '' ) }} value="{{ $p->id }}">{!! $p->translations_string() !!}</option>
                                        @endforeach
                                    </select>
                                    @error('product_ids.*')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Combination Name</label>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Combination Name*" name="name" value="{{ old('name') ?? ((isset($data)) ? $data->name : "") }}" required class="form-control">
                                    @error('name')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr/>
                            <div class="col-lg-12">
                                <h5 class="text-center">Select Answers Combinations</h5>
                            </div>
                            <div class="form-group row">
                                @foreach($questions as $bin => $q)
                                    <div class="col-lg-3">
                                        <label class="form-label">{{ $q->translations_string('question') }}</label>
                                        <select name="answer_ids[]" class="form-control">
                                            <option value="">Select Answer</option>
                                            @foreach($q->answers as $t)
                                                <option {{ !is_null(old('answer_ids')) && in_array($t->id, old('answer_ids')) ? 'selected' : (isset($data) && in_array($t->id, $data->answers->pluck("quizzes_questions_answer_id")->toArray()) ? 'selected' : '' ) }} value="{{ $t->id }}">{{ $t->translations_string('answer') }}</option>
                                            @endforeach
                                        </select>
                                        @error("answer_ids.$bin")
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>

                                @endforeach
                            </div>

                        <div class="form-group row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-lg btn-outline-primary">{{ isset($data) ? 'Update' : 'Create' }} Combination</button>
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
