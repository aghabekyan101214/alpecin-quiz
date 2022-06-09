<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title rel="nofollow">Studio Zard Admin</title>
    <meta name="description" content="User login example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!--end::Fonts -->

    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

    <!--begin::Page Vendors Styles(used by this pages) -->

    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "metal": "#c4c5d6",
                    "light": "#ffffff",
                    "accent": "#00c5dc",
                    "primary": "#187de4",
                    "success": "#0bb7af",
                    "info": "#36a3f7",
                    "warning": "#ee9d01",
                    "danger": "#ee2d41",
                    "focus": "#9816f4"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="/">
            <img alt="Logo" src="{{asset('images/admin-logo.png')}}" style="width: 50px" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->

<!-- begin:: Root -->
<div class="kt-grid kt-grid--hor kt-grid--root">

    <!-- begin:: Page -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

            <!-- begin::Aside Brand -->
            <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                <div class="kt-aside__brand-logo">
                    <a href="/">
                        <img alt="Logo" src="{{asset('images/admin-logo.png')}}" style="width: 50px" />
                    </a>
                </div>
                <div class="kt-aside__brand-tools">
                    <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
                </div>
            </div>

            <!-- end:: Aside Brand -->

            <!-- begin:: Aside Menu -->
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                    <ul class="kt-menu__nav">
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon-home"></i>
                                <span class="kt-menu__link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.users') }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon-users"></i>
                                <span class="kt-menu__link-text">Users</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.orders.index') }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon-star"></i>
                                <span class="kt-menu__link-text">Orders</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon-layers"></i>
                                <span class="kt-menu__link-text">Categories</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>

                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                                        <span class="kt-menu__link">
                                            <span class="kt-menu__link-text">Categories</span>
                                        </span>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.categories.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">All Categories</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.categories.create') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Add Category</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-shopping-cart-1"></i>
                                <span class="kt-menu__link-text">Products</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>

                            <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                                        <span class="kt-menu__link">
                                            <span class="kt-menu__link-text">Products</span>
                                        </span>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.products.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">All Products</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.products.create') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Add Product</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.groups.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Product Groups</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.productInfo') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Product Info</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route("admin.contact_users") }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-email"></i>
                                <span class="kt-menu__link-text">Contacts</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route("admin.subscriptions") }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon-users"></i>
                                <span class="kt-menu__link-text">Subscribers</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;void(0)" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-percentage"></i>
                                <span class="kt-menu__link-text">Promocodes</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>

                            <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                                        <span class="kt-menu__link">
                                            <span class="kt-menu__link-text">Promocodes</span>
                                        </span>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.promocodes.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">All Promocodes</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.promocodes.create') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Add Promocode</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route("admin.email") }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-email"></i>
                                <span class="kt-menu__link-text">Email</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.giftCard') }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-gift-1"></i>
                                <span class="kt-menu__link-text">Gift Card</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route("admin.best_sellers") }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-graphic"></i>
                                <span class="kt-menu__link-text">Best Sellers</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-shopping-cart-1"></i>
                                <span class="kt-menu__link-text">Gallery</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>

                            <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                                        <span class="kt-menu__link">
                                            <span class="kt-menu__link-text">Gallery</span>
                                        </span>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.gallery.index') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">All Images</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.gallery.create') }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Add Image</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.sizeInfo') }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-information"></i>
                                <span class="kt-menu__link-text">Size Info</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.about') }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-writing"></i>
                                <span class="kt-menu__link-text">About</span>
                            </a>
                        </li>
                        <li class="kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.contacts') }}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-location"></i>
                                <span class="kt-menu__link-text">Contact Us</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon-more-v5"></i>
                                <span class="kt-menu__link-text">More</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                                        <span class="kt-menu__link">
                                            <span class="kt-menu__link-text">More</span>
                                        </span>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.static-info', \App\Models\StaticInfo::TYPE_SHIPPING) }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Shipping</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.static-info', \App\Models\StaticInfo::TYPE_RETURNS) }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Returns</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item" aria-haspopup="true">
                                        <a href="{{ route('admin.static-info', \App\Models\StaticInfo::TYPE_PRODUCT_CARE) }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Product Care</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item" aria-haspopup="true">
                                        <a href="{{ route('admin.static-info', \App\Models\StaticInfo::TYPE_TERMS) }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Terms</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item" aria-haspopup="true">
                                        <a href="{{ route('admin.static-info', \App\Models\StaticInfo::TYPE_PRIVACY) }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Privacy Policy</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item" aria-haspopup="true">
                                        <a href="{{ route('admin.static-info', \App\Models\StaticInfo::TYPE_MOBILE_SETTINGS) }}" class="kt-menu__link">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Mobile Main block</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- end:: Aside Menu -->
        </div>

        <!-- end:: Aside -->

        <!-- begin:: Wrapper -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                <div></div>
                <!-- begin:: Header Topbar -->
                <div class="kt-header__topbar">
                    <!--begin: User Bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <!--use "kt-rounded" class for rounded avatar style-->
                            <div class="kt-header__topbar-user kt-rounded-" style="width: 125px;">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi, Admin</span>
                                <span class="kt-header__topbar-username kt-hidden-mobile"></span>
                                <img src="{{asset('images/avatar.svg')}}" class="kt-rounded-" />
                                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                <span class="kt-badge kt-badge--username kt-badge--lg kt-badge--brand kt-hidden kt-badge--bold">S</span>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-sm">
                            <div class="kt-user-card kt-margin-b-40 kt-margin-b-30-tablet-and-mobile" style="background-image: url({{asset('assets/media/misc/head_bg_sm.jpg')}})">
                                <div class="kt-user-card__wrapper">
                                    <div class="kt-user-card__pic">
                                        <!--use "kt-rounded" class for rounded avatar style-->
                                        <img src="{{asset('images/avatar.svg')}}" class="kt-rounded-" style="border-radius: 0;width: 50px;"/>
                                    </div>
                                    <div class="kt-user-card__details">
                                        <div class="kt-user-card__name">Admin Name</div>
                                        <div class="kt-user-card__position">Admin</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="kt-nav kt-margin-b-10">
                                <li class="kt-nav__custom kt-space-between">
                                    <a class="btn btn-label-brand btn-upper btn-sm btn-bold" href="#"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">Logout
                                    </a>
                                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end: User Bar -->
                </div>
                <!-- end:: Header Topbar -->
            </div>
            <!-- end:: Header -->

            @yield('content')

        </div>
        <!-- end:: Wrapper -->
    </div>
    <!-- end:: Page -->
</div>
<!-- end:: Root -->


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Scripts -->

<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')

</body>
</html>
