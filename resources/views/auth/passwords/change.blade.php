@extends('layouts.siteAuth')
{{--@extends('layouts.app')--}}

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->two_factor_expiry > \Carbon\Carbon::now())
        @include('site.components.mixed.header')
        <style>
            .logo-container{
                display: none;
            }
        </style>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pb-4 white-bg col-xl-7 offset-center title">
                <h3 id="ContactUs" class="black bold">Change Password</h3>
                <form method="POST" action="{{ route('passChange') }}">
                    @csrf
                    <div class="row">

                        <div class="col-12 col-lg-9 text-center offset-center mb-4">
                            <input type="password" placeholder="Current Password" name="current_password" class="form-control">
                            @error('current_password')
                            <small class="error float-left">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-9 text-center offset-center mb-4">
                            <input type="password" placeholder="New Password" name="new_password" class="form-control">
                            @error('new_password')
                            <small class="error float-left">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-9 text-center offset-center mb-4">
                            <input type="password" placeholder="Confirm Password" name="new_password_confirmation" class="form-control">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center mt-4">
                            <button type="submit" class="btn-primary btn auth-btn bold">Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@push('foot')
    <!-- Sidebar Js -->
    <script src="{{ asset("site/plugins/sidebar/src/jquery.sidebar.min.js") }}"></script>
@endpush
@endsection
