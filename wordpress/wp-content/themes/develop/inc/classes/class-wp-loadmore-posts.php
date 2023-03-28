<?php
class Loadmore
{
    /**
     * Start up
     */
    public function __construct()
    {
        global $wp_query;
        $this->wp_query = $wp_query;

        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        add_action('wp_ajax_loadmore', array($this, 'callback'));
        add_action('wp_ajax_nopriv_loadmore', array($this, 'callback'));
    }

    public function queryVar($key = '', $is_wp_query = false)
    {
        $var = (int) get_query_var($key);

        if ($is_wp_query === true) {
            $var = (int) $this->wp_query->{$key};
        }

        return $var;
    }

    public function loadScripts()
    {
        wp_enqueue_style(TEXT_DOMAIN . '-loadmore', getAssets() . '/css/loadmore.css', array(), wp_get_theme()->get('Version'));
        wp_register_script(TEXT_DOMAIN . '-loadmore', getAssets() . '/js/loadmore.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-loadmore', 'params', array(
            'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
            'loaded_posts' => get_loaded_posts(),
            'posts'        => json_encode($this->wp_query->query_vars),
            'current_page' => $this->queryVar('paged'),
            'max_page'     => $this->queryVar('max_num_pages', true),
        ));
        wp_enqueue_script(TEXT_DOMAIN . '-loadmore');
    }

    // public function loadmoreButton()
    // {
    //     $current_page = $this->queryVar('paged');
    //     $max_page     = $this->queryVar('max_num_pages', true);

    //     // Count total posts in order to specific page
    //     $total_posts  = wp_count_posts()->publish;
    //     $category     = $this->queryVar('cat');
    //     $tag          = $this->queryVar('tag_id');
    //     $author       = $this->queryVar('author');
    //     $total_posts  = $category ? count_cat_posts($category) : $total_posts;
    //     $total_posts  = $tag ? count_tag_posts($tag) : $total_posts;
    //     $total_posts  = $author ? count_author_posts($author) : $total_posts;

    //     $loaded_posts = get_loaded_posts();
    //     $remaining_posts = $total_posts - $loaded_posts;

    //     if ( $max_page > 1 && $max_page !== $current_page ) {
    //         echo "<div class='loadmore_button'>More posts ({$remaining_posts} Posts)</div>";
    //     }
    // }

    public function callback()
    {
        // $args                   = isset($_POST['query']) ? json_decode( stripslashes( $_POST['query'] ), true ) : array();
        // $args['paged']          = (int) isset($_POST['page']) ? $_POST['page'] + 1 : 0;
        // $args['offset']         = (int) isset($_POST['offset']) ? $_POST['offset'] : 0;
        // $args['posts_per_page'] = 10;
        // $args['post_status']    = 'publish';
        // $args['post__not_in']   = is_home() ? get_option( 'sticky_posts' ) : '';

        // query_posts( $args );

        // if ( have_posts() ) :

        //     while ( have_posts() ): the_post();

        //         get_template_part( 'template-parts/content' );

        //         count_loaded_posts();

        //     endwhile;

        //     $loaded_posts = get_loaded_posts();
        //     echo "<div class='loaded_posts hide'>Loaded More Posts ({$loaded_posts} Posts)</div>";

        // endif;

        // exit;
        ?>
        <div class="grid clearfix">

            <?php
            $args = [
                'numberposts' => 11,
                'post_status' => 'publish',
            ];
            $posts = get_posts($args);
            foreach ($posts as $key => $post) :
                $post_link    = get_permalink($post->ID);
                $post_title   = $post->post_title;
                $post_author  = get_author_name($post->post_author);
                $post_date    = date('M d, Y \a\t g:i A', strtotime($post->post_date));
                $author_link  = get_author_posts_url($post->post_author);

                if (in_array($key, [0, 2, 3, 6])) :
            ?>

                    <!-- Small Card With Image -->
                    <div class="card card_small_with_image grid-item">
                        <img class="card-img-top" src="<?php assets(); ?>/images/post_10.jpg" alt="">
                        <div class="card-body">
                            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                            <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                        </div>
                    </div>

                <?php
                elseif (in_array($key, [1, 7, 8])) :
                ?>
                    <!-- Small Card Without Image -->
                    <div class="card card_default card_small_no_image grid-item">
                        <div class="card-body">
                            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                            <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                        </div>
                    </div>
                <?php
                elseif (in_array($key, [4, 5])) :
                ?>
                    <!-- Small Card With Background -->
                    <div class="card card_default card_small_with_background grid-item">
                        <div class="card_background" style="background-image:url(<?php assets(); ?>/images/post_11.jpg)"></div>
                        <div class="card-body">
                            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                            <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                        </div>
                    </div>

                <?php
                elseif (in_array($key, [9, 10])) :
                ?>
                    <!-- Default Card With Background -->
                    <div class="card card_default card_default_with_background grid-item">
                        <div class="card_background" style="background-image:url(<?php assets(); ?>/images/post_12.jpg)"></div>
                        <div class="card-body">
                            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>

        </div>
        <?php
        exit();
    }

    public static function button($total_posts = 0, $limit = 10)
    {
        if ($total_posts > $limit) {
        ?>
            <div class="load_more">
                <div id="load_more" class="load_more_button text-center trans_200">Load More (<?php echo $total_posts; ?>)</div>
            </div>
        <?php
        }
    }
}
$Loadmore = new Loadmore();
