(function($){

    $('body').prepend('<div class="bern-badge bern-badge-position-'+bern_badge.position+'" data-color="'+bern_badge.color+'" data-position="'+bern_badge.position+'" style="background-image:url('+bern_badge.image+')"></div>');

    if(bern_badge.admin_bar == '1'){
        $('.bern-badge').addClass('bern-badge-pop-down');
    }

})(jQuery);