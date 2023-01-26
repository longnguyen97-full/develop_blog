jQuery(function ($) {
    $('.main_nav ul li a').click(function (e) {
        // removing the previous selected menu state
        $(this).parents().eq(2).find('li.active').removeClass('active');
        // adding the state for this parent menu
        $(this).parents('li').addClass('active');
    });
});