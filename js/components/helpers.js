/**
 * lazyload images
 */
$('img[data-original]').lazyload({
    effect: 'fadeIn'
});

/**
 * If all sides of the block are visible
 * @returns {boolean}
 */
$.fn.inView = function() {
    const win = $(window);
    window.obj = $(this);
    const scrollPosition = win.scrollTop();
    const visibleArea = win.scrollTop() + win.height();
    const objEndPos = (window.obj.offset().top + window.obj.outerHeight());
    return visibleArea >= objEndPos && scrollPosition <= objEndPos;
};
