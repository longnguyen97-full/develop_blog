<?php
/**
 * The sidebar containing the sub widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sub' ) ) {
    return;
}
?>

<aside>
    <?php dynamic_sidebar( 'sub' ); ?>
</aside><!-- #secondary -->
