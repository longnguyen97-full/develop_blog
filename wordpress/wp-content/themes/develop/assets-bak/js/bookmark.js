jQuery(function($) {
    var is_submited = false;
    $(".button_bookmark").click(function() {
        if ( is_submited === false ) {
        	$(".form_bookmark").submit( function(e) {
        		e.preventDefault();
        		ajax_bookmark();
                is_submited = true;
        	} );
        }
        $(this).hasClass('marked') ? $(this).removeClass('marked').addClass('unmarked') : $(this).removeClass('unmarked').addClass('marked');
    });

    function ajax_bookmark()
    {
        $.ajax({
            url: bookmark_params.ajaxurl,
            data: {
                action: 'bookmark',
                post_id: $(".post_id").val(),
            },
            type: 'POST',
            success: function(response) {
                data = response.data;
                if (data == '[REQUIRE_LOGIN]') {
                    alert('You are not currently logged in.');
                    return false;
                }
            }
        });
    }
});
