<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="container-xxl author-container">
	<div class="author-cover"></div>

	<div class="author-profile">

		<span>
			<img src="<?php echo get_image('user-avatar.jpg') ?>" alt="author-avatar" class="author-avatar">
		</span>

		<div class="author-info">

			<div class="section-common section-main">
				<h2><?php the_author_meta('display_name'); ?></h2>
				<p><?php the_author_nickname(); ?></p>
				<div>
					<span><?php the_author_meta('user_url'); ?></span>
				</div>
			</div>

			<div class="section-common section-left">
				<div>
					<h6>Biographic Info</h6>
					<p><?php the_author_meta('user_description'); ?></p>
				</div>
				<div><?php echo get_the_author_posts() ?> posts published</div>
				<div><?php echo get_the_author_comments() ?> comments written</div>
				<div><?php echo get_the_author_liked_posts() ?> posts liked</div>
			</div>

			<div class="section-common section-right">

		        <?php
		        if ( have_posts() ) :

		            while ( have_posts() ) : the_post();

		                get_template_part( 'template-parts/content', get_post_format() );

		                count_loaded_posts();

		            endwhile;
		            wp_reset_postdata();

		            the_loadmore();

		        else :

		            get_template_part( 'template-parts/content', 'none' );

		        endif;
		        ?>

			</div>

		</div><!-- author-info -->

	</div><!-- author-profile -->

</div>

<?php get_footer();
