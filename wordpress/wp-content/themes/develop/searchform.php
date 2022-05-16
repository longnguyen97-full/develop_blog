<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-1' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $unique_id; ?>" class="screen-reader-text">Search for:</label>
    <input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="Search &hellip;" value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit">Search</button>
</form>
