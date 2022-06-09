@extends('layouts.app')

@section('content')
<div id="verify">
    <div class="row justify-content-center">
        <div class="verify_content">
            <div class="card-header">{{ __('Verify Your Email Address') }}</div>
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
            </div>
            <div class="card-footer flex flex-ai-center">
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to request another') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
