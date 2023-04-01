jQuery(function($) {
    $('.bookmark').click(function() {
        $('.bookmark').toggleClass('toggle-active');

        // setup data
        let post_id = $(this).data('post_id');
        let user_id = $(this).data('user_id');
        let active  = $('.bookmark').next();
        active.is(':checked') ? active.prop('checked', false) : active.prop('checked', true);
        active.is(':checked') ? active.val('') : active.val('active');

        $.ajax({
            url: params.ajaxurl,
            data: {
                action: 'bookmark',
                post_id: post_id,
                user_id: user_id,
                active: active.val()
            },
            type: 'POST',
            success: function(data) {
                console.log(data);
            }
        });
    });
});
