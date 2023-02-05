jQuery(function($) {
    var current_page = parseInt(loadmore_params.current_page) + 1;
    var offset       = 10;
    var default_loaded_posts = 10;

    $('.loadmore_button').click(function() {

        var button = $(this);
        var posts  = button.text().match(/\d+/); // get number of post from text of button
        var loaded_posts = $(".loaded_posts").text().match(/\d+/);

        posts        = parseInt(posts[0]);
        loaded_posts = loaded_posts !== null ? parseInt(loaded_posts[0]) : default_loaded_posts;

        if (current_page > 1) {
            offset = current_page * 10;
        }

        $.ajax({
            url: loadmore_params.ajaxurl,
            data: {
                action: 'loadmore',
                query: loadmore_params.posts,
                page: current_page,
                offset: offset,
            },
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Loading...');
            },
            success: function(data) {
                if (data) {
                    remaining_posts = posts - loaded_posts;
                    remaining_posts = remaining_posts > 0 ? remaining_posts : 0;
                    button.text('More posts (' + remaining_posts + ' Posts)').prev().after(data);
                    current_page++;
                    offset = offset + 10;
                    if (remaining_posts == 0) {
                        button.remove();
                    }
                    if (current_page == loadmore_params.max_page) {
                        button.remove();
                    }
                } else {
                    button.remove();
                }
            }
        });
    });
});
