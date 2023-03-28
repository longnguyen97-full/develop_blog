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
                query: params.posts,
                page: current_page,
                offset: offset,
            },
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Loading...');
            },
            success: function(data) {
                console.log(data);
                if (data) {
                    remaining_posts = 10;
                    remaining_posts = posts - loaded_posts;
                    remaining_posts = remaining_posts > 0 ? remaining_posts : 0;
                    button.text(`Load More ( ${remaining_posts} Posts )`);

        //             data = `
        //             <div class="grid clearfix" style="position: relative; height: 695.36px;">

                                
        //             <!-- Small Card With Image -->
        //             <div class="card card_small_with_image grid-item" style="position: absolute; left: 0px; top: 0px;">
        //                 <img class="card-img-top" src="http://develop.wsl/wp-content/themes/develop/assets/images/post_10.jpg" alt="">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/test-post/">Test post</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/liamcybridge-jp/">liam123123</a><span>Sep 04, 2022 at 8:46 PM</span></small>
        //                 </div>
        //             </div>

        //                                                 <!-- Small Card Without Image -->
        //             <div class="card card_default card_small_no_image grid-item" style="position: absolute; left: 293px; top: 0px;">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/test-post-monthly/">Test post monthly</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/liamcybridge-jp/">liam123123</a><span>Aug 15, 2022 at 8:47 PM</span></small>
        //                 </div>
        //             </div>
                
        //             <!-- Small Card With Image -->
        //             <div class="card card_small_with_image grid-item" style="position: absolute; left: 586px; top: 0px;">
        //                 <img class="card-img-top" src="http://develop.wsl/wp-content/themes/develop/assets/images/post_10.jpg" alt="">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/hello-world/">Hello world!</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/liamcybridge-jp/">liam123123</a><span>Jun 03, 2022 at 7:58 AM</span></small>
        //                 </div>
        //             </div>

                
        //             <!-- Small Card With Image -->
        //             <div class="card card_small_with_image grid-item" style="position: absolute; left: 293px; top: 105px;">
        //                 <img class="card-img-top" src="http://develop.wsl/wp-content/themes/develop/assets/images/post_10.jpg" alt="">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/block-image/">Block: Image</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/themereviewteam/">Theme Reviewer</a><span>Nov 03, 2018 at 3:20 PM</span></small>
        //                 </div>
        //             </div>

        //                                                 <!-- Small Card With Background -->
        //             <div class="card card_default card_small_with_background grid-item" style="position: absolute; left: 0px; top: 275px;">
        //                 <div class="card_background" style="background-image:url(http://develop.wsl/wp-content/themes/develop/assets/images/post_11.jpg)"></div>
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/block-button/">Block: Button</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/themereviewteam/">Theme Reviewer</a><span>Nov 03, 2018 at 1:20 PM</span></small>
        //                 </div>
        //             </div>

        //                                                 <!-- Small Card With Background -->
        //             <div class="card card_default card_small_with_background grid-item" style="position: absolute; left: 586px; top: 275px;">
        //                 <div class="card_background" style="background-image:url(http://develop.wsl/wp-content/themes/develop/assets/images/post_11.jpg)"></div>
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/block-cover/">Block: Cover</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/themereviewteam/">Theme Reviewer</a><span>Nov 03, 2018 at 12:25 PM</span></small>
        //                 </div>
        //             </div>

                
        //             <!-- Small Card With Image -->
        //             <div class="card card_small_with_image grid-item" style="position: absolute; left: 293px; top: 400px;">
        //                 <img class="card-img-top" src="http://develop.wsl/wp-content/themes/develop/assets/images/post_10.jpg" alt="">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/block-gallery/">Block: Gallery</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/themereviewteam/">Theme Reviewer</a><span>Nov 03, 2018 at 3:55 AM</span></small>
        //                 </div>
        //             </div>

        //                                                 <!-- Small Card Without Image -->
        //             <div class="card card_default card_small_no_image grid-item" style="position: absolute; left: 0px; top: 401px;">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/column-blocks/">Block: Columns</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/themereviewteam/">Theme Reviewer</a><span>Nov 02, 2018 at 12:10 PM</span></small>
        //                 </div>
        //             </div>
        //                                                 <!-- Small Card Without Image -->
        //             <div class="card card_default card_small_no_image grid-item" style="position: absolute; left: 586px; top: 401px;">
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/block-quotes/">Block: Quote</a></div>
        //                     <small class="post_meta"><a href="http://develop.wsl/author/themereviewteam/">Theme Reviewer</a><span>Nov 01, 2018 at 3:28 PM</span></small>
        //                 </div>
        //             </div>
        //                                                 <!-- Default Card With Background -->
        //             <div class="card card_default card_default_with_background grid-item" style="position: absolute; left: 0px; top: 526px;">
        //                 <div class="card_background" style="background-image:url(http://develop.wsl/wp-content/themes/develop/assets/images/post_12.jpg)"></div>
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/block-category-common/">Block category: Common</a></div>
        //                 </div>
        //             </div>
        //                                             <!-- Default Card With Background -->
        //             <div class="card card_default card_default_with_background grid-item" style="position: absolute; left: 586px; top: 526px;">
        //                 <div class="card_background" style="background-image:url(http://develop.wsl/wp-content/themes/develop/assets/images/post_12.jpg)"></div>
        //                 <div class="card-body">
        //                     <div class="card-title card-title-small"><a href="http://develop.wsl/blocks-embeds/">Block category: Embeds</a></div>
        //                 </div>
        //             </div>
            
        // </div>
        //             `;
                    $('.loadmore_hook').append(data);
                    current_page++;
                    offset = offset + 10;
                    if (remaining_posts == 0) {
                        button.remove();
                    }
                    if (current_page == params.max_page) {
                        button.remove();
                    }
                } else {
                    button.remove();
                }
                $.getScript( `${params.site_url}/wp-content/themes/develop/assets/js/category.js?ver=1.2`, function( data, textStatus, jqxhr ) {
                    console.log( data ); // Data returned
                    console.log( textStatus ); // Success
                    console.log( jqxhr.status ); // 200
                    console.log( "Load was performed." );
                });
            }
        });
    });
});
