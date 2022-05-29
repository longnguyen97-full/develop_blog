jQuery(function($) {
    $(".emoji").click(function() {
        emoji_hook = $(this).attr("class").split(" ")[2];
        ajax_reaction(emoji_hook, 'like');
    });

    function ajax_reaction(emoji_hook, emoji) {
        post_id   = $(".set_data_post_id__" + emoji_hook).val();
        post_type = $(".set_data_post_type__" + emoji_hook).val();

        $.ajax({
            url: reaction_params.ajaxurl,
            data: {
                action: 'reaction',
                post_id: post_id,
                post_type: post_type,
                emoji: emoji
            },
            type: 'POST',
            success: function(response) {
                $(".reaction_by_user__" + emoji_hook).html(response.data);
            }
        });
    }
});
