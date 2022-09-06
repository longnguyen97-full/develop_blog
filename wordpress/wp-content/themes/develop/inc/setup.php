<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
add_action( 'after_setup_theme', 'theme_setups');
function theme_setups() {

    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/themestandard
     * If you're building a theme based on Twenty Seventeen, use a find and replace
     * to change 'themestandard' to the name of your theme in all the template files.
     */
    // load_theme_themestandard( TEXT_DOMAIN, get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    // set_post_thumbnail_size( 1568, 9999 );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'primary' => __( 'Primary', 'themestandard' ),
            'footer'  => __( 'Footer Menu', 'themestandard' ),
            'social'  => __( 'Social Links Menu', 'themestandard' ),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );

    /**
     * Set content-width.
     * https://codex.wordpress.org/Content_Width
     */
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 600;
    }

    /**
     * Customize - Site Identity - Logo
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 190,
            'width'       => 190,
            'flex-width'  => true,
            'flex-height' => true,
            'header-text' => array( 'site-title', 'site-description' ),
            'unlink-homepage-logo' => true,
        )
    );

    /**
     * Customize - Header Image
     */
    $args = array(
        // 'default-image'      => get_template_directory_uri() . '/images/default-image.jpg',
        'default-image'      => 'https://dummyimage.com/1140x250/f9f9f9/cccccc.jpg',
        'default-text-color' => '212529',
        'width'              => 1140,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );

    $header_images = array(
        'demo1' => array(
                'url'           => 'https://dummyimage.com/1140x250/f9f9f9/cccccc.jpg',
                'thumbnail_url' => 'https://dummyimage.com/1140x250/f9f9f9/cccccc.jpg',
                'description'   => 'demo1',
        ),
        'demo2' => array(
                'url'           => 'https://dummyimage.com/1140x250/f9f9f9/cccccc.jpg',
                'thumbnail_url' => 'https://dummyimage.com/1140x250/f9f9f9/cccccc.jpg',
                'description'   => 'demo2',
        ),
    );
    register_default_headers( $header_images );

    /**
     * Customize - Background Image
     */
    $args = array(
        'default-color' => 'ffffff',
        // 'default-image' => 'https://dummyimage.com/1000x250/f9f9f9/cccccc.jpg',
    );
    add_theme_support( 'custom-background', $args );

    /**
     * Theme Support - Default block styles
     * Add support for Block Styles. (wp-block-library-theme-css)
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    // add_theme_support( 'wp-block-styles' );

    /**
     * Theme Support - Wide Alignment
     * Add support for full and wide align images.
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support( 'align-wide' );

    /**
     * Theme Support - Block Color Palettes
     * Editor color palette.
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => __( 'Primary', 'themestandard' ),
                'slug'  => 'primary',
                'color' => get_theme_mod( 'primary_color_hue', 199 ),
            ),
            array(
                'name'  => __( 'Secondary', 'themestandard' ),
                'slug'  => 'secondary',
                'color' => get_theme_mod( 'primary_color_hue', 199 ),
            ),
            array(
                'name'  => __( 'Dark Gray', 'themestandard' ),
                'slug'  => 'dark-gray',
                'color' => '#111',
            ),
            array(
                'name'  => __( 'Light Gray', 'themestandard' ),
                'slug'  => 'light-gray',
                'color' => '#767676',
            ),
            array(
                'name'  => __( 'White', 'themestandard' ),
                'slug'  => 'white',
                'color' => '#FFF',
            ),
        )
    );

    /**
     * Theme Support - Block Gradient Presets
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support(
        'editor-gradient-presets',
        array(
            array(
                'name'     => __( 'Vivid cyan blue to vivid purple', 'themestandard' ),
                'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
                'slug'     => 'vivid-cyan-blue-to-vivid-purple'
            ),
            array(
                'name'     => __( 'Vivid green cyan to vivid cyan blue', 'themestandard' ),
                'gradient' => 'linear-gradient(135deg,rgba(0,208,132,1) 0%,rgba(6,147,227,1) 100%)',
                'slug'     =>  'vivid-green-cyan-to-vivid-cyan-blue',
            ),
            array(
                'name'     => __( 'Light green cyan to vivid green cyan', 'themestandard' ),
                'gradient' => 'linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%)',
                'slug'     => 'light-green-cyan-to-vivid-green-cyan',
            ),
            array(
                'name'     => __( 'Luminous vivid amber to luminous vivid orange', 'themestandard' ),
                'gradient' => 'linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)',
                'slug'     => 'luminous-vivid-amber-to-luminous-vivid-orange',
            ),
            array(
                'name'     => __( 'Luminous vivid orange to vivid red', 'themestandard' ),
                'gradient' => 'linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%)',
                'slug'     => 'luminous-vivid-orange-to-vivid-red',
            ),
        )
    );

    /**
     * Theme Support - Block Font Sizes
     * Add custom editor font sizes.
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name'      => __( 'Small', 'themestandard' ),
                'shortName' => __( 'S', 'themestandard' ),
                'size'      => 12,
                'slug'      => 'small',
            ),
            array(
                'name'      => __( 'Normal', 'themestandard' ),
                'shortName' => __( 'M', 'themestandard' ),
                'size'      => 16,
                'slug'      => 'normal',
            ),
            array(
                'name'      => __( 'Large', 'themestandard' ),
                'shortName' => __( 'L', 'themestandard' ),
                'size'      => 36,
                'slug'      => 'large',
            ),
            array(
                'name'      => __( 'Huge', 'themestandard' ),
                'shortName' => __( 'XL', 'themestandard' ),
                'size'      => 50,
                'slug'      => 'huge',
            ),
        )
    );

    /**
     * Theme Support - Supporting custom line heights
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support( 'custom-line-height' );

    /**
     * Theme Support - Editor styles
     * Add support for editor styles.
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support( 'editor-styles' );

    // Theme Support - Editor styles - Dark backgrounds
    add_theme_support( 'dark-editor-style' );

    /**
     * Theme Support - Enqueuing the editor style
     * Enqueue editor styles.
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_editor_style( 'style-editor.css' );

    /**
     * Theme Support - Responsive embedded content
     * Add support for responsive embedded content.
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support( 'responsive-embeds' );

    /**
     * Theme Support - Spacing control
     * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support('custom-spacing');

    /**
     * Add theme support for selective refresh for widgets.
     * https://developer.wordpress.org/reference/classes/wp_customize_widgets/get_selective_refreshable_widgets/
     */
    add_theme_support( 'customize-selective-refresh-widgets' );

}
// END Action after_setup_theme

