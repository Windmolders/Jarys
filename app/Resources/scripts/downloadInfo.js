$(function(){
    if(!$('body').hasClass('page-downloads')) {
        return;
    }

    console.log('bvam');

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