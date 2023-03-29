jQuery(function($) {
    var current_page = parseInt(params.current_page) + 1;
    var offset       = 10;
    var default_loaded_posts = 10;

    $('#load_more').click(function() {

        let button = $(this);
        var posts  = button.text().match(/\d+/); // get number of post from text of button
        var loaded_posts = $('.loaded_posts').text().match(/\d+/);

        posts        = parseInt(posts[0]);
        loaded_posts = loaded_posts !== null ? parseInt(loaded_posts[0]) : default_loaded_posts;

        if (current_page > 1) {
            offset = current_page * 10;
        }

        $.ajax({
            url: params.ajaxurl,
            data: {
                action: 'loadmore',
                query: params.query_posts,
                page: current_page,
                offset: offset,
            },
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Loading...');
            },
            success: function(data) {
                if (data) {
                    remaining_posts = 10;
                    remaining_posts = posts - loaded_posts;
                    remaining_posts = remaining_posts > 0 ? remaining_posts : 0;
                    button.text(`Load More ( ${remaining_posts} Posts )`);
                    $('.loadmore_hook').append(data);
                    current_page++;
                    offset = offset + 10;
                    if (remaining_posts == 0) {
                        button.remove();
                    }
                    if (current_page == params.max_page) {
                        button.remove();
                    }
                    // re-load script for adjusting grid item
                    $.getScript( `${params.site_url}/wp-content/themes/develop/assets/js/category.js?ver=1.2`, function( data, textStatus, jqxhr ) {
                        console.log( data ); // Data returned
                        console.log( textStatus ); // Success
                        console.log( jqxhr.status ); // 200
                        console.log( "Load was performed." );
                    });
                } else {
                    button.remove();
                }
            }
        });
    });
});
