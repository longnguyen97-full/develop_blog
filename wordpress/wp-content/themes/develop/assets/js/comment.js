jQuery(function($) {
    $('.reply_button').click(function() {
        $('.comment_content').focus();
        $('.comment_parent').val($(this).next().val());
    });

    $('#comment_submit').click(function(e) {
        e.preventDefault();

        // setup data
        let field = {};
        field['comment_content'] = $(this).parent().find('.comment_content').val();
        field['comment_parent']  = $(this).parent().find('.comment_parent').val() || 0;
        let post_id = $(this).parent().find('.post_id').val();

        $.ajax({
            url: params.ajaxurl,
            data: {
                action: 'comment',
                field: field,
                post_id: post_id,
            },
            type: 'POST',
            success: function(data) {
                if (data) {
                    if (field['comment_parent']) {
                        $(`.comment_list_child-${field['comment_parent']}`).last().append(data);
                    } else {
                        $('.comment_list').append(data);
                    }
                    // increase number of comment
                    let numberOfComment = parseInt($('.comments_title').html().replace(/^\D+/g, '')) + 1;
                    $('.comments_title').html(`Comments <span>(${numberOfComment})</span>`);
                    // reset textarea comment content
                    $('.comment_content').val('');
                    // re-load event for focusing textarea comment content
                    $('.reply_button').click(function() {
                        $('.comment_content').focus();
                    });
                }
            }
        });
    });
});
