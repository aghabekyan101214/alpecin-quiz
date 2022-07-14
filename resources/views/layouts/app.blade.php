<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/svg+xml" href="{{asset('images/admin-logo.png')}}">
    <title>Alpecin Quiz</title>
    @yield('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body @if(Request::is('/')) class="main-page" @endif>


@if(Request::is('/'))
    <div class="discount-banner">
        <div class="infinite-line"></div>
    </div>
@endif
<header>
    <div class="wrapper">
        <div class="flex flex-jc-sb flex-ai-center">
            <div class="head__left flex flex-ai-center">
                <div class="burger_menu">
                    <a href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <a href="{{route('client.home')}}" class="logo mobile_logo">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </a>
            </div>
            <a href="{{route('client.home')}}" class="logo">
                <img src="{{asset('images/logo.png')}}" alt="">
            </a>
            <div class="head__right flex">
                <ul class="flex flex-ai-center">
                    @auth('client')
                    <li>
                        <a href="{{ route('favorite_products') }}" class="favorites_btn">
                            <img src="{{asset('images/heart.svg')}}" alt="">
                            <span class="count-favorite-products count">{{ \App\Models\FavouriteProduct::get_products_count() > 0 ? \App\Models\FavouriteProduct::get_products_count() : '' }}</span>
                        </a>
                    </li>
                    @endauth
                    <li>
                        <a href="#" class="basket_open_btn">
                            <img src="{{asset('images/basket-icon.svg')}}" alt="">
                            <span class="count-cart-products count">{{ \App\Models\Cart::get_cart_count() > 0 ? \App\Models\Cart::get_cart_count() : '' }}</span>
                        </a>
                        @if ((!is_null(\Illuminate\Support\Facades\Auth::guard('client')->user()) && \Illuminate\Support\Facades\Auth::guard('client')->user()->cart()->count()) || (\App\Models\Cart::get_cart_count() && is_null(\Illuminate\Support\Facades\Auth::guard('client')->user())))
                            <div class="basket_menu @if(session('open-cart')) open @endif">
                                <div class="basket_title flex flex-jc-sb">
                                    <h6>CART ({{ \App\Models\Cart::get_cart_count() }})</h6>
                                    <a href="#" class="close_basket_btn">
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                                <div class="basket_empty_message">Your basket is empty</div>
                                <div class="basket_list">
                                    @foreach(\App\Models\Cart::get_cart_products() as $p)
                                        @php
                                            $product = isset($p->product) ? $p->product : $p;
                                            $size = $p->size;
                                        @endphp
                                        <div class="basket_item flex cart-item-{{ $product->id }}-{{ $size->id }}">
                                            <a href="{{ route('client.product_show', $product->id) }}" class="basket_item_image">
                                                <img src="{{ asset('uploads/' . $product->cover_image) }}" alt="{{ $product->name }}">
                                            </a>
                                            <div class="basket_item_info">
                                                <div class="name">{{ $product->name }}</div>
                                                <div class="metal_info">{{ $product->material_info }}</div>
                                                <div class="price">{{ $product->get_sign() }} {{ $product->get_price() }}</div>
                                                <button onclick="removeProductFromCart('{{ $product->id }}', '{{ $size->id }}', this)" class="remove_btn">REMOVE</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="basket_price_info flex flex-ai-center flex-jc-sb">
                                    <p>TOTAL</p>
                                    <span>{{ $product->get_sign() }} {{ \App\Models\Cart::get_cart_products_sum() }}</span>
                                </div>
                                <a href="{{ route('client.cart') }}" class="view_cart_btn">VIEW CART</a>
                                {{--<a href="#" class="checkout_btn">CHECKOUT</a>--}}
                            </div>
                        @else
                            <div class="hover-block">Your cart is currently empty.</div>
                        @endif
                    </li>
                    <li>
                        <a href="#" class="login_btn">
                            <img src="{{asset('images/user-icon.svg')}}" alt="">
                        </a>
                        @auth('client')
                            <div class="user_logedIn hover-block">
                                <div class="user_logedIn__top flex flex-ai-center flex-jc-sb">
                                    <div class="user_name">HI {{ \Illuminate\Support\Facades\Auth::guard('client')->user()->name }}</div>
                                    <form action="{{ route('auth.logout') }}" method="post">
                                        @csrf
                                        <button class="sign_out_btn">SIGN OUT</button>
                                    </form>
                                </div>
                                <ul>
                                    <li>
                                        <a href="{{ route('user_details') }}">My Account</a>
                                    </li>
                                    <li>
                                        <a href="{{ route("order_show") }}">Order Information</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('client.information', \App\Models\StaticInfo::TYPE_RETURNS_SLUG) }}">Return Information</a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="hover-block">
                                Please <a href="{{ route('auth.sign-in') }}"> LOGIN</a> or <a href="{{ route('auth.sign-up') }}"> REGISTER</a>
                            </div>
                        @endauth
                    </li>
                    {{--<li class="language">
                        <a href="#">BG</a> | <a href="#" class="active">ENG</a>
                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer>
    <div class="wrapper">
        <small>Made by hand {{ date("Y") }} <br> Since 2019</small>
        <ul class="social_links flex flex-jc-center">
            <li>
                <a href="https://www.facebook.com/Studio-Zard-101804258050478" target="_blank">
                    <img src="{{asset('images/facebook.png')}}" alt="Facebook">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/studiozard.eu/" target="_blank">
                    <img src="{{asset('images/instagram.png')}}" alt="Instagram">
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="#" target="_blank">--}}
{{--                    <img src="{{asset('images/pinterest.png')}}" alt="Pinterest">--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="https://api.whatsapp.com/send?phone=359896709673" target="_blank">
                    <img src="{{asset('images/whatsapp.png')}}" alt="WhatsApp">
                </a>
            </li>
        </ul>
        <nav>
            <ul class="foo_menu flex flex-jc-center">
                {{--<li>
                    <a href="{{ route('client.information', \App\Models\StaticInfo::TYPE_SHIPPING_SLUG) }}">Shipping</a>
                </li>--}}
                <li>
                    <a href="{{ route('client.shipping_return') }}">Shipping & Returns</a>
                </li>
                <li>
                    <a href="{{ route('client.information', \App\Models\StaticInfo::TYPE_PRODUCT_CARE_SLUG) }}">Product Care</a>
                </li>
                <li>
                    <a href="{{ route('client.contact') }}">Contact Us</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>

<div class="shop_menu">
    <div class="shop_menu__content">
        <div class="shop_menu__flex flex flex-jc-sb">
            <div class="shop_menu__categories">
                <ul>
                    @foreach($menu_categories ?? [] as $c)
                        <li>
                            <a href="{{ route('client.products_by_category', $c->id) }}">{{ $c->name }}</a>
                        </li>
                    @endforeach

                    {{--<li>
                        <a href="{{ route('client.gift_card') }}">GIFT CARD</a>
                    </li>--}}
                    <li>
                        <a href="{{ route('client.contact') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ route('client.about') }}">About</a>
                    </li>
                </ul>
            </div>
            <div class="shop_menu__best-seller flex">
                @foreach($menu_products ?? [] as $p)
                    @include('client.components.products.product-item', ['custom_class' => 'shop_menu__best-seller__item'])
                @endforeach
            </div>
        </div>
    </div>
</div>
@if(session('notification'))
    <div class="notification">
        <p>{{ session('notification') }}</p>
        <a href="javascript:void(0)" onclick="$(this).parents('.notification').remove();" class="close_notification_btn">
            <span></span>
            <span></span>
        </a>
    </div>
@endif

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@yield('scripts')
<script src="{{asset('js/script.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    makeProductFavourite = (productId, btn, e, removeFromDomElem = null) => {
        e.preventDefault();
        $.post('{{ route('client.mark_favourite') }}', {productId}, function(data) {
            if(data.success) {
                if(data.favorite) {
                    btn.addClass('active')
                }
                else {
                    btn.removeClass('active');
                    if(removeFromDomElem) {
                        $(btn).closest("." + removeFromDomElem).remove();
                    }
                }
                $(".count-favorite-products").html(data.count || '');
            }
        });
    }

    removeProductFromCart = (productId, size_id, btn) => {
        $.post('{{ route("client.remove_from_cart", 12345) }}'.replace(12345, productId), {size_id}, function (data) {
            $(`.cart-item-${productId}-${size_id}`).remove();
            $(".count-cart-products").html(data.count || '');
            $(".basket_title h6").html(`CART (${data.count})`);
            $(".basket_price_info span").html(`${data.price_info.sign}`.toUpperCase() + ` ${data.price_info.sum_price}`);

            let productItemCount = $('.basket_menu .basket_list .basket_item').length;
            if (productItemCount < 1) {
                $('.basket_menu').removeClass('open');
                $('.basket_menu .basket_price_info ').remove();
                $('.basket_menu .view_cart_btn ').remove();
                $('.basket_menu .basket_empty_message ').addClass('show');
            } else {
                $('.basket_menu .basket_price_info ').show();
                $('.basket_menu .view_cart_btn ').show();
                $('.basket_menu .basket_empty_message ').removeClass('show');
            }
        })
    }
</script>

</body>
</html>
