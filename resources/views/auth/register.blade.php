@extends('layouts.app')

@section('content')
<div class="container">
    <div class="sectTitle">
        <h3 id="ContactUss">Register</h3>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <div class="formRow col-12 col-md-6 iconL @error('first_name') error-message @enderror pl-md-0">
                <input type="text" class="formControl" value="{{ old("first_name") }}" placeholder="First name" required name="first_name">
                @error('first_name')
                <span class="inputError" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <i class="icon-user"></i>
            </div>

            <div class="formRow col-12 col-md-6 iconL @error('last_name') error-message @enderror pl-md-0">
                <input type="text" class="formControl" value="{{ old("last_name") }}" placeholder="Last Name" required name="last_name">
                @error('last_name')
                <span class="inputError" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <i class="icon-user"></i>
            </div>

            <div class="formRow col-12 col-md-12 iconL @error('email') error-message @enderror pl-md-0">
                <input type="email" class="formControl" value="{{ old("email") }}" placeholder="Email" required name="email">
                @error('email')
                <span class="inputError" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <i class="icon-user"></i>
            </div>

            <div class="formRow col-12 col-md-6 iconL @error('password') error-message @enderror pl-md-0">
                <input type="password" class="formControl" placeholder="Password" required name="password">
                @error('password')
                <span class="inputError" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <i class="icon-user"></i>
            </div>

            <div class="formRow col-12 col-md-6 iconL @error('password_confirmation') error-message @enderror pl-md-0">
                <input type="password" class="formControl" placeholder="Confirm Your Password" required name="password_confirmation">
                @error('password_confirmation')
                <span class="inputError" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <i class="icon-user"></i>
            </div>

            <div class="clearAfter col-md-3 col-12 pl-md-0 contactActions">
                <button type="submit" class="btn btnBorder btnBlock lg">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection
