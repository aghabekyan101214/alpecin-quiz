@extends("layouts.quiz-layout")

@section("container")
    <div class="wrapper position-relative overflow-hidden">
        <!-- Top content -->
        <div class="container">
            <div class="logo_area pt-5">
                <a href="index.html">
                    <img src="{{ asset("quiz-assets/images/logo/logo.png") }}" alt="image-not-found">
                </a>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div class="container">
            <form class="multisteps_form" id="wizard" method="POST" action="{{ route("quiz.start", ["lang" => app()->getLocale()]) }}">
                @csrf
                <!------------------------- Step-1 ----------------------------->
                <div class="multisteps_form_panel">
                    <div class="content_box shadow text-center justify-content-center bg-white d-flex py-5 position-relative">
                        {{--                        <div class="form_timer d-flex flex-column rounded-pill position-absolute countdown_timer" data-countdown="2022/10/24"></div>--}}
                        <div class="question_title p-2 text-center">
                            <h1 class="text-center">{{ __("quiz.start_quiz") }}</h1>
                            <ul>
                                @foreach(App\Models\Language::all() as $l)
                                    <a href="{{ route(\Request::route()->getName(), $l->language_code) }}"><li style="display: inline-block"><img class="img-fluid" style="height: 22px; width: 22px" src="{{ asset($l->icon) }}" alt=""></li></a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="left_side_img d-none d-md-block col-md-4">
                        </div>
                    </div>
                </div>

                <div class="row pt-5 flex-column">
                    <div class="col-md-12 text-center">

                        <button class="f_btn next_btn text-white text-uppercase mt-2" id="nextBtn">{{ __("quiz.start") }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
