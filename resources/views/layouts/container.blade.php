@extends('layouts.app')

@section('content')
    <section id="container">
        <div class="wrapper">
            <div class="container flex flex-ai-center">
                <div class="container__leftMenu">
                    <ul>
                        <li>
                            <a class="{{ request()->routeIs('client.contact') ? 'active' : '' }}" href="{{ route('client.contact') }}">CONTACT US</a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('client.about') ? 'active' : '' }}" href="{{ route('client.about') }}">ABOUT</a>
                        </li>
{{--                        <li>--}}
{{--                            <a class="{{ request()->getUri() == route('client.information', \App\Models\StaticInfo::TYPE_SHIPPING_SLUG) ? 'active' : '' }}" href="{{ route('client.information', \App\Models\StaticInfo::TYPE_SHIPPING_SLUG) }}">SHIPPING</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="{{ request()->getUri() == route('client.information', \App\Models\StaticInfo::TYPE_RETURNS_SLUG) ? 'active' : '' }}" href="{{ route('client.information', \App\Models\StaticInfo::TYPE_RETURNS_SLUG) }}">RETURNS</a>--}}
{{--                        </li>--}}
                        <li>
                            <a class="{{ request()->getUri() == route('client.shipping_return') ? 'active' : '' }}" href="{{ route('client.shipping_return') }}">SHIPPING & RETURNS</a>
                        </li>
                        <li>
                            <a class="{{ request()->getUri() == route('client.information', \App\Models\StaticInfo::TYPE_TERMS_SLUG) ? 'active' : '' }}" href="{{ route('client.information', \App\Models\StaticInfo::TYPE_TERMS_SLUG) }}">TERMS</a>
                        </li>
                        <li>
                            <a class="{{ request()->getUri() == route('client.information', \App\Models\StaticInfo::TYPE_PRIVACY_SLUG) ? 'active' : '' }}" href="{{ route('client.information', \App\Models\StaticInfo::TYPE_PRIVACY_SLUG) }}">PRIVACY POLICY</a>
                        </li>
                    </ul>
                </div>
                @yield('container')
            </div>
        </div>
    </section>
@endsection
