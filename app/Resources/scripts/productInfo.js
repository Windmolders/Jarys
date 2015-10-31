$(function(){
    if(!$('body').hasClass('page-product')) {
        return;
    }

    $('.content-switcher').hide();
    $(window.location.hash).show();

    $('.js-show-page').click(function(e){
        var $this = $(this);
        var destination = $this.attr('href');
        window.location.hash = destination;
        $('.content-switcher').hide();
        $(destination).show();
    });
});