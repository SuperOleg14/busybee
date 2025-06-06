if ($.fn.slick) {
    $('.reviews-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                }
            },
        ]
    });

    $('.our-services__content_slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 700,
        fade: true,
        cssEase: 'linear',
    });

    $('.related-service-posts__content').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });

    $('.single-service-slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        dots: true,
        arrows: true,
        fade: true,
        asNavFor: '.single-service-slider-nav',
    });

    $('.single-service-slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 500,
        dots: false,
        arrows: false,
        focusOnSelect: true,
        slide: 'div',
        asNavFor: '.single-service-slider-for',
        vertical: true,
        responsive: [
            {
                breakpoint: 640,
                settings: {
                    vertical: false,
                }
            },
        ]
    });
}
