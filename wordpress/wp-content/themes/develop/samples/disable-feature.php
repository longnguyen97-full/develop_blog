<?php
/**
 * The function for disable default feature of wordpress
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */
$replace_blog_to_website_meta          = false;
$remove_slash_meta_tag_link            = false;
$disable_editor_by_template_args       = array();

/**
 * theme_disable_crop_image
 * disable crop image feature
 * @param  boolean $disable
 */
function theme_disable_crop_image( $disable = true ) {
    if ( $disable === true ) {
        add_filter( 'image_resize_dimensions', function ( $enable, $orig_w, $orig_h, $dest_w, $dest_h, $crop )
        {
            // Instantly disable this filter after the first run
            // remove_filter( current_filter(), __FUNCTION__ );
            // return image_resize_dimensions( $orig_w, $orig_h, $dest_w, $dest_h, false );
            return false;
        }, 10, 6 );

        add_action( 'init', function () {
            foreach ( get_intermediate_image_sizes() as $size ) {
                remove_image_size( $size );
            }
        } );
    }
}

/**
 * theme_disable_wp_generator
 * remove WordPress Generator (with version information)
 * @param  boolean $disable
 */
function theme_disable_wp_generator( $disable = true ) {
    if ( $disable === true ) {
        remove_action('wp_head', 'wp_generator');
    }
}

/**
 * theme_disable_emoji
 * remove wp emoji
 * @param  boolean $disable
 */
function theme_disable_emoji( $disable = true ) {
    if ( $disable === true ) {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }
}

/**
 * theme_disable_json_api
 * remove the WordPress JSON API link
 * @param  boolean $disable
 */
function theme_disable_json_api( $disable = true ) {
    if ( $disable === true ) {
        remove_action( 'wp_head','rest_output_link_wp_head');
        remove_action( 'wp_head','wp_oembed_add_discovery_links');
        remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
    }
}

/**
 * theme_disable_wlwmanifes
 * remove Windows Live Writer Manifest Link
 * @param  boolean $disable
 */
function theme_disable_wlwmanifest( $disable = true ) {
    if ( $disable === true ) {
        remove_action( 'wp_head', 'wlwmanifest_link');
    }
}

/**
 * theme_disable_rsd
 * remove Weblog Client Link
 * @param  boolean $disable
 */
function theme_disable_rsd( $disable = true ) {
    if ( $disable === true ) {
        remove_action ('wp_head', 'rsd_link');
    }
}

/**
 * theme_disable_shortlink
 * remove WordPress Page/Post Shortlinks
 * @param  boolean $disable
 */
function theme_disable_shortlink( $disable = true ) {
    if ( $disable === true ) {
        remove_action( 'wp_head', 'wp_shortlink_wp_head');
    }
}

/**
 * theme_disable_link_canonical
 * Remove canonical link
 * @param  boolean $disable
 */
function theme_disable_link_canonical( $disable = true ) {
    if ( $disable === true ) {
        remove_action('wp_head', 'rel_canonical');
    }
}

/**
 * theme_disable_embed_script
 * remove wp-embed.min.js
 * @param  boolean $disable
 */
function theme_disable_embed_script( $disable = true ) {
    if ( $disable === true ) {
        add_action( 'wp_footer', function(){
            wp_deregister_script( 'wp-embed' );
        } );
    }
}

/**
 * theme_disable_svg_icons
 * remove include svg icons
 * @param  boolean $disable
 */
function theme_disable_svg_icons( $disable = true ) {
    if ( $disable === true ) {
        remove_action( 'wp_footer', 'twentyseventeen_include_svg_icons', 9999 );
    }
}

/**
 * theme_remove_core_updates
 * Remove update notifications Without error notices
 */
function theme_remove_core_updates() {
    global $wp_version;
    return (object) array(
        'last_checked'    => time(),
        'version_checked' => $wp_version,
        'updates'         => array()
    );
}

/**
 * theme_disable_update_core
 * Remove update notifications Without error notices
 * @param  boolean $disable
 */
