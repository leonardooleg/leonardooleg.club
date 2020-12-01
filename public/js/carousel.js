$(document).ready(function() {

    (function () {
        var $sl = $(".b-slider");
        if ($sl.length) {
            $sl.each(function (index, el) {
                var $sl = $(this),
                    $slFor = $sl.find(".b-slider__carousel--screen"),
                    $slNav = $sl.find(".b-slider__carousel--thumbs");

                // theme list
                if ($sl.is(".js-slider-horizontal-tm-1")) {
                    $slFor.slick({
                        asNavFor: $slNav.length ? $slNav : false,
                        slidesToShow: 7,
                        slidesToScroll: 5,
                        arrows: true,
                        adaptiveHeight: true,
                        prevArrow: '<i class="fas fa-arrow-alt-circle-left"></i>',
                        nextArrow: '<i class="fas fa-arrow-alt-circle-right"></i>',
                        // fade: true,
                        // VERTICAL
                        // vertical: true,
                        // verticalSwiping: true,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false,
                                    dots: true
                                }
                            }
                        ]
                    });
                    var slShow = 5,
                        slBool = $slNav.children().length > slShow ? true : false,
                        slScroll = $slNav.children().length > slShow ? 1 : slShow;
                    $slNav.slick({
                        asNavFor: $slFor.length ? $slFor : false,
                        centerPadding: "0",
                        slidesToShow: slShow,
                        slidesToScroll: slScroll,
                        infinite: slBool,
                        centerMode: slBool,
                        focusOnSelect: true,
                        dots: false,
                        arrows: true,
                        prevArrow: '<i class="far fa-arrow-alt-circle-left"></i>',
                        nextArrow: '<i class="far fa-arrow-alt-circle-right"></i>',
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 3
                                }
                            }
                        ]
                    });
                }
            });
        }
    })();

    // ZOOM
    $('.ex1').zoom();
/*
    $('.as').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 20000,
        pauseOnFocus: false,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.asa').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 30000,
        pauseOnFocus: false,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        cssEase: 'linear'
    });
    $('.proda').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 20000,
        pauseOnFocus: false,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });*/
});
