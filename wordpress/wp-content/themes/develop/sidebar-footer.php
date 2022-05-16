<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'footer' ) ) {
    return;
}
?>

<aside class="container pt-5">
    <div class="row">
    	<?php dynamic_sidebar( 'footer' ); ?>
    </div>
</aside><!-- #secondary -->
