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
            <form class="multisteps_form" id="wizard" method="POST" action="../thankyou/index-2.html">
                <!------------------------- Step-1 ----------------------------->
                <div class="multisteps_form_panel">
                    <div class="content_box shadow text-center bg-white d-flex py-5 position-relative">
{{--                        <div class="form_timer d-flex flex-column rounded-pill position-absolute countdown_timer" data-countdown="2022/10/24"></div>--}}
                        <div class="question_title p-2">
                            <h1>Computer Hard Disk was First introduces in 1956 by</h1>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="left_side_img d-none d-md-block col-md-4">
{{--                            <img src="{{ asset("quiz-assets/images/background/car.png") }}" alt="image-not-found">--}}
                        </div>
                        <div class="col-md-4">
                            <div class="form_items overflow-hidden">
                                <ul class="list-unstyled text-center p-0">
                                    <li>
                                        <label class="step_1 position-relative bg-white shadow animate__animated animate__fadeInRight animate_50ms active" for="opt_1">Dell
                                            <input type="radio" id="opt_1" name="stp_1_select_option" value="Dell" checked>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_1 position-relative bg-white shadow animate__animated animate__fadeInRight animate_100ms" for="opt_2">Apple
                                            <input type="radio" id="opt_2" name="stp_1_select_option" value="Apple">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_1 position-relative bg-white shadow animate__animated animate__fadeInRight animate_150ms" for="opt_3">Microsoft
                                            <input type="radio" id="opt_3" name="stp_1_select_option" value="Microsoft">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_1 position-relative bg-white shadow animate__animated animate__fadeInRight animate_200ms" for="opt_4">IBM
                                            <input type="radio" id="opt_4" name="stp_1_select_option" value="IBM">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------- Step-2 ----------------------------->
                <div class="multisteps_form_panel">
                    <div class="content_box shadow text-center bg-white d-flex py-5 position-relative">
                        <div class="form_timer d-flex flex-column rounded-pill position-absolute countdown_timer" data-countdown="2022/10/24">
                        </div>
                        <div class="question_title p-2">
                            <h1>The largest country of the world by geographical area is</h1>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="left_side_img d-none d-md-block col-md-4">
                            <img src="./assets/images/background/car.png" alt="image-not-found">
                        </div>
                        <div class="col-md-4">
                            <div class="form_items">
                                <ul class="list-unstyled text-center p-0">
                                    <li>
                                        <label class="step_2 position-relative bg-white shadow animate__animated animate__fadeInRight animate_50ms" for="opt_5">Vatican City
                                            <input type="radio" id="opt_5" name="stp_2_select_option" value="Vatican City" checked>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_2 position-relative bg-white shadow animate__animated animate__fadeInRight animate_100ms" for="opt_6">Australia
                                            <input type="radio" id="opt_6" name="stp_2_select_option" value="Australia">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_2 position-relative bg-white shadow animate__animated animate__fadeInRight animate_150ms" for="opt_7">New york City
                                            <input type="radio" id="opt_7" name="stp_2_select_option" value="New york City">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_2 position-relative bg-white shadow animate__animated animate__fadeInRight animate_200ms" for="opt_8">Russia
                                            <input type="radio" id="opt_8" name="stp_2_select_option" value="Russia">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------- Step-3 ----------------------------->
                <div class="multisteps_form_panel">
                    <div class="content_box shadow text-center bg-white d-flex py-5 position-relative">
                        <div class="form_timer d-flex flex-column rounded-pill position-absolute countdown_timer" data-countdown="2022/10/24">
                        </div>
                        <div class="question_title p-2">
                            <h1>The infrared radiation by sun are strongly absorbed by</h1>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="left_side_img d-none d-md-block col-md-4">
                            <img src="./assets/images/background/car.png" alt="image-not-found">
                        </div>
                        <div class="col-md-4">
                            <div class="form_items">
                                <ul class="list-unstyled text-center p-0">
                                    <li>
                                        <label class="step_3 position-relative bg-white shadow animate__animated animate__fadeInRight animate_50ms" for="opt_9">water vapours
                                            <input type="radio" id="opt_9" name="stp_3_select_option" value="water vapours" checked>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_3 position-relative bg-white shadow animate__animated animate__fadeInRight animate_100ms" for="opt_10">water vapours
                                            <input type="radio" id="opt_10" name="stp_3_select_option" value="water vapours">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_3 position-relative bg-white shadow animate__animated animate__fadeInRight animate_150ms" for="opt_11">Microsoft
                                            <input type="radio" id="opt_11" name="stp_3_select_option" value="Microsoft">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_3 position-relative bg-white shadow animate__animated animate__fadeInRight animate_200ms" for="opt_12">IBM
                                            <input type="radio" id="opt_12" name="stp_3_select_option" value="IBM">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------- Step-4 ----------------------------->
                <div class="multisteps_form_panel">
                    <div class="content_box shadow text-center bg-white d-flex py-5 position-relative">
                        <div class="form_timer d-flex flex-column rounded-pill position-absolute countdown_timer" data-countdown="2022/10/24">
                        </div>
                        <div class="question_title p-2">
                            <h1>Computer Hard Disk was First introduces in 1956 by</h1>
                        </div>
                    </div>
                    <div class="row mt-5 text-center">
                        <div class="left_side_img d-none d-md-block col-md-4">
                            <img src="./assets/images/background/car.png" alt="image-not-found">
                        </div>
                        <div class="col-md-4">
                            <div class="form_items">
                                <ul class="list-unstyled text-center p-0">
                                    <li>
                                        <label class="step_4 position-relative bg-white shadow animate__animated animate__fadeInRight animate_50ms" for="opt_13">Dell
                                            <input type="radio" id="opt_13" name="stp_4_select_option" value="Dell">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_4 position-relative bg-white shadow animate__animated animate__fadeInRight animate_100ms" for="opt_14">Apple
                                            <input type="radio" id="opt_14" name="stp_4_select_option" value="Apple">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_4 position-relative bg-white shadow animate__animated animate__fadeInRight animate_150ms" for="opt_15">Microsoft
                                            <input type="radio" id="opt_15" name="stp_4_select_option" value="Microsoft">
                                        </label>
                                    </li>
                                    <li>
                                        <label class="step_4 position-relative bg-white shadow animate__animated animate__fadeInRight animate_200ms" for="opt_16">IBM
                                            <input type="radio" id="opt_16" name="stp_4_select_option" value="IBM">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!------------------------- Form button ----------------------------->
            <div class="row pt-5 float-lg-end flex-column">
                <button type="button" class="f_btn prev_btn bg-white border text-uppercase" id="prevBtn" onclick="nextPrev(-1)"><span><i class="fas fa-arrow-left"></i></span> Last Question</button>
                <button type="button" class="f_btn next_btn text-white text-uppercase mt-2" id="nextBtn"
                        onclick="nextPrev(1)">Next</button>
            </div>
        </div>
    </div>
@endsection
