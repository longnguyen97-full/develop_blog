<?php

/**
 * The function support for member
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

if (!function_exists('mb_limit_text')) {
    function mb_limit_text($str = '', $byte = 64, $more = '…')
    {
        $str = mb_substr($str, 0, $byte);
        if (mb_strlen($str) >= $byte) {
            $str .= $more;
        }
        return $str;
    }
}

/**
 * cbaOrderByArray
 * @param  [array] $obj_args
 * @param  [array] $order_args
 * @return [array]
 * @example
 * $order_args = array('aichi','shizuoka','yamanashi')
 * $obj_args = array(3) {
 *        [0]=> (object) { "slug"=>"yamanashi" }
 *        [1]=> (object) { "slug"=>"shizuoka" }
 *        [2]=> (object) { "slug"=>"aichi" }
 *      }
 * @result
 *     array(3) {
 *        [0]=> (object) { "slug"=>"aichi" }
 *        [1]=> (object) { "slug"=>"shizuoka" }
 *        [2]=> (object) { "slug"=>"yamanashi" }
 *      }
 */
function cbaOrderByArray($obj_args, $order_args)
{
    $tmp_args = array();
    foreach ($order_args as $k1 => $order) {
        foreach ($obj_args as $k2 => $obj) {
            if ($obj->slug == $order) {
                $tmp_args[] = $obj;
                unset($obj_args[$k2]);
            }
        }
    }
    if (count($tmp_args) > 0 && count($obj_args)) {
        return array_merge($tmp_args, $obj_args);
    }
    return $tmp_args;
}

/**
 * the_build_url
 * @param  array   $args
 * @param  boolean $return
 * @return string
 */
if (!function_exists('the_build_url')) {
    function the_build_url($args = array(), $return = false)
    {
        if (!count($args)) {
            $args = $_GET;
        }
        if (count($args)) {
            $query = http_build_query($args);
            $query = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $query);
            if ($return) {
                return '?' . $query;
            } else {
                echo '?' . $query;
            }
        }
    }
}

/**
 * url
 * @param  boolean $return Echo or return
 * @return string url for home page
 */
if (!function_exists('url')) {
    function url($return = false)
    {
        if ($return === true) {
            return HOME_URL;
        } else {
            echo HOME_URL;
        }
    }
}

/**
 * getUrl
 * @return string url for home page
 */
if (!function_exists('getUrl')) {
    function getUrl()
    {
        return HOME_URL;
    }
}

/**
 * themeUrl
 * @param  boolean $return Echo or return
 * @return string url for theme
 */
if (!function_exists('themeUrl')) {
    function themeUrl($return = false)
    {
        if ($return === true) {
            return THEME_URL;
        } else {
            echo THEME_URL;
        }
    }
}

/**
 * getThemeUrl
 * @return string url for theme
 */
if (!function_exists('getThemeUrl')) {
    function getThemeUrl()
    {
        return THEME_URL;
    }
}

/**
 * assets
 * @param  boolean $return Echo or return
 * @return string url for assets folder
 */
if (!function_exists('assets')) {
    function assets($return = false)
    {
        if ($return === true) {
            return THEME_ASSETS;
        } else {
            echo THEME_ASSETS;
        }
    }
}

/**
 * getAssets
 * @return string url for assets folder
 */
if (!function_exists('getAssets')) {
    function getAssets()
    {
        return THEME_ASSETS;
    }
}

/**
 * The function support for redirect
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

if (!function_exists('cbaRedirectUrlTo404')) {
    /**
     * cbaRedirectUrlTo404 redirect to not found page with condition
     * @return none
     */
    function cbaRedirectUrlTo404()
    {
        $gotonotfound = false;
        if (!is_admin()) {

            // if ($condition){
            //     $gotonotfound = true;
            // }

            if ($gotonotfound === true) {
                global $wp_query;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            }
        }
    }
    // add_action( 'wp', 'cbaRedirectUrlTo404' );
}

if (!function_exists('cbaGoto404')) {
    /**
     * cbaGoto404 redirect to not found page
     * @return none
     */
    function cbaGoto404()
    {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        get_template_part(404);
        exit;
    }
}