/**
 * Register custom fonts.
 */
function themestandard_fonts_url() {
    $fonts_url = '';

    /*
     * Translators: If there are characters in your language that are not
     * supported by Libre Franklin, translate this to 'off'. Do not translate
     * into your own language.
     */
    $libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'themestandard' );

    if ( 'off' !== $libre_franklin ) {
        $font_families = array();

        $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'theme_add_scripts_styles');
function theme_add_scripts_styles() {

    if (!is_customize_preview()) {
        wp_enqueue_script( TEXT_DOMAIN . '-jquery', get_stylesheet_directory_uri() . '/assets/js/jquery-3.5.1.slim.min.js', array(), '3.5.1', false );
    }

    // bootstrap
    wp_enqueue_style( TEXT_DOMAIN . '-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.5.3' );
    wp_enqueue_script( TEXT_DOMAIN . '-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '4.5.3', false );

    if (is_page_template('templates/magazine.php')) {
        // slick
        wp_enqueue_style( TEXT_DOMAIN . '-slick', get_stylesheet_directory_uri() . '/assets/slick/slick.css', array(), '1.8.1' );
        wp_enqueue_style( TEXT_DOMAIN . '-slick-theme', get_stylesheet_directory_uri() . '/assets/slick/slick-theme.css', array(), '1.8.1' );
        wp_enqueue_script( TEXT_DOMAIN . '-slick', get_stylesheet_directory_uri() . '/assets/slick/slick.min.js', array(), '1.8.1', false );
    }

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( TEXT_DOMAIN . '-fonts', themestandard_fonts_url(), array(), null );

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( TEXT_DOMAIN . '-ie8', getAssets() .'/css/ie8.css', array( TEXT_DOMAIN . '-theme' ), '1.0' );
    wp_style_add_data( TEXT_DOMAIN . '-ie8', 'conditional', 'lt IE 9' );

    // Load the html5 shiv.
    wp_enqueue_script( TEXT_DOMAIN . '-html5', getAssets() . '/js/html5.js', array(), '1.0' );
    wp_script_add_data( TEXT_DOMAIN . '-html5', 'conditional', 'lt IE 9' );

    // Theme script.
    wp_enqueue_script( TEXT_DOMAIN . '-script', getAssets() . '/js/script.js', array(), wp_get_theme()->get( 'Version' ), true );

    // Theme stylesheet.
    wp_enqueue_style( TEXT_DOMAIN . '-theme', getAssets() . '/css/style.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( TEXT_DOMAIN . '-theme-main', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // Custom theme stylesheet
    wp_enqueue_style( TEXT_DOMAIN . '-custom-theme', getAssets() . '/css/custom.css', array(), wp_get_theme()->get( 'Version' ) );

    // Author profile stylesheet
    wp_enqueue_style( TEXT_DOMAIN . '-author-profile', getAssets() . '/css/author-profile.css', array(), wp_get_theme()->get( 'Version' ) );

    // Article stylesheet
    wp_enqueue_style( TEXT_DOMAIN . '-article-profile', getAssets() . '/css/article.css', array(), wp_get_theme()->get( 'Version' ) );

    // Custom latest comment widget stylesheet
    wp_enqueue_style( TEXT_DOMAIN . '-custom-latest-comment-widget', getAssets() . '/css/custom-latest-comment-widget.css', array(), wp_get_theme()->get( 'Version' ) );

    // Fontawesome
    wp_enqueue_style( TEXT_DOMAIN . '-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css', array(), wp_get_theme()->get( 'Version' ) );

    // jQuery UI
    wp_enqueue_script( TEXT_DOMAIN . '-jquery-core', 'https://code.jquery.com/jquery-3.6.0.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_enqueue_script( TEXT_DOMAIN . '-jquery-ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array(), wp_get_theme()->get( 'Version' ), true );

    // Toogle tab
    wp_enqueue_script( TEXT_DOMAIN . '-toggle-tab', get_stylesheet_directory_uri() . '/assets/js/toggle-tab.js', array(), wp_get_theme()->get( 'Version' ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
// END Action wp_enqueue_scripts

add_action('wp_head', 'theme_add_script_top_head' , 0);
function theme_add_script_top_head() {
?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if (! wp_is_mobile()) : ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php endif;
}

/**
 * Print global variable url in javascript
 */
add_action('wp_head', 'theme_add_script_bottom_head' , 999);
function theme_add_script_bottom_head() {
    if (get_header_image()) :
    ?>
<style>
#site-header-image {
    padding: 0;
    padding-top: 70px;
}
.app_container {
    padding-top: 15px;
}
</style>
<?php if (is_page_template('templates/magazine.php')) : ?>
<style>
.slick-prev {
    left: 10px;
}
.slick-next {
    right: 10px;
}
.slick-prev,
.slick-next {
    z-index: 1;
}
</style>
    <?php endif; ?>
    <?php endif; ?>
    <?php if (is_page_template('templates/magazine.php')) : ?>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.slick_slider').slick({
        dots: true,
        infinite: true,
        speed: 300});
});
</script>
    <?php endif; ?>
<script type="text/javascript">
var urls = {
    home : "<?php url() ?>",
    theme : "<?php themeUrl() ?>",
    assets : "<?php assets() ?>",
}
</script>
<?php
}

// add a class as img-fluid to all the attachments in posts not the thumbnails.
function add_responsive_class_the_content($content)
{
    if (empty($content)) {
        return '';
    }
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $document = new DOMDocument();
    libxml_use_internal_errors(true);
    $document->loadHTML(utf8_decode($content));

    $imgs = $document->getElementsByTagName('img');
    foreach ($imgs as $img) {
        $img->setAttribute('class',$img->getAttribute('class') . ' img-fluid');
    }

    $html = $document->saveHTML();
    return $html;
}
add_filter('the_content', 'add_responsive_class_the_content');

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function theme_widget_tag_cloud_args( $args ) {
    $args['largest']  = 1;
    $args['smallest'] = 1;
    $args['unit']     = 'em';
    $args['format']   = 'list';

    return $args;
}
add_filter( 'widget_tag_cloud_args', 'theme_widget_tag_cloud_args' );
