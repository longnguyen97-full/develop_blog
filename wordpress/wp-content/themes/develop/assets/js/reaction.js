jQuery(function($) {
    $('.reaction').click(function() {
        $(this).toggleClass('fa-thumbs-up-active');

        // setup data
        let object_id = $(this).data('object_id');
        let user_id   = $(this).data('user_id');
        let post_type = $(this).data('post_type');
        let icon      = $(this).data('icon');
        let active    = $(this).next();
        active.is(':checked') ? active.prop('checked', false) : active.prop('checked', true);
        active.is(':checked') ? active.val('') : active.val('active');

        $.ajax({
            url: params.ajaxurl,
            data: {
                action: 'reaction',
                object_id: object_id,
                user_id: user_id,
                post_type: post_type,
                icon: icon,
                active: active.val()
            },
            type: 'POST',
            success: function(data) {
                console.log(data);
            }
        });
    });
});
