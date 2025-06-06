$('.js-hamburger').click(() => {
    $('body').toggleClass('is-open');
    $('html').toggleClass('no-scroll');
});

$(window).on('scroll', function() {
    if($(window).scrollTop() > 50) {
        $('.header').addClass('header-scroll');
    } else {
        $('.header').removeClass('header-scroll');
    }
});

$('.navigation__drop-btn > span').click(function () {
    if($(window).width() < 992){
        $(this).parent().toggleClass('drop-is-open');
    }
});

$('.navigation a').on('click', function() {
    $('body').removeClass('is-open');
    $('html').removeClass('no-scroll');
    let href = $(this).attr('href');

    $('html, body').animate({
        scrollTop: $(href).offset().top - 50
    }, {
        duration: 470,
        easing: 'linear'
    });

    return false;
});
