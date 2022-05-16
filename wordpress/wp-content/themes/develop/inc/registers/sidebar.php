<?php
function theme_register_sidebar() {
    // Main
    register_sidebar( array(
        'name'          => 'Left sidebar',
        'id'            => 'main',
        'description'   => __( 'Widgets in this area will be shown on all posts.', 'themestandard' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer
    register_sidebar( array(
        'name'          => 'Footer sidebar',
        'id'            => 'footer',
        'description'   => __( 'Widgets in this area will be shown on all posts.', 'themestandard' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Magazine
    register_sidebar( array(
        'name'          => 'Magazine sidebar',
        'id'            => 'magazine',
        'description'   => __( 'Widgets in this area will be shown on all posts.', 'themestandard' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'theme_register_sidebar' );
