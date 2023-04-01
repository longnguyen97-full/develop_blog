jQuery(function($) {
    $( document ).ready(function() {
        // show/hide nav item for member and visitor
        if ($('body').hasClass('logged-in')){
            $('.require_nologin').parents('li').addClass('hide');
            $('.require_login').parents('li').removeClass('hide');
        } else {
            $('.require_nologin').parents('li').removeClass('hide');
            $('.require_login').parents('li').addClass('hide');
        }
    });
});
