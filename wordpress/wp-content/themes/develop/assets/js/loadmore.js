jQuery(function($) {
    var current_page = 0;
    var offset       = 10;

    $('.loadmore_button').click(function() {

        var button = $(this);

        if (loadmore_params.current_page > 1) {
            current_page = loadmore_params.current_page;
            offset       = loadmore_params.current_page * 10;
        }

        $.ajax({
            url: loadmore_params.ajaxurl,
            data: {
                action: 'loadmore',
                query: loadmore_params.posts,
                page: loadmore_params.current_page,
                offset: offset,
            },
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Loading...');
            },
            success: function(data) {
                if (data) {
                    button.text('More posts').prev().before(data);
                    loadmore_params.current_page++;
                    offset = offset + 5;
                    if (loadmore_params.current_page == loadmore_params.max_page) {
                        button.remove();
                    }
                } else {
                    button.remove();
                }
            }
        });
    });
});
