"use strict";

$(document).ready(function () {

    const burgerMenu = $('.burger_menu a');
    const shopMenu = $('.shop_menu');
    const basket = $('.basket_menu');
    const basketOpenBtn = $('.basket_open_btn');
    const basketCloseBtn = $('.close_basket_btn');
    // const discountBanner = $('.discount-banner');

    //Burger Menu Event
    burgerMenu.click( function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        shopMenu.toggleClass('show');
        // discountBanner.toggleClass('hide');
        $('html').toggleClass('no-scroll');
        $('body').toggleClass('no-scroll');
        e.stopPropagation();
    });

    //Shop menu
    shopMenu.click( e => e.stopPropagation() );

    //Body click close menus Event
    $('body').click( () => {
        burgerMenu.removeClass('active');
        shopMenu.removeClass('show');
        basket.removeClass('open');
        $('html').removeClass('no-scroll');
        $('body').removeClass('no-scroll');
    });

    //Contact open
    /*$('.nav_contact_btn').click( (e) => {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.contact_menu').toggleClass('show');
        $('body').toggleClass('overflow');
    });*/


    //Open Basket
    basket.click( e => e.stopPropagation() );

    //Basket open Event
    basketOpenBtn.click( (e) => {
        e.preventDefault();
        e.stopPropagation();
        basket.addClass('open');
        $('html').addClass('no-scroll');
        $('body').addClass('no-scroll');
    });
    //Basket Close Event
    basketCloseBtn.click( (e) => {
        e.preventDefault();
        basket.removeClass('open');
        $('html').removeClass('no-scroll');
        $('body').removeClass('no-scroll');
    });

    //Product Slider
    if( $('div').hasClass('slider') ) { // checking if slider exists
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            dots: false,
            asNavFor: '.slider-nav',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        dots: true
                    }
                },
            ]
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true
        });
    }

    const headerHeight = $('header').height();
    /*const footerHeight = $('footer').height();*/
    const container = $('#container');
    const sign = $('#sign');
    const basketPage = $('#basket');
    const verify = $('#verify');
    const ordersPage = $('#orders');
    const sizeInfoPage = $('#size_info');
    const checkoutFinish = $('.checkout_finish');

    $(window).on('load resize', function () {
        container.css('min-height', $(this).height() - headerHeight - 2);
        sign.css('min-height', $(this).height() - headerHeight - 2);
        verify.css('min-height', $(this).height() - headerHeight - 2);
        basketPage.css('min-height', $(this).height() - headerHeight - 2);
        ordersPage.css('min-height', $(this).height() - headerHeight - 2);
        checkoutFinish.css('min-height', $(this).height() - headerHeight - 2);
        sizeInfoPage.css('min-height', $(this).height() - headerHeight - 2);
    });


    /*Shipping and Returns Tab*/

    const tabBtn = $('.shipping_returns__tab .tab_btn');

    tabBtn.click(function() {
        let tab_id = $(this).attr('id');
        tabClick(tab_id)
    });
    function tabClick(tab_id) {
        if (tab_id !== $('.shipping_returns__tab .tab_btn.active').attr('id') ) {
            tabBtn.removeClass('active');
            $('#'+tab_id).addClass('active');
            $('.tab_block').removeClass('active');
            $('#con_'+ tab_id).addClass('active');
        }
    }
    /*Shipping and Returns Tab*/


    $('#register-checkbox').change(function () {
        if($('#register-checkbox')[0].checked) {
            $('.register_btn').removeClass('disabled').attr('disabled', false);
        } else {
            $('.register_btn').addClass('disabled').attr('disabled', true);
        }
    });

    $('#privacy-checkbox').change(function () {
        if($('#privacy-checkbox')[0].checked) {
            $('.subscribe_button').removeClass('disabled').attr('disabled', false);
        } else {
            $('.subscribe_button').addClass('disabled').attr('disabled', true);
        }
    });


    let shippingCheckbox1 = $('#shipping1');
    let shippingCheckbox2 = $('#shipping2');
    let shippingCheckbox3 = $('#shipping3');
    const shippingForm = $('.shipping_from');

    shippingCheckbox1.change( function() {
        shippingForm.removeClass('checked');
        $(this).parents('.shipping_item').find('.shipping_checked').addClass('checked');
    });
    shippingCheckbox2.change( function() {
        $('.shipping_checked').removeClass('checked');
        shippingForm.addClass('checked');
    });
    shippingCheckbox3.change( function() {
        $('.shipping_checked').removeClass('checked');
        shippingForm.addClass('checked');
    });


    let paymentCheckbox = $('.payment_item input[type="radio"]');
    paymentCheckbox.change( function() {
        $('.payment_checked').removeClass('checked');
        $(this).parents('.payment_item').find('.payment_checked').addClass('checked');
    });

});
