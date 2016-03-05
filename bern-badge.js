(function($){

    $('body').prepend('<div class="bern-badge bern-badge-'+bern_badge.class+' bern-badge-position-'+bern_badge.position+'" data-color="'+bern_badge.color+'" data-position="'+bern_badge.position+'"></div>');

    if(bern_badge.admin_bar == '1'){
        $('.bern-badge').addClass('bern-badge-pop-down');
    }

})(jQuery);