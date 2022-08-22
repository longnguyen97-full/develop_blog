jQuery(function($) {
    $(".button_bookmark").click(function() {
    	$(".form_bookmark").submit( function(e) {
    		e.preventDefault();
    		ajax_bookmark();
    	} );
        $(this).hasClass('marked') ? $(this).removeClass('marked') : $(this).addClass('marked'); // fixing...
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
