$(document).ready(function () {
    $('.flechaSubir').click(function () {
        $('body, html').animate({
            scrollTop: '0px'
        }, 500);
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.flechaSubir').slideDown(500);
        } else {
            $('.flechaSubir').slideUp(500);
        }
    });
});
