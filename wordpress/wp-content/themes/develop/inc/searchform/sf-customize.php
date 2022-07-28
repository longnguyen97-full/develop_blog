<?php
function sf_customize( $form )
{
	$uniqid = uniqid();
	return
	'<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '" id="searchform">
		<label for="search-form-' . $uniqid . '" class="screen-reader-text">' . __( 'Search:' ) . '</label>
		<input type="search" id="search-form-' . $uniqid . '" class="search-field" placeholder="Search …" value="' . get_search_query() . '" name="s">
		<button type="submit" class="search-submit" id="searchsubmit"><i class="fa-solid fa-magnifying-glass"></i></button>
	</form>';
}
add_filter( 'get_search_form', 'sf_customize', 40 );
