"use strict";

$(document).ready(function () {

    const step1Btn = $('.basket .step1_btn');
    const step2Btn = $('.basket .step2_btn');
    const step3Btn = $('.basket .step3_btn');
    const step1 = $('.checkout_step1');
    const step2 = $('.checkout_step2');
    const step3 = $('.checkout_step3');
    const backBtn1 = $('.goBack_btn1');
    const backBtn2 = $('.goBack_btn2');
    const discount = $('.basket .discount');
    const discount_info = $('.basket .discount_code_info');
    const checkbox = $('.basket .checkbox');
    const codeMessage = $('.basket .promotional_code');
    const paymentRadio = $('.payment_method_list input[name="payment_radio"]');
    const shippingRadio = $('.shipping_list input[name="shipping_radio"]');
    const shippingRadioDelivery = $('.shipping_radio_form[name="shipping_radio"]');
    const firstName = $('.shipping_from input[name="first_name"]');
    const lastName = $('.shipping_from input[name="last_name"]');
    const country = $('.shipping_from input[name="country_region"]');
    const city = $('.shipping_from input[name="city"]');
    const postCode = $('.shipping_from input[name="post_code"]');
    const address = $('.shipping_from input[name="address"]');
    const apartment = $('.shipping_from input[name="apartment"]');
    const email = $('.shipping_from input[name="email"]');
    const phone = $('.shipping_from input[name="phone"]');
    const privacyCheckbox = $('#check_for_checkout_accept');
    const form = $('#checkout-form');

    /*Scroll to top, when step changes*/
    function scrollToTop() {
        window.scrollTo(0, 0);
    }

    /*To last step*/
    const lastStep = () => {
        step2Btn.removeClass('show');
        step3Btn.addClass('show');
        step2.hide();
        step3.show();
        discount.removeClass('show');
        discount_info.hide();
        checkbox.show();
        scrollToTop();
    }

    /*Step 2 Checkbox Validation*/
    let validationStep2 = () => {
        let shippingRadioIsChecked = shippingRadio.is(':checked');
        let paymentRadioIsChecked = paymentRadio.is(':checked');
        let shippingRadioDeliveryIsChecked = shippingRadioDelivery.is(':checked');
        if (shippingRadioIsChecked) {
            if (paymentRadioIsChecked) {
                if (shippingRadioDeliveryIsChecked) {
                    switch (true) {
                        case (firstName.val() === ""):
                            $('.first-name-error').show();
                            break;
                        case (lastName.val() === ""):
                            $('.last-name-error').show();
                            break;
                        case (country.val() === ""):
                            $('.country-error').show();
                            break;
                        case (city.val() === ""):
                            $('.city-error').show();
                            break;
                        case (postCode.val() === ""):
                            $('.post-code-error').show();
                            break;
                        case (address.val() === ""):
                            $('.address-error').show();
                            break;
                        case (apartment.val() === ""):
                            $('.apartment-error').show();
                            break;
                        case (email.val() === ""):
                            $('.email-error').show();
                            break;
                        case (phone.val() === ""):
                            $('.phone-error').show();
                            break;
                        default:
                            lastStep();
                    }
                } else {
                    lastStep();
                }
            } else {
                $('.step2_payment').find('.error').show();
            }
        } else {
            $('.step2_shipping').find('.error').show();
        }
    }

    const privacyCheckboxValidate = () => {
        let privacyCheckboxIsChecked = privacyCheckbox.is(':checked');
        if(privacyCheckboxIsChecked) {
            form.submit();
        } else {
            step3Btn.attr('disabled', false);
            $('.checkbox .error').show();
        }
    }

    /*Checkbox error hide, when checkbox is checked*/
    $('.shipping_list input').change(function () {
        let shippingRadioIsChecked = shippingRadio.is(':checked');
        let shippingMethod = '';
        let checkedShippingRadio = $('.shipping_list input[name="shipping_radio"]:checked');
        if(checkedShippingRadio.val() === "1") {
            shippingMethod = "PIC-UP FROM OUR STUDIO";
            $('.step3_shipping .message').show();
        } else if (checkedShippingRadio.val() === "2") {
            shippingMethod = "DELIVERY TO SPEEDY OFFICE";
            $('.step3_shipping .message').hide();
        } else if (checkedShippingRadio.val() === "3") {
            shippingMethod = "DELIVERY BY SPEEDY TO YOUR ADDRESS";
            $('.step3_shipping .message').hide();
        }
        $('.step3_shipping .selected_shipping_method').text(shippingMethod);
        if (shippingRadioIsChecked) {
            $('.step2_shipping').find('.error').hide();
        }
    });
    $('.payment_method_list input').change(function () {
        let paymentRadioIsChecked = paymentRadio.is(':checked');
        let paymentMethod = '';
        let checkedPaymentRadio = $('.payment_method_list input[name="payment_radio"]:checked');
        if(checkedPaymentRadio.val() === "1") {
            paymentMethod = "BANK TRANSFER";
        } else if (checkedPaymentRadio.val() === "2") {
            paymentMethod = "REVOLUT";
        } else if (checkedPaymentRadio.val() === "3") {
            paymentMethod = "PAYPAL";
        }
        $('.step3_payment .selected_title b').text(paymentMethod);
        $('.step3_payment .message b').text(paymentMethod);
        if (paymentRadioIsChecked) {
            $('.step2_payment').find('.error').hide();
        }
    });

    /*First step click*/
    step1Btn.click(function (e) {
        e.preventDefault();
        step1Btn.removeClass('show');
        step2Btn.addClass('show');
        step1.hide();
        step2.show();
        discount.addClass('show');
        discount_info.show();
        codeMessage.hide();
        scrollToTop();
    });
    /*Second step click*/
    step2Btn.click(function(e) {
        e.preventDefault();
        validationStep2();
    });
    /*First step back click*/
    backBtn1.click((e) => {
        e.preventDefault();
        step1.show();
        step2.hide();
        step1Btn.addClass('show');
        step2Btn.removeClass('show');
        discount.removeClass('show');
        discount_info.hide();
        codeMessage.show();
        scrollToTop();
    });
    /*Second step back click*/
    backBtn2.click((e) => {
        e.preventDefault();
        step2.show();
        step3.hide();
        step2Btn.addClass('show');
        step3Btn.removeClass('show');
        discount.addClass('show');
        discount_info.show();
        checkbox.hide();
        scrollToTop();
    });
    step3Btn.click((e) => {
        e.preventDefault();
        $('.basket .step3_btn').attr('disabled', true);
        privacyCheckboxValidate();
    });

    //Digits function
    $.fn.digits = function(){
        return this.each(function(){
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
        })
    }
    //Only numbers
    phone.keypress(function (e) {
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    postCode.keypress(function (e) {
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    /*Only letters*/
    firstName.bind('keyup blur',function(){
        let node = $(this);
        node.val(node.val().replace(/[^a-z]/g,'') );
    });
    lastName.bind('keyup blur',function(){
        let node = $(this);
        node.val(node.val().replace(/[^a-z]/g,'') );
    });

});
