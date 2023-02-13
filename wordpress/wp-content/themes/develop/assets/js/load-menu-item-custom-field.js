jQuery(function($) {
    $( document ).ready(function() {
        let isUserLoggedIn = document.body.classList.contains( 'logged-in' );
        $('.menu-item-class').each(function() {
            if (isUserLoggedIn && $(this).text() == 'Profile') {
                $(this).removeClass('hide');
            }
            if (!isUserLoggedIn && $(this).text() != 'Profile') {
                $(this).removeClass('hide');
            }
        });

    });
});
