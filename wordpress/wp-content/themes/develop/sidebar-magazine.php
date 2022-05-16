<?php
/**
 * The sidebar containing the widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'magazine' ) ) {
    return;
}
$sideBarWidgets = wp_get_sidebars_widgets();
// $total = count($sideBarWidgets['magazine']);
// $col_num = floor( 12 / sizeof( $sideBarWidgets['magazine'], true ) );
$args = ['6','3','3','4','4','4','3','3','6'];
echo '<div class="row">';
foreach ( $sideBarWidgets['magazine'] as $k => $value ) {
    echo '<div class="col-sm-' . $args[$k] . '">';
    theme_show_widget('magazine', $value);
    echo '</div>';
}
echo '</div>';
?>
