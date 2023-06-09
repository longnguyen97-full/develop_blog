<?php
/**
 * Require other php file
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

// Helper functions
require get_parent_theme_file_path( '/inc/helper.php' );

/**
 * Register Sidebar
 */
require get_parent_theme_file_path( '/inc/registers/sidebar.php' );

/**
 * Custom SEO tags
 */
require get_parent_theme_file_path( '/inc/seo.php' );


/**
 * Setup theme
 */
require get_parent_theme_file_path( '/inc/setup.php' );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/inc/classes/class-wp-bootstrap-navwalker.php';
	require_once get_template_directory() . '/inc/classes/class-wp-bootstrap-comment-walker.php';
    require_once get_template_directory() . '/inc/classes/class-wp-loadmore-posts.php';
    require_once get_template_directory() . '/inc/classes/class-wp-bookmark.php';
    require_once get_template_directory() . '/inc/classes/class-wp-count-post-view.php';
    require_once get_template_directory() . '/inc/classes/class-wp-menu-item-custom-field.php';
    require_once get_parent_theme_file_path( '/inc/classes/class-wp-comment.php' );
    require_once get_parent_theme_file_path( '/inc/classes/class-wp-reaction.php' );
    require_once get_parent_theme_file_path( '/inc/classes/class-wp-authentication.php' );
}
add_action( 'after_setup_theme', 'register_navwalker' );

require get_parent_theme_file_path( '/inc/registers/customize.php' );
require get_parent_theme_file_path( '/inc/widgets/article-by-category.php' );
require get_parent_theme_file_path( '/inc/widgets/list-category.php' );
require get_parent_theme_file_path( '/inc/widgets/list-archive.php' );
require get_parent_theme_file_path( '/inc/widgets/select-tag.php' );
// require get_parent_theme_file_path( '/inc/widgets/most-viewed-post.php' );
