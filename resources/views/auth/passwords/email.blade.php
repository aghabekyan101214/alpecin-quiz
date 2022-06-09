@extends('layouts.siteAuth')

@section('content')

    <script>
        @if (session('status'))
            window.location.href = "/login";
        @endif
    </script>
    @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success" style="top: 0" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row ">
            <div class="col-12 pt-4 pb-4 white-bg col-xl-7 offset-center title">
                <h3 id="ContactUs" class="black bold">Reset Password</h3>
                <form method="POST" action="{{ route('password.email') }}">

                    @csrf
                    <div class="row">

                        <div class="col-12 col-lg-9 text-center offset-center mb-2">
                            <input type="email" value="{{ old('email') }}" placeholder="Enter email address" name="email" class="email form-control">
                            @error('email')
                            <small class="error float-left">{{ $message }}</small>
                            @enderror
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