if (!function_exists('custom_breadcrumbs')) {
    function custom_breadcrumbs()
    {
        $delimiter = '<span class="delimiter">›</span>';
        $home = 'Home';
        $before = '<span property="itemListElement" typeof="ListItem" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">';
        $after = '</span>';

        if (!is_home() && !is_front_page() || is_paged()) {

            echo '<nav aria-label="breadcrumb" class="breadcrumb-wrap">';
            echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">';
            global $post;

            $homeLink = get_bloginfo('url');

            $li_tag = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item"><a itemprop="item" href="%s"><span itemprop="name">%s</span></a><meta itemprop="position" content="%s" /></li> ' . $delimiter;
            $li2_tag = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item"><span itemprop="name">%s</span><meta itemprop="position" content="%s" /></li> ';

            printf($li_tag, $homeLink, $home, '1');

            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                $position = 1;
                if ($thisCat->parent != 0) {
                    $cats = get_category_parents($parentCat, true, '');
                    preg_match_all('/\<a href=\"(.*?)\"\>(.*?)<\/a\>/', $cats, $matches, PREG_PATTERN_ORDER);
                    foreach ($matches[1] as $k => $matche_url) {
                        $position = ($k + 2);
                        printf($li_tag, $matche_url, $matches[2][$k], $position);
                    }
                }
                printf($li2_tag, single_cat_title('', false), $position + 1);
            } elseif (is_day()) {
                // Day page
                printf($li_tag, get_year_link(get_the_time('Y')), get_the_time('Y'), '2');
                printf($li_tag, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'), '3');
                printf($li2_tag, get_the_time('d'), '4');
            } elseif (is_month()) {
                // Month page
                printf($li_tag, get_year_link(get_the_time('Y')), get_the_time('Y'), '2');
                printf($li2_tag, get_the_time('F'), '3');
            } elseif (is_year()) {
                // Year page
                printf($li2_tag, get_the_time('Y'), '3');
            } elseif (is_single() && !is_attachment()) {
                // Single page
                if (get_post_type() != 'post') {
                    // Other post type
                    $post_type = get_post_type_object(get_post_type());
                    if (is_string($post_type->has_archive)) {
                        $slug = $post_type->has_archive;
                    } else {
                        $slug = $post_type->rewrite;
                        $slug = $slug['slug'];
                    }
                    printf($li_tag, $homeLink . '/' . $slug, $post_type->labels->singular_name, 3);
                    printf($li2_tag, get_the_title(), 3);
                } else {
                    // Post type "Post"
                    $cat = get_the_category();
                    $position = 2;
                    if (!empty($cat)) {
                        $cat = $cat[0];
                        printf($li_tag, get_category_link($cat->term_id), $cat->name, '2');
                        $position = 3;
                    }
                    printf($li2_tag, get_the_title(), $position);
                }
                // } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                //     $post_type = get_post_type_object(get_post_type());
                //     echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                // attachment page
                $parent = get_post($post->post_parent);
                $parentCat = get_the_category($parent->ID);
                $parentCat = $parentCat[0];
                $cats = get_category_parents($parentCat, true, '');
                preg_match_all('/\<a href=\"(.*?)\"\>(.*?)<\/a\>/', $cats, $matches, PREG_PATTERN_ORDER);
                foreach ($matches[1] as $k => $matche_url) {
                    $position = ($k + 2);
                    printf($li_tag, $matche_url, $matches[2][$k], $position);
                }
                printf($li_tag, get_permalink($parent), $parent->post_title, $position + 1);
                printf($li2_tag, get_the_title(), $position + 2);
            } elseif (is_page() && !$post->post_parent) {
                // Page not parent
                printf($li2_tag, get_the_title(), '2');
            } elseif (is_page() && $post->post_parent) {
                // Page with parent
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = sprintf($li_tag, get_permalink($page->ID), get_the_title($page->ID), '%s');
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                $i = 2;
                foreach ($breadcrumbs as $crumb) {
                    printf($crumb, $i);
                    $i++;
                }
                printf($li2_tag, get_the_title(), $i++);
            } elseif (is_search()) {
                // Search page
                printf($li2_tag, 'Search for "' . get_search_query() . '"', '2');
            } elseif (is_tag()) {
                // Tag pagepage
                printf($li2_tag, 'Tag "' . single_tag_title('', false) . '"', '2');
            } elseif (is_author()) {
                // Author page
                global $author;
                $userdata = get_userdata($author);
                printf($li2_tag, 'Author "' . $userdata->display_name . '"', '2');
            } elseif (is_404()) {
                printf($li2_tag, '404 Page not found', '2');
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ' (';
                }
                echo __('Page') . ' ' . get_query_var('paged');
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ')';
                }
            }

            echo '</ol>';
            echo '</nav>';
        }
    }
}

