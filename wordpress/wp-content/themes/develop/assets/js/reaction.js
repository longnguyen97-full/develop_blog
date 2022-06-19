jQuery(function($) {
    $(".emoji").click(function() {
        emoji_hook = $(this).attr("class").split(" ")[2];

        reaction_counter = $(".reaction_counter").children("span");
        reaction_counter_int = parseInt($.trim( reaction_counter.text() ));

        if ($(this).hasClass("liked")) {
            $(this).removeClass("liked");
            flag_reaction = false;
            reaction_counter.text( reaction_counter_int - 1 );
        } else {
            $(this).addClass("liked")
            flag_reaction = true;
            reaction_counter.text( reaction_counter_int + 1 );
        }

        ajax_reaction(emoji_hook, 'like', flag_reaction);
    });

    function ajax_reaction(emoji_hook, emoji, flag_reaction)
    {
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
                data = response.data;
                if (data == '[REQUIRE_LOGIN]') {
                    alert('You have to login to like post');
                } else {
                    $(".reaction_by_user__" + emoji_hook).html(data);
                    
                }
            }
        });
    }
});
