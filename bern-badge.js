(function($){

    if (Cookies.get('bern_badge_hide') != '1') {

        $('body')
            .prepend('<div class="bern-badge bern-badge-click bern-badge-position-' + bern_badge.position + '" data-color="' + bern_badge.color + '" data-position="' + bern_badge.position + '" style="background-image:url(' + bern_badge.image + ')"></div>')
            .prepend('' +
                '<div class="bern-badge-info">' +
                '<div class="bernie-head"><div class="bernie"></div></div>' +
                '<div class="bernie-says">' +
                '<span><a href="#"><i class="fa fa-fw fa-times"></i></a></span>' +
                '<i class="fa fa-fw fa-external-link"></i> <a href="http://www.berniesanders.com" target="_blank">' + bern_badge.action1 + '</a><br>' +
                '<i class="fa fa-fw fa-usd"></i> <a href="https://secure.actblue.com/contribute/page/lets-go-bernie" target="_blank">' + bern_badge.action2 + '</a><br>' +
                '<i class="fa fa-fw fa-plus"></i> <a href="https://wordpress.org/plugins/bern-badge-for-bernie-sanders/" target="_blank">' + bern_badge.action3 + '</a><br>' +
                '<i class="fa fa-fw fa-minus"></i> <a href="#" class="bern-badge-hide-this">' + bern_badge.action4 + '</a><br>' +
                '<i class="fa fa-fw fa-ban"></i> <a href="#" class="bern-badge-hide-all">' + bern_badge.action5 + '</a><br>' +
                '</div>' +
                '</div>');

        if (bern_badge.admin_bar == '1') {
            $('.bern-badge').addClass('bern-badge-pop-down');
            $('.bern-badge-info').addClass('bern-badge-pop-down');
        }

        $('.bern-badge-click').click(function () {
            $('.bern-badge-info').show();
        });

        $('.bernie-says').find('span').find('a').click(function (e) {
            e.preventDefault();
            $('.bern-badge-info').hide();
        });

        $('.bern-badge-hide-all').click(function (e) {
            e.preventDefault();
            var b = confirm(bern_badge.confirm);
            if (b) {
                $('.bern-badge-info').hide();
                $('.bern-badge').hide();
                Cookies.set('bern_badge_hide', '1');
            }
        });

        $('.bern-badge-hide-this').click(function (e) {
            e.preventDefault();
            $('.bern-badge-info').hide();
            $('.bern-badge').hide();
        });
    }

})(jQuery);