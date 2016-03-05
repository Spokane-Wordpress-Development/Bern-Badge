(function($){

    $('.bern-badge-form').on('change', 'select', function(){
       toggleBernBadges();
    });

    toggleBernBadges();

})(jQuery);

function toggleBernBadges(){

    jQuery('.bern-badge').each(function(){

        var my_bern_badge = jQuery('#my-bern-badge');
        var current_class = my_bern_badge.data('current-class');
        var color = jQuery('#bern-badge-color').val();
        var position = jQuery('#bern-badge-position').val();
        var language = jQuery('#bern-badge-language').val();
        var style = jQuery('#bern-badge-style').val();

        if (current_class.length > 0){
            my_bern_badge.removeClass(current_class);
        }

        var name = color+'-'+position+'-'+language+'-'+style;
        jQuery('#bern_badge').val(name);
        var new_class = 'bern-badge-'+name;
        my_bern_badge
            .addClass(new_class)
            .data('current-class', new_class);
    });
}