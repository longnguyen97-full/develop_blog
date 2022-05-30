<header class="app_header">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( has_custom_logo() ) {
						echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
				} else {
					bloginfo();
				}
				?>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_main">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbar_main">
				<?php get_template_part( 'template-parts/global', 'navigation' ); ?>
				<?php get_search_form(); ?>
			</div>

			<?php mp_get_user_buttons(); ?>
		</nav>
	</div>
</header>
<?php if ( get_header_image() ) : ?>
	<div class="container text-center" id="site-header-image">
		<img src="<?php header_image(); ?>" class="img-fluid" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
	</div>
<?php endif; ?>
