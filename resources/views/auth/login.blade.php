<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title rel="nofollow">Teleport admin</title>
    <meta name="description" content="User login example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!--end::Fonts -->

    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item   kt-grid__item--fluid kt-grid  kt-grid kt-grid--hor kt-login-v2" id="kt_login_v2">

        <!--begin::Item-->
        <div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">

            <!--begin::Body-->
            <div class="kt-login-v2__body">

                <!--begin::Wrapper-->
                <div class="kt-login-v2__wrapper">
                    <div class="kt-login-v2__container">
                        <div class="kt-login-v2__title">
                            <h3>Sign to Account</h3>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="kt-login-v2__form kt-form" id="kt_login_form">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Username" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="kt-login-v2__actions justify-content-center">
                                <button type="submit" class="btn btn-brand btn-elevate btn-pill" id="kt_login_submit">
                                    {{ __('Sign in') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <!--end::Wrapper-->

                <!--begin::Image-->
                <div class="kt-login-v2__image">
                    <img src="assets/media/misc/bg_icon.svg" alt="">
                </div>

                <!--begin::Image-->
            </div>

            <!--begin::Body-->
        </div>

        <!--end::Item-->

    </div>
</div>

<!-- end:: Page -->

</body>
</html>

