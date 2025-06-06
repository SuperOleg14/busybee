$('.accordion .card').first().addClass('card--active');
$('.accordion .card').first().find('.card-body').show();

$('.card-btn').click(function(e) {
    e.stopPropagation();
    var dropDown = $(this).closest('.card').find('.card-body');

    $(this).closest('.accordion').find('.card-body').not(dropDown).slideUp();

    if ($(this).parent().hasClass('card--active')) {
        $(this).parent().removeClass('card--active');
    } else {
        if (window.innerWidth <=767) {
            setTimeout(() => {
                $('html,body').animate({
                    scrollTop: $(this).offset().top - 100
                }, 300);
            }, 400);
        }
        $('.card').removeClass('card--active');
        $(this).parent().addClass('card--active');
    }

    dropDown.stop(false, true).slideToggle();
});