function theme_disable_update_core( $disable = true ) {
    if ( $disable === true ) {
        // Remove update notifications for core.
        add_filter('pre_site_transient_update_core','__return_null');
        // Remove update notifications Without error notices for core
        add_filter('pre_site_transient_update_core','theme_remove_core_updates');
    }
}

/**
 * theme_disable_update_plugins
 * Remove update notifications for plugins.
 * @param  boolean $disable
 */
function theme_disable_update_plugins( $disable = true ) {
    if ( $disable === true ) {
        // Remove update notifications for plugins.
        add_filter('pre_site_transient_update_plugins','__return_null');
        // Remove update notifications Without error notices for plugins
        add_filter('pre_site_transient_update_plugins','cba_remove_core_updates');
    }
}

/**
 * theme_disable_update_themes
 * Remove update notifications for themes.
 * @param  boolean $disable
 */
function theme_disable_update_themes( $disable = true ) {
    if ( $disable === true ) {
        // Remove update notifications for themes.
        add_filter('pre_site_transient_update_themes','__return_null');
        // Remove update notifications Without error notices for themes
        add_filter('pre_site_transient_update_themes','cba_remove_core_updates');
    }
}

/**
 * theme_disable_check_version_core
 * Disable check version core
 * APIによるバージョンチェックの通信をさせない
 * @param  boolean $disable
 */
function theme_disable_check_version_core( $disable = true ) {
    if ( $disable_check_version_core === true ) {
        remove_action('wp_version_check', 'wp_version_check');
        remove_action('admin_init', '_maybe_update_core');
    }
}

/**
 * theme_remove_menu_dashboard
 * @param  boolean $remove
 */
function theme_remove_menu_dashboard( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'index.php' ); });
    }
}

/**
 * theme_remove_menu_jetpack
 * @param  boolean $remove
 */
function theme_remove_menu_jetpack( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'jetpack' ); });
    }
}

/**
 * theme_remove_menu_posts
 * @param  boolean $remove
 */
function theme_remove_menu_posts( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'edit.php' ); });
    }
}

/**
 * theme_remove_menu_media
 * @param  boolean $remove
 */
function theme_remove_menu_media( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'upload.php' ); });
    }
}

/**
 * theme_remove_menu_pages
 * @param  boolean $remove
 */
function theme_remove_menu_pages( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'edit.php?post_type=page' ); });
    }
}

/**
 * theme_remove_menu_comments
 * @param  boolean $remove
 */
function theme_remove_menu_comments( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'edit-comments.php' ); });
    }
}

/**
 * theme_remove_menu_appearance
 * @param  boolean $remove
 */
function theme_remove_menu_appearance( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'themes.php' ); });
    }
}

/**
 * theme_remove_menu_appearance_customize
 * @param  boolean $remove
 */
function theme_remove_menu_appearance_customize( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'themes.php', 'customize.php' ); });
    }
}

/**
 * theme_remove_menu_appearance_widgets
 * @param  boolean $remove
 */
function theme_remove_menu_appearance_widgets( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'themes.php', 'widgets.php' ); });
    }
}

/**
 * theme_remove_menu_appearance_menu
 * @param  boolean $remove
 */
function theme_remove_menu_appearance_menu( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'themes.php', 'nav-menus.php' ); });
    }
}

/**
 * theme_remove_menu_plugins
 * @param  boolean $remove
 */
function theme_remove_menu_plugins( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'plugins.php' ); });
    }
}

/**
 * theme_remove_menu_users
 * @param  boolean $remove
 */
function theme_remove_menu_users( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'users.php' ); });
    }
}

/**
 * theme_remove_menu_tools
 * @param  boolean $remove
 */
function theme_remove_menu_tools( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'tools.php' ); });
    }
}

/**
 * theme_remove_menu_settings
 * @param  boolean $remove
 */
function theme_remove_menu_settings( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_menu_page( 'options-general.php' ); });
    }
}

/**
 * theme_remove_menu_settings_writing
 * @param  boolean $remove
 */
function theme_remove_menu_settings_writing( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'options-general.php', 'options-writing.php' ); });
    }
}

/**
 * theme_remove_menu_settings_reading
 * @param  boolean $remove
 */
function theme_remove_menu_settings_reading( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'options-general.php', 'options-reading.php' ); });
    }
}

