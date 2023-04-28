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
        // fill color to navbar on search, profile pages
        let searchParam = getUrlParameter('s');
        let pathname = window.location.pathname.replace(/\//, '').split('/', 1)[0];
        if ($.inArray(pathname, ['profile']) !== -1 || searchParam) {
            $('header.header').addClass('noscroll');
        }
    });
    // get parameter from url
    let getUrlParameter = function getUrlParameter(sParam) {
        let sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };
});
