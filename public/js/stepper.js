(()=>{"use strict";$(document).ready((function(){var e=$(".basket .step1_btn"),s=$(".basket .step2_btn"),i=$(".basket .step3_btn"),t=$(".checkout_step1"),a=$(".checkout_step2"),n=$(".checkout_step3"),o=$(".goBack_btn1"),h=$(".goBack_btn2"),r=$(".basket .discount"),p=$(".basket .discount_code_info"),c=$(".basket .checkbox"),d=$(".basket .promotional_code"),l=$('.payment_method_list input[name="payment_radio"]'),m=$('.shipping_list input[name="shipping_radio"]'),u=$('.shipping_radio_form[name="shipping_radio"]'),_=$('.shipping_from input[name="first_name"]'),f=$('.shipping_from input[name="last_name"]'),k=$('.shipping_from input[name="country_region"]'),w=$('.shipping_from input[name="city"]'),v=$('.shipping_from input[name="post_code"]'),g=$('.shipping_from input[name="address"]'),b=$('.shipping_from input[name="apartment"]'),y=$('.shipping_from input[name="email"]'),C=$('.shipping_from input[name="phone"]'),D=$("#check_for_checkout_accept"),E=$("#checkout-form");function R(){window.scrollTo(0,0)}var O=function(){s.removeClass("show"),i.addClass("show"),a.hide(),n.show(),r.removeClass("show"),p.hide(),c.show(),R()};$(".shipping_list input").change((function(){var e=m.is(":checked"),s="",i=$('.shipping_list input[name="shipping_radio"]:checked');"1"===i.val()?(s="PIC-UP FROM OUR STUDIO",$(".step3_shipping .message").show()):"2"===i.val()?(s="DELIVERY TO SPEEDY OFFICE",$(".step3_shipping .message").hide()):"3"===i.val()&&(s="DELIVERY BY SPEEDY TO YOUR ADDRESS",$(".step3_shipping .message").hide()),$(".step3_shipping .selected_shipping_method").text(s),e&&$(".step2_shipping").find(".error").hide()})),$(".payment_method_list input").change((function(){var e=l.is(":checked"),s="",i=$('.payment_method_list input[name="payment_radio"]:checked');"1"===i.val()?s="BANK TRANSFER":"2"===i.val()?s="REVOLUT":"3"===i.val()&&(s="PAYPAL"),$(".step3_payment .selected_title b").text(s),$(".step3_payment .message b").text(s),e&&$(".step2_payment").find(".error").hide()})),e.click((function(i){i.preventDefault(),e.removeClass("show"),s.addClass("show"),t.hide(),a.show(),r.addClass("show"),p.show(),d.hide(),R()})),s.click((function(e){e.preventDefault(),function(){var e=m.is(":checked"),s=l.is(":checked"),i=u.is(":checked");if(e)if(s)if(i)switch(!0){case""===_.val():$(".first-name-error").show();break;case""===f.val():$(".last-name-error").show();break;case""===k.val():$(".country-error").show();break;case""===w.val():$(".city-error").show();break;case""===v.val():$(".post-code-error").show();break;case""===g.val():$(".address-error").show();break;case""===b.val():$(".apartment-error").show();break;case""===y.val():$(".email-error").show();break;case""===C.val():$(".phone-error").show();break;default:O()}else O();else $(".step2_payment").find(".error").show();else $(".step2_shipping").find(".error").show()}()})),o.click((function(i){i.preventDefault(),t.show(),a.hide(),e.addClass("show"),s.removeClass("show"),r.removeClass("show"),p.hide(),d.show(),R()})),h.click((function(e){e.preventDefault(),a.show(),n.hide(),s.addClass("show"),i.removeClass("show"),r.addClass("show"),p.show(),c.hide(),R()})),i.click((function(e){e.preventDefault(),$(".basket .step3_btn").attr("disabled",!0),D.is(":checked")?E.submit():(i.attr("disabled",!1),$(".checkbox .error").show())})),$.fn.digits=function(){return this.each((function(){$(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,"))}))},C.keypress((function(e){if(8!==e.which&&0!==e.which&&(e.which<48||e.which>57))return!1})),v.keypress((function(e){if(8!==e.which&&0!==e.which&&(e.which<48||e.which>57))return!1})),_.bind("keyup blur",(function(){var e=$(this);e.val(e.val().replace(/[^a-z]/g,""))})),f.bind("keyup blur",(function(){var e=$(this);e.val(e.val().replace(/[^a-z]/g,""))}))}))})();