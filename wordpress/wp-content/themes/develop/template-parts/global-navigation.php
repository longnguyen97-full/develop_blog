<?php
if ( has_nav_menu( 'primary' ) ) {

    wp_nav_menu( array(
        'theme_location'  => 'primary',
        'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
        'container'       => 'nav',
        'container_class' => 'main_nav',
        'items_wrap'      => '<ul>%3$s</ul>',
        'fallback_cb'     => false,
        'walker'          => new WP_Bootstrap_Navwalker(),
    ) );

}
?>