/**
 * theme_remove_menu_settings_discussion
 * @param  boolean $remove
 */
function theme_remove_menu_settings_discussion( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'options-general.php', 'options-discussion.php' ); });
    }
}

/**
 * theme_remove_menu_settings_media
 * @param  boolean $remove
 */
function theme_remove_menu_settings_media( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'options-general.php', 'options-media.php' ); });
    }
}

/**
 * theme_remove_menu_settings_permalink
 * @param  boolean $remove
 */
function theme_remove_menu_settings_permalink( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'options-general.php', 'options-permalink.php' ); });
    }
}

/**
 * theme_remove_menu_settings_privacy
 * @param  boolean $remove
 */
function theme_remove_menu_settings_privacy( $remove = true ) {
    if ( $remove === true ) {
        add_action( 'admin_menu', function() { remove_submenu_page( 'options-general.php', 'privacy.php' ); });
    }
}

/**
 * theme_disable_editor_post
 * @param  boolean $disable
 */
function theme_disable_editor_post( $disable = true ) {
    if ( $disable === true ) {
        add_action( 'admin_init', function() { remove_post_type_support('post', 'editor'); });
    }
}

/**
 * theme_disable_editor_page
 * @param  boolean $disable
 */
function theme_disable_editor_page( $disable = true ) {
    if ( $disable === true ) {
        add_action( 'admin_init', function() { remove_post_type_support('page', 'editor'); });
    }
}

/**
 * theme_disable_jquery_core
 * @param  boolean $disable
 */
function theme_disable_jquery_core( $disable = true ) {
    add_action( 'wp_default_scripts', function( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];
            if ( $script->deps ) { // Check whether the script has any dependencies
                $script->deps = array_diff( $script->deps, array( 'jquery-core' ) );
            }
        }
    } );
}

/**
 * theme_disable_jquery_migrate
 * @param  boolean $disable
 */
function theme_disable_jquery_migrate( $disable = true ) {
    add_action( 'wp_default_scripts', function( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];
            if ( $script->deps ) { // Check whether the script has any dependencies
                $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
            }
        }
    } );
}

/**
 * theme_disable_feed_links
 * @param  boolean $disable_feed_links
 */
function theme_disable_feed_links( $disable_feed_links = true ) {
    if ( $disable_feed_links === true ) {
        remove_action( 'wp_head','feed_links', 2 );
        remove_action( 'wp_head','feed_links_extra', 3 );
    }
}

/**
 * theme_disable_dns_prefetch
 * Remove WP 4.9+ dns-prefetch
 * @param  boolean $disable_dns_prefetch
 */
function theme_disable_dns_prefetch( $disable_dns_prefetch = true ) {
    if ( $disable_dns_prefetch === true ) {
        remove_action( 'wp_head', 'wp_resource_hints', 2 );
    }
}

/**
 * Hide editor on specific pages.
 */
add_action( 'admin_init', function() {
    global $disable_editor_by_template_args;
    $post_id = isset($_GET['post']) ? $_GET['post'] : 0 ;
    // Hide the editor on a page with a specific page template
    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if ( !empty($disable_editor_by_template_args) && in_array($template_file, $disable_editor_by_template_args) ) {
        remove_post_type_support('page', 'editor');
    }
});

/**
 * 1-Remove slash on meta tag and link tag
 * 2-Replace blog to website in meta tag of SEO
 */
add_action('wp_head', function() {
    ob_start();
}, 0);
add_action('wp_head',function () {
    $head = ob_get_clean();
    global $remove_slash_meta_tag_link;
    global $replace_blog_to_website_meta;

    /**
     * Remove slash on meta tag and link tag
     * /> to >
     */
    if ( $remove_slash_meta_tag_link === true ) {
        $head = preg_replace('/\ \/>/', '>', $head);
    }

    // Replace blog to website in meta tag of SEO
    if ( is_front_page() && $replace_blog_to_website_meta === true ) {
        $find    = '<meta property="og:type" content="blog">';
        $replace = '<meta property="og:type" content="website">';
        $head    = str_replace($find, $replace, $head);
    }

    echo $head;
}, 998);