/**
 * Show a given widget based on it’s id and it’s sidebar index
 *
 * Example: wpse_show_widget( ‘sidebar-1’, ‘calendar-2’ )
 *
 * @param string $index. Index of the sidebar where the widget is placed in.
 * @param string $id. Id of the widget.
 * @return boolean. TRUE if the widget was found and called, else FALSE.
 */
function theme_show_widget($index, $id)
{
    global $wp_registered_widgets, $wp_registered_sidebars;
    $did_one = false;

    // Check if $id is a registered widget
    if (!isset($wp_registered_widgets[$id]) || !isset($wp_registered_widgets[$id]['params'][0])) {
        return false;
    }

    // Check if $index is a registered sidebar
    $sidebars_widgets = wp_get_sidebars_widgets();
    if (empty($wp_registered_sidebars[$index]) || empty($sidebars_widgets[$index]) || !is_array($sidebars_widgets[$index])) {
        return false;
    }

    // Construct $params
    $sidebar = $wp_registered_sidebars[$index];
    $params = array_merge(array(array_merge($sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']))), (array) $wp_registered_widgets[$id]['params']);

    // Substitute HTML id and class attributes into before_widget
    $classname_ = '';
    foreach ((array) $wp_registered_widgets[$id]['classname'] as $cn) {
        if (is_string($cn)) {
            $classname_ .= '_' . $cn;
        } elseif (is_object($cn)) {
            $classname_ .= '_' . get_class($cn);
        }
    }

    $classname_ = ltrim($classname_, '_');

    $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);
    $params = apply_filters('dynamic_sidebar_params', $params);

    // Run the callback
    $callback = $wp_registered_widgets[$id]['callback'];
    if (is_callable($callback)) {
        call_user_func_array($callback, $params);
        $did_one = true;
    }

    return $did_one;
}

/**
 * Load more post
 */
function the_loadmore()
{
    $LoadmorePosts = new LoadmorePosts();
    $LoadmorePosts->loadmoreButton();
}

function count_loaded_posts($post = 0)
{
    $post = !empty($post) ? $post : get_the_ID();
    if (empty($post)) {
        return;
    }

    // session_start();
    $_SESSION['loaded_posts'] = !empty($_SESSION['loaded_posts']) ? $_SESSION['loaded_posts'] + 1 : 1;
}

function get_loaded_posts()
{
    $loaded_post = isset($_SESSION['loaded_posts']) ? $_SESSION['loaded_posts'] : 0;
    unset($_SESSION['loaded_posts']);

    return $loaded_post;
}

/**
 * Count posts by taxonomy, author,...
 */
function custom_count_posts($args = array())
{
    $default_args = array('posts_per_page' => -1);
    return count(get_posts(array_merge($args, $default_args)));
}

function count_cat_posts($category)
{
    return custom_count_posts(array('cat' => $category));
}

function count_tag_posts($tag)
{
    return custom_count_posts(array('tag_id' => $tag));
}

function count_author_posts($author)
{
    return custom_count_posts(array('author' => $author));
}

/**
 * Reaction blog, comment
 * @param integer $id (blog_id, comment_id)
 */
function get_reaction_template($id = 0, $post_type = 'post')
{
    $ReactionPost = new ReactionPost();
    $ReactionPost->setData($id, $post_type);
    $ReactionPost->getData();
}

/**
 * Get data of field form table
 * @param string $field
 * @param string $table
 * @return query object for the loop
 */
function get_data_from_table($field = '', $table = '', $where = array())
{
    global $wpdb;
    $table = strpos($table, 'wp_') !== false ? $table : $wpdb->prefix . $table;
    if (!empty($where)) {
        $key   = end(array_keys($where)) ?: '';
        $value = end(array_values($where)) ?: '';
        $where = "{$key} = '{$value}'";
    }
    $query = !empty($where) ? "SELECT {$field} FROM {$table} WHERE {$where}" : "SELECT {$field} FROM {$table}";
    $posts = $wpdb->get_results($wpdb->prepare($query));

    foreach ($posts as $post) {
        $post_ids[] = $post->post_id;
    }

    return !empty($post_ids) ? new WP_Query(array('post__in' => $post_ids, 'post__not_in' => get_option('sticky_posts'))) : false;
}

/**
 * Hide admin toolbar with non-admin accounts
 */
add_action('wp', 'wpdocs_maybe_hide_admin_bar');
add_action('admin_init', 'wpdocs_maybe_hide_admin_bar', 9);
function wpdocs_maybe_hide_admin_bar()
{
    if (!current_user_can('manage_options')) {
        show_admin_bar(false);
    }
}

/**
 * Show nickname with author link instead of author display name
 */
add_filter('get_comment_author_link', function ($content) {
    return replace_between_anchor($content, get_user_meta(get_comment_user_id(), 'nickname', true));
}, 99);

function get_comment_user_id()
{
    global $comment;
    return $comment->user_id;
}

function replace_between_anchor($content, $replace)
{
    $pattern = '#(<a.*?>).*?(</a>)#';
    $replace = "$1{$replace}$2";
    return preg_replace($pattern, $replace, $content);
}

/**
 * Counting words in text
 */
function count_words($text)
{
    return sizeof(explode(' ', $text));
}

function get_duration_reading($post_content)
{
    $words = count_words($post_content);
    if ($words < 350) {
        return 'Duration: less than 1 minute';
    }

    return 'Duration: ' . round($words / 350) . ' minutes';
}

/**
 * Get image from images folder
 */
function get_image($image)
{
    return THEME_ASSETS . '/images/' . $image;
}

/**
 * Author functions
 */
function get_the_author_comments()
{
    $author   = get_the_author_meta('display_name');
    $comments = get_comments();

    $total_comment = 0;
    foreach ($comments as $comment) {
        if ($comment->comment_author == $author) {
            $total_comment++;
        }
    }

    return $total_comment;
}

function get_the_author_liked_posts()
{
    global $wpdb;
    $table  = "{$wpdb->prefix}reactions";
    $author = get_the_author_id();
    $query  = "SELECT COUNT(user_id) FROM $table WHERE post_type = 'post' AND user_id = {$author}";

    return $wpdb->get_var($query);
}

/**
 * Bookmark button
 */
function get_bookmark_template()
{
    $BookmarkPost = new BookmarkPost();
    $BookmarkPost->bookmarkForm();
}

/**
 * Debug function
 *
 * @param array $data
 * @param boolean $exit
 * @return void
 */
function arr_dump($data = [], $exit = false)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    $exit ? exit() : '';
}

/**
 * Print author is wappred an anchor tag outside of loop
 *
 * @param array $post
 * @return void
 */
function get_the_author_posts_link_outside_loop($post = [])
{
    $post_author = get_the_author_meta('display_name', $post->post_author);
    $author_link = get_author_posts_url($post->post_author);
    return "<a href='$author_link'>$post_author</a>";
}

/**
 * Get social url for sharing post to social networks
 *
 * @param string $service
 * @param string $url
 * @param string $title
 * @return void
 */
function the_social_url($service, $url, $title = '')
{
    if ($service == 'facebook') {
        echo "https://www.facebook.com/sharer/sharer.php?u=$url";
    } else if ($service == 'twitter') {
        echo $title
            ? 'https://twitter.com/home?status=' . rawurlencode($title) . "%3A%20$url"
            : "https://twitter.com/home?status=$url";
    } else if ($service == 'google_plus') {
        echo "https://plus.google.com/share?url=$url";
    } else {
        echo '#';
    }
}

function redirect_404()
{
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
}

// register image size
add_image_size('post-thumbnail-200', 200, 200, true);