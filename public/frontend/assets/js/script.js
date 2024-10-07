
(function ($) {
    "use strict";
    // language  block//
    $('.language-dropdown-open').slideUp();
    $('.language-dropdown-click').on('click', function () {
        $('.language-dropdown-open').slideToggle()
    });
    $('.curroncy-dropdown-open').slideUp();
    $('.curroncy-dropdown-click').on('click', function () {
        $('.curroncy-dropdown-open').slideToggle()
    })
    $('.pro-up').hide();
    $('.mor-slide-open').slideUp();
    $('.mor-slide-click').on('click', function () {
        $('.mor-slide-open').slideToggle();
        $('.pro-up').toggle();
        $('.pro-down').toggle();
    })

    $('.category-toggle').on('click', function (e) {
        $('.show').slideToggle()
        $('.category-heandle').toggleClass('open')
        $('.collapse-category').toggleClass('open')
    });

    $('.category-toggle').on('click', function (e) {
        $('.hide').slideToggle()
    });



    // $('.category-toggle').on('click', function(e) {
    //     $(this).siblings().toggleClass("hide");
    // });

    $('.mobilecat-toggle').on('click', function (e) {
        $('.collapse-category').toggleClass('open')
    });
    $('.back-btn').on('click', function (e) {
        $('.collapse-category').toggleClass('open')
    });

    // mobile search //
    $('.search-overlay').hide();
    $('.close-mobile-search').on('click', function () {
        $('.search-overlay').fadeOut();
    })
    $('.mobile-search').on('click', function () {
        $('.search-overlay').show();
    });


    $('.mobile-search').on('click', function () {
        $('.searchbar-input').addClass('open');
    });

    $('.close-searchbar').on('click', function () {
        $('.searchbar-input').removeClass('open');
    });




    // sticky header //
    // $(window).scroll(function() {
    // if ($(this).scrollTop() > 400){
    //     // $('header').addClass("sticky");
    //     $('.product-top-sticky').addClass("sticky");
    //   }
    //   else{
    //     // $('header').removeClass("sticky");
    //     $('product-top-sticky').removeClass("sticky");
    //   }
    // });


    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 300) {
    //         $('header').addClass("sticky");
    //     } else {
    //         $('header').removeClass("sticky");
    //     }
    // });




    // header category //

    var contentwidth = jQuery(window).width();
    if ((contentwidth) < '1200') {
        jQuery('.cat-title').on('click', function () {
            jQuery(this).parents('li').siblings().children('.collapse-mega').slideUp('normal');
            jQuery(this).parent().siblings().children('.collapse-mega').slideUp('normal');
            jQuery(this).parent().siblings().children('.collapse-mega').children().find('.collapse-mega').slideUp('normal');
            jQuery(this).parents('li').siblings().children('.sub-collapse').slideUp('normal');
            jQuery(this).parent().siblings().children('.sub-collapse').slideUp('normal');
            jQuery(this).parent().siblings().children('.sub-collapse').children().find('.sub-collapse').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).next().slideDown('normal');
            }
        });

        jQuery('.sub-collapse').hide();
        jQuery('.collapse-mega').hide();
    }
    $('span.sub-arrow').on('click', function () {
        $('.categoryone .collapse-mega .mega-box ul').removeClass('open');
        $(this).parent().next().toggleClass('open');
    });




    /*=====================
     03.footer js
     ==========================*/
    var contentwidth = jQuery(window).width();
    if ((contentwidth) < '767') {
        jQuery('.footer-title h5').append('<span class="according-menu"></span>');
        jQuery('.footer-title').on('click', function () {
            jQuery('.footer-title').removeClass('active');
            jQuery('.footer-contant').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).next().slideDown('normal');
            }
        });
        jQuery('.footer-contant').hide();
    } else {
        jQuery('.footer-contant').show();
    }





    /*=====================
     04. Image to background js
     ==========================*/
    $(".bg-top").parent().addClass('b-top');
    $(".bg-bottom").parent().addClass('b-bottom');
    $(".bg-center").parent().addClass('b-center');
    $(".bg_size_content").parent().addClass('b_size_content');
    $(".bg-img").parent().addClass('bg-size');

    jQuery('.bg-img').each(function () {

        var el = $(this),
            src = el.attr('src'),
            parent = el.parent();

        parent.css({
            'background-image': 'url(' + src + ')',
            'background-size': 'cover',
            'background-position': 'center',
            'display': 'block'
        });

        el.hide();
    });

    /*=====================
     05 toggle nav
     ==========================*/
    $('.toggle-nav').on('click', function () {
        $('.sm-horizontal').css("right", "0px");
    });
    $(".mobile-back").on('click', function () {
        $('.sm-horizontal').css("right", "-410px");
    });

    /*=====================
     06 navbar mobile nav
     ==========================*/
    $('.sm-nav-btn').on('click', function () {
        $('.nav-slide').css("left", "0px");
    });
    $(".nav-sm-back").on('click', function () {
        $('.nav-slide').css("left", "-410px");
    });

    $('.toggle-nav-desc').on('click', function () {
        $('.desc-horizontal').css("right", "0px");
    });
    $(".desc-back").on('click', function () {
        $('.desc-horizontal').css("right", "-410px");
    });

    /*=====================
     07 menu js
     ==========================*/

    function openNav() {
        document.getElementById("mySidenav").classList.add('open-side');
    }
    function closeNav() {
        document.getElementById("mySidenav").classList.remove('open-side');
    }


    /*=====================
     09. category page
     ==========================*/
    $('.collapse-block-title').on('click', function (e) {
        e.preventDefault;
        var speed = 300;
        var thisItem = $(this).parent(),
            nextLevel = $(this).next('.collection-collapse-block-content');
        if (thisItem.hasClass('open')) {
            thisItem.removeClass('open');
            nextLevel.slideUp(speed);
        }
        else {
            thisItem.addClass('open');
            nextLevel.slideDown(speed);
        }
    });

    $('.color-selector ul li > div').on('click', function (e) {
        $(".color-selector ul li > div").removeClass("active");
        $(this).addClass("active");
    });

    // $('.size-box ul li').on('click', function(e) {
    //   $(".size-box ul li").removeClass("active");
    //   $(this).addClass("active");
    // });

    $('.image-swatch li ').on('click', function (e) {
        $(".image-swatch li ").removeClass("active");
        $(this).addClass("active");
    });

    $('.show-offer').on('click', function (e) {
        $(".offer-sider").slideToggle();
        $(".more-offer").fadeToggle();
        $(".less-offer").fadeToggle();
    });



    $('.size-box ul li').on('click', function (e) {
        $(".size-box ul li").removeClass("active");
        $('#selectSize').removeClass('cartMove');
        $(this).addClass("active");
        $(this).parent().addClass('selected');
    });



    $('#cartEffect').on('click', function (e) {
        if ($("#selectSize .size-box ul").hasClass('selected')) {
            $('#cartEffect').text("Added to bag ");
            $('.added-notification').addClass("show");
            setTimeout(function () {
                $('.added-notification').removeClass("show");
            }, 5000);
        } else {
            $('#selectSize').addClass('cartMove');
        }
    });







    //list layout view
    $('.list-layout-view').on('click', function (e) {
        $('.collection-grid-view').css('opacity', '0');
        $(".product-wrapper-grid").css("opacity", "0.2");
        $('.shop-cart-ajax-loader').css("display", "block");
        $('.product-wrapper-grid').addClass("list-view");
        $(".product-wrapper-grid").children().children().removeClass();
        $(".product-wrapper-grid").children().children().addClass("col-lg-12");
        setTimeout(function () {
            $(".product-wrapper-grid").css("opacity", "1");
            $('.shop-cart-ajax-loader').css("display", "none");
        }, 500);
    });
    //grid layout view
    $('.grid-layout-view').on('click', function (e) {
        $('.collection-grid-view').css('opacity', '1');
        $('.product-wrapper-grid').removeClass("list-view");
        $(".product-wrapper-grid").children().children().removeClass();
        $(".product-wrapper-grid").children().children().addClass("col-lg-3");

    });
    $('.product-2-layout-view').on('click', function (e) {
        if ($('.product-wrapper-grid').hasClass("list-view")) { }
        else {
            $(".product-wrapper-grid").children().children().removeClass();
            $(".product-wrapper-grid").children().children().addClass("col-lg-6");
        }
    });
    $('.product-3-layout-view').on('click', function (e) {
        if ($('.product-wrapper-grid').hasClass("list-view")) { }
        else {
            $(".product-wrapper-grid").children().children().removeClass();
            $(".product-wrapper-grid").children().children().addClass("col-lg-4");
        }
    });
    $('.product-4-layout-view').on('click', function (e) {
        if ($('.product-wrapper-grid').hasClass("list-view")) { }
        else {
            $(".product-wrapper-grid").children().children().removeClass();
            $(".product-wrapper-grid").children().children().addClass("col-lg-3");
        }
    });
    $('.product-6-layout-view').on('click', function (e) {
        if ($('.product-wrapper-grid').hasClass("list-view")) { }
        else {
            $(".product-wrapper-grid").children().children().removeClass();
            $(".product-wrapper-grid").children().children().addClass("col-lg-2");
        }
    });


    /*=====================
     10. Product page Quantity Counter
     ==========================*/
    // $('.qty-box .quantity-right-plus').on('click', function () {
    //   var $qty = $('.qty-box .input-number');
    //   var currentVal = parseInt($qty.val(), 10);
    //   if (!isNaN(currentVal)) {
    //     $qty.val(currentVal + 1);
    //   }
    // });
    // $('.qty-box .quantity-left-minus').on('click', function () {
    //   var $qty = $('.qty-box .input-number');
    //   var currentVal = parseInt($qty.val(), 10);
    //   if (!isNaN(currentVal) && currentVal > 1) {
    //     $qty.val(currentVal - 1);
    //   }
    // });


    // var qtyHolders = document.querySelectorAll(".qty-holder");
    var qtyDecs = document.querySelectorAll(".qty-minus");
    var qtyIncs = document.querySelectorAll(".qty-plus");
    qtyDecs.forEach((qtyDec) => {
        qtyDec.addEventListener("click", function (e) {
            if (e.target.nextElementSibling.value > 0) {
                e.target.nextElementSibling.value--;
            } else {
                // delete the item, etc
            }
        })
    })
    qtyIncs.forEach((qtyDec) => {
        qtyDec.addEventListener("click", function (e) {
            e.target.previousElementSibling.value++;
        })
    })



    /*=====================
     11. filter sidebar js
     ==========================*/
    $('.sidebar-popup').on('click', function (e) {
        $('.open-popup').toggleClass('open');
        $('.collection-filter').css("left", "-15px");
    });
    $('.filter-main-btn').on('click', function (e) {
        $('.collection-filter').css("left", "-15px");
    });
    $('.filter-back').on('click', function (e) {
        $('.collection-filter').css("left", "-365px");
        $('.sidebar-popup').trigger('click');
    });

    $('.account-sidebar').on('click', function (e) {
        $('.dashboard-left').css("left", "0");
    });
    $('.filter-back').on('click', function (e) {
        $('.dashboard-left').css("left", "-365px");
    });

    $(function () {
        $(".col-grid-box").slice(0, 8).show();
        $(".loadMore").on('click', function (e) {
            e.preventDefault();
            $(".col-grid-box:hidden").slice(0, 4).slideDown();
            if ($(".col-grid-box:hidden").length == 0) {
                $(".load-more-sec").text('no more products');
            }
        });
    });

    $('.horizontal-filter-toggle').on('click', function (e) {
        $('.horizontal-filter').slideToggle('');
    });

    $('.close-filter').on('click', function (e) {
        $('.horizontal-filter').slideToggle('');
    });






    /*=====================
    12. Filter js
     ==========================*/
    $(".filter-button").on('click', function () {
        $(this).addClass('active').siblings('.active').removeClass('active');
        var value = $(this).attr('data-filter');
        if (value == "all") {
            $('.filter').show('1000');
        }
        else {
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');
        }
    });

    $("#formButton").on('click', function () {
        $("#form1").toggle();
    });

    // dark layout //
    // var body_event = $("body");
    // body_event.on("click", ".theme-layout-version", function () {
    //     $(this).toggleClass('dark');
    //     $('body').removeClass('dark');
    //     if ($('.theme-layout-version').hasClass('dark')) {
    //         $('.theme-layout-version').text('Light');
    //         $('body').addClass('dark');
    //     } else {
    //         $('#theme-dark').remove();
    //         $('.theme-layout-version').text('Dark');
    //     }

    //     return false;
    // });

    /*=====================
     15. Add to cart
     ==========================*/
    $('.add-cartnoty').on('click', function () {
        $.notify({
            icon: 'fa fa-check',
            title: 'Success!',
            message: 'Item Successfully added to your cart'
        }, {
            element: 'body',
            position: null,
            type: "success",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });
    });

    /*=====================
     16.  Add to wishlist
     ==========================*/
    $('.add-to-wish').on('click', function () {

        $.notify({
            icon: 'fa fa-check',
            title: 'Success!',
            message: 'Item Successfully added in wishlist'
        }, {
            element: 'body',
            position: null,
            type: "info",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });
    });



    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 600) {
            $('.tap-top').addClass('top-cls');

        } else {
            $('.tap-top').removeClass('top-cls');
        }
    });

    $(' <div class="tap-top" style="display: block;"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 285 285" style="enable-background:new 0 0 285 285;" xml:space="preserve"><g><path d="M88.4,87.996c2.525-2.146,2.832-5.933,0.687-8.458C82.801,72.144,79.34,62.719,79.34,53c0-22.607,18.393-41,41-41c22.607,0,41,18.393,41,41c0,9.729-3.467,19.161-9.761,26.557c-2.148,2.523-1.843,6.311,0.681,8.458c1.129,0.961,2.511,1.431,3.886,1.431c1.698,0,3.386-0.717,4.572-2.111C168.858,77.77,173.34,65.576,173.34,53c0-29.225-23.775-53-53-53c-29.225,0-53,23.775-53,53c0,12.563,4.476,24.748,12.602,34.31C82.089,89.835,85.873,90.141,88.4,87.996z"/><path d="M120.186,41.201c13.228,0,23.812,8.105,27.313,19.879c0.761-2.562,1.176-5.271,1.176-8.08c0-15.649-12.685-28.335-28.335-28.335c-15.648,0-28.334,12.686-28.334,28.335c0,2.623,0.364,5.16,1.031,7.571C96.691,49.076,107.152,41.201,120.186,41.201z"/><path d="M234.21,169.856c-3.769-22.452-19.597-26.04-27.034-26.462c-2.342-0.133-4.516-1.32-5.801-3.282c-5.388-8.225-12.609-10.4-18.742-10.4c-4.405,0-8.249,1.122-10.449,1.932c-0.275,0.102-0.559,0.15-0.837,0.15c-0.87,0-1.701-0.47-2.163-1.262c-5.472-9.387-13.252-11.809-19.822-11.809c-3.824,0-7.237,0.82-9.548,1.564c-0.241,0.077-0.764,0.114-1.001,0.114c-1.256,0-2.637-1.03-2.637-2.376V69.753c0-11.035-8.224-16.552-16.5-16.552c-8.276,0-16.5,5.517-16.5,16.552v84.912c0,4.989-3.811,8.074-7.918,8.074c-2.495,0-4.899-1.138-6.552-3.678l-7.937-12.281c-3.508-5.788-8.576-8.188-13.625-8.189c-11.412-0.001-22.574,12.258-14.644,25.344l62.491,119.692c0.408,0.782,1.225,1.373,2.108,1.373h87.757c1.253,0,2.289-1.075,2.365-2.325l2.196-35.816c0.025-0.413,0.162-0.84,0.39-1.186C231.591,212.679,237.828,191.414,234.21,169.856z"/></g></svg></div>').appendTo($('body'));
    (function () {
    })();
    $('.tap-top').on('click', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    /*=====================
       18. loader
       ==========================*/

    $('.loader-wrapper').fadeOut('slow', function () {
        $(this).remove();
    });


    /*=====================
     19. add to cart sidebar js
     ==========================*/
    function openCart() {
        document.getElementById("cart_side").classList.add('open-side');
    }
    function closeCart() {
        document.getElementById("cart_side").classList.remove('open-side');
    }


    // $(window).scroll(function () {
    //   var scroll = $(window).scrollTop();
    //   var width_content = jQuery(window).width();
    //   if ((width_content) > '576') {
    //   if (scroll >= 800) {
    //       $("body").addClass("stickyCart");
    //   } else {
    //       $("body").removeClass("stickyCart");
    //   }
    // }
    // });


    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 800) {
            $('.bottom-cart-sticky').addClass('open-cart');
        } else {
            $('.bottom-cart-sticky').removeClass('open-cart');
        }
    });





    /*=====================
    20. Color Picker
     ==========================*/
    var body_event = $("body");
    body_event.on("click", ".color1", function () {
        $("#color").attr("href", "../assets/css/color1.css");
        return false;

    });
    body_event.on("click", ".color2", function () {
        $("#color").attr("href", "../assets/css/color2.css");
        return false;
    });
    body_event.on("click", ".color3", function () {
        $("#color").attr("href", "../assets/css/color3.css");
        return false;
    });
    body_event.on("click", ".color4", function () {
        $("#color").attr("href", "../assets/css/color4.css");
        return false;
    });
    body_event.on("click", ".color5", function () {
        $("#color").attr("href", "../assets/css/color5.css");
        return false;
    });
    body_event.on("click", ".color6", function () {
        $("#color").attr("href", "../assets/css/color6.css");
        return false;
    });
    body_event.on("click", ".color7", function () {
        $("#color").attr("href", "../assets/css/color7.css");
        return false;
    });
    body_event.on("click", ".color8", function () {
        $("#color").attr("href", "../assets/css/color8.css");
        return false;
    });
    body_event.on("click", ".color9", function () {
        $("#color").attr("href", "../assets/css/color9.css");
        return false;
    });
    body_event.on("click", ".color10", function () {
        $("#color").attr("href", "../assets/css/color10.css");
        return false;
    });
    body_event.on("click", ".color11", function () {
        $("#color").attr("href", "../assets/css/color11.css");
        return false;
    });
    body_event.on("click", ".color12", function () {
        $("#color").attr("href", "../assets/css/color12.css");
        return false;
    });
    body_event.on("click", ".color13", function () {
        $("#color").attr("href", "../assets/css/color13.css");
        return false;
    });
    body_event.on("click", ".color14", function () {
        $("#color").attr("href", "../assets/css/color14.css");
        return false;
    });
    body_event.on("click", ".color15", function () {
        $("#color").attr("href", "../assets/css/color15.css");
        return false;
    });

    $('.color-picker').animate({ right: '-150px' });

    body_event.on("click", ".color-picker a.handle", function (e) {
        e.preventDefault();
        var div = $('.color-picker');
        if (div.css('right') === '-150px') {
            $('.color-picker').animate({ right: '0px' });
        }
        else {
            $('.color-picker').animate({ right: '-150px' });
        }
    });

    /*=====================
    21. Add to cart quantity Counter
     ==========================*/
    $('button.add-button').on('click', function () {
        $(this).next().addClass("open");
        $(".qty-input").val('1kg');
    });
    $('.quantity-right-plus').on('click', function () {
        var $qty = $(this).siblings(".qty-input");
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1 + 'kg');
        }
    });
    $('.quantity-left-minus').on('click', function () {
        var $qty = $(this).siblings(".qty-input");
        var _val = $($qty).val();
        if (_val == '1kg') {
            var _removeCls = $(this).parents('.cart_qty');
            $(_removeCls).removeClass("open");
        }
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1 + 'kg');
        }
    });




    /*================================
     22. counter js
    ===================================*/

    $('.counter-count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {

            //chnage count up speed here
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


    /*=====================
     26. Cookiebar
     ==========================*/
    window.setTimeout(function () {
        $(".cookie-bar").addClass('show')
    }, 5000);

    $('.cookie-bar .btn, .cookie-bar .btn-close').on('click', function () {
        $(".cookie-bar").removeClass('show')
    });




})(jQuery);

function openCart() {
    document.getElementById("cart_side").classList.add('open-side');
}
function closeCart() {
    document.getElementById("cart_side").classList.remove('open-side');
}

function openAccount() {
    document.getElementById("myAccount").classList.add('open-side');
}
function closeAccount() {
    document.getElementById("myAccount").classList.remove('open-side');
}

function openWishlist() {
    document.getElementById("wishlist_side").classList.add('open-side');
}
function closeWishlist() {
    document.getElementById("wishlist_side").classList.remove('open-side');
}
function openSetting() {
    document.getElementById("mySetting").classList.add('open-side');
}
function closeSetting() {
    document.getElementById("mySetting").classList.remove('open-side');
}
