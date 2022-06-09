@extends('layouts.app')

@section('content')
    <section id="container">
        <div class="wrapper">
            <div class="container flex">
                <div class="container__leftMenu">
                    <ul>
                        <li>
                            <a href="{{ route("user_details") }}" class="{{ request()->routeIs('user_details') ? 'active' : '' }}">MY DETAILS</a>
                        </li>
                        <li>
                            <a href="{{ route("address_book") }}" class="{{ request()->routeIs('address_book') ? 'active' : '' }}">ADDRESS BOOK</a>
                        </li>
                    </ul>
                </div>
                <div class="container__center">
                    <div class="account">
                        @yield('user_content')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
