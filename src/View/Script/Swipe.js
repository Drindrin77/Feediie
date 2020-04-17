$(document).ready(function () {

    $(".buddy").on("swiperight", function () {
        if ($(this).is(':first-child')) {
        }
        else {
            $(this).addClass('rotate-left').delay(700).fadeOut(1);
            $(this).append('<div class="status miam">Miam!</div>');
        }
    });

    $(".buddy").on("swipeleft", function () {
        if ($(this).is(':first-child')) {
        }
        else {
            $(this).addClass('rotate-right').delay(700).fadeOut(1);
            $(this).append('<div class="status beurk">Beurk!</div>');
        }
    });
});

function swipeup() {

    $('#miamBtn').click(function () {
        if ($('.buddy:last').is(':first-child')) {
        }
        else {
            $('.buddy:last').addClass('rotate-left').delay(700).fadeOut(1);
            $('.buddy:last').append('<div class="status miam">Miam!</div>');
        }
    });
    $('#beurkBtn').click(function () {
        if ($('.buddy:last').is(':first-child')) {
        }
        else {
            $('.buddy:last').addClass('rotate-right').delay(700).fadeOut(1);
            $('.buddy:last').append('<div class="status beurk">Beurk!</div>');
        }
    });
}
swipeup();