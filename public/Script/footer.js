function replaceFooter(){
    var docHeight = $(window).height();
    var footerHeight = $('#footer').height();
    var footerTop = $('#footer').position().top + footerHeight;

    if (footerTop < docHeight) {
        $('#footer').css('margin-top', (docHeight - footerTop) + 'px');
    }
}

$(document).ready(function() {
    replaceFooter();
});

$(window).resize(function(){
    replaceFooter();

});