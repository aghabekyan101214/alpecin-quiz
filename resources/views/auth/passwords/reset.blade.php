@extends('layouts.siteAuth')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-12 pt-4 pb-4 white-bg col-xl-7 offset-center title">
            <h3 id="ContactUs" class="white bold">Reset Password</h3>
            <form method="POST" action="{{ route('password.update') }}">

                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="row">

                    <div class="col-12 col-lg-9 text-center offset-center mb-2">
                        <input type="hidden" value="{{ $email ?? old('email') }}" placeholder="Enter email address" name="email" autocomplete="email" autofocus class="form-control">
                        @error('email')
                        <small class="error float-left">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-9 text-center offset-center mb-4">
                        <input type="password" placeholder="New Password" name="password" class="form-control">
                        @error('password')
                        <small class="error float-left">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-9 text-center offset-center mb-4">
                        <input type="password" placeholder="Confirm New Password" name="password_confirmation" class="form-control">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn-primary btn auth-btn bold">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
