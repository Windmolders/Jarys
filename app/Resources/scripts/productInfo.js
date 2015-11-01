$(function(){
    if(!$('body').hasClass('page-product') && !$('body').hasClass('page-downloads')) {
        return;
    }

    $('.js-show-page').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var destination = $this.attr('href');
        window.location.hash = destination;
        $('.content-switcher').hide();
        $(destination).show();

        $('html, body').animate({

            scrollTop: $(destination).offset().top - 150
        }, 500);


    });

    if(!window.location.hash) {
        return;
    }

    $('.content-switcher').hide();
    $(window.location.hash).show();


});