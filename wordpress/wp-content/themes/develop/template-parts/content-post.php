<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php the_post_thumbnail('post-thumbnail',['class' => 'img-fluid']) ?>

	<h1 class="entry-title"><?php the_title() ?></h1>

	<div class="entry-meta mb-5">
		<ul>
		<?php
		// Author
		if ( post_type_supports( get_post_type(), 'author' ) ) {
		?>
			<li class="post-author">
				<?php
				printf(
					/* translators: %s: Author name. */
					__( 'By %s', 'twentytwenty' ),
					'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>'
				);
				?>
			</li>
		<?php
		}
		?>
			<li class="post-date">
				<span>posted </span>
				<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
			</li>
		<?php
		// Sticky
		if ( is_sticky() ) {
			?>
			<li class="post-sticky"><?php _e( 'Sticky post', 'themestandard' ); ?></li>
			<?php
		}
		// Comments link
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<li class="post-comment-link">, <?php comments_popup_link(); ?></li>
			<?php
		}

		edit_post_link(__( 'Edit', 'themestandard' ), '<li>, ', '</li>');
		?>
		</ul>
		<?php
		// Categories
		if (has_category()) {
			?>
			<div class="entry-categories">
				Categories: <?php the_category( ', ' ); ?>
			</div>
			<?php
		}
		?>
	</div>

	<div class="content post-content mb-3">
		<?php the_content(); ?>
	</div>

	<?php get_reaction_template(get_the_ID(), 'post'); ?>

	<div class="link-pages mb-3">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links text-right" aria-label="' . esc_attr__( 'Page', 'themestandard' ) . '"><span class="label">' . __( 'Pages:', 'themestandard' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</div>

	<?php
	// Tags.
	if ( has_tag() ) { ?>
	<div class="entry-tags mb-3">
		Tags: <?php the_tags( '', ', ', '' ); ?>
	</div>
	<?php
	}

	the_post_navigation(
		array(
			'class'     => 'app_post_navigation',
			'prev_text' => __( '🡐 Previous Post<br> %title', 'themestandard' ),
			'next_text' => __( 'Next Post 🡒<br> %title', 'themestandard' ),
		)
	);

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>
		<div class="comments-wrapper">
			<?php comments_template(); ?>
		</div><!-- .comments-wrapper -->
		<?php
	}
	?>
</article><!-- .post -->
