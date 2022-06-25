@extends("layouts.quiz-layout")

@section("container")
    <style>
        .content_box {
            height: inherit;
        }
    </style>
    <div class="wrapper position-relative overflow-hidden">
        <!-- Top content -->
        <div class="container">
            <div class="logo_area pt-5">
                <a href="index.html">
                    <img src="{{ asset("quiz-assets/images/logo/logo.png") }}" alt="image-not-found">
                </a>
            </div>
{{--            <div class="step_progress">--}}
{{--                <div class="d-flex overflow-hidden">--}}
{{--                    <div class="col-2">--}}
{{--                        <div class="step d-inline-block position-relative rounded-pill active"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-2 me-auto">--}}
{{--                        <div class="step d-inline-block position-relative rounded-pill"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-2 text-end">--}}
{{--                        <div class="step d-inline-block position-relative rounded-pill"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-2 text-end">--}}
{{--                        <div class="step d-inline-block position-relative rounded-pill"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div class="container">
            <form class="multisteps_form" id="wizard" method="POST" action="{{ route("quiz.answer_question", ["lang" => app()->getLocale()]) }}">
                <!------------------------- Step-1 ----------------------------->
                @csrf
                <input type="hidden" name="session_id" value="{{ $session_id }}">
                <input type="hidden" name="question_id" value="{{ $question->question->id }}">
                <div class="multisteps_form_panel">
                    <div class="content_box shadow justify-content-center text-center bg-white d-flex py-5 position-relative">
{{--                        <div class="form_timer d-flex flex-column rounded-pill position-absolute countdown_timer" data-countdown="2022/10/24"></div>--}}
                        <div class="question_title">
                            <h1>{{ $question->question->translations_string("question") }}</h1>
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p style="color: #dc3545">{{ __("quiz.answer_error") }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-5">
                        <div class="left_side_img d-none d-md-block col-md-4">
{{--                            <img src="{{ asset("quiz-assets/images/background/car.png") }}" alt="image-not-found">--}}
                        </div>
                        <div class="col-md-4">
                            <div class="form_items overflow-hidden">
                                <ul class="list-unstyled text-center p-0">
                                    @foreach($question->question->answers as $bin => $a)
                                        <li>
                                            <label class="step_1 position-relative bg-white shadow animate__animated animate__fadeInRight animate_{{ 50 * ($bin + 1) }}ms" for="opt_{{ $bin }}">{{ $a->translations_string("answer") }}
                                                <input type="radio" id="opt_{{ $bin }}" name="answer_id" value="{{ $a->id }}">
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 flex-column">
                    <div class="col-md-12 text-center">
                        <button class="f_btn next_btn text-white text-uppercase mt-2" id="nextBtn">{{ __("quiz.next") }}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
