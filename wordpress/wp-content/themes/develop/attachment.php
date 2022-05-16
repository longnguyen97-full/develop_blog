<?php
/**
 * The loop that displays an attachment
 *
 * The loop displays the posts and the post content. See
 * https://developer.wordpress.org/themes/basics/the-loop/ to understand it and
 * https://developer.wordpress.org/themes/basics/template-tags/ to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-attachment.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */

get_header(); ?>
<main class="app_container container">
    <div class="row">
        <div class="col col-md-8">
		<?php
		if ( have_posts() ) :
			get_template_part( 'template-parts/global', 'breadcrumbs' );
			while ( have_posts() ) : the_post();

				if ( ! empty( $post->post_parent ) ) :
					/* translators: %s: Post title. */
					$post_title = sprintf( __( 'Return to %s', 'themestandard' ), strip_tags( get_the_title( $post->post_parent ) ) );
					?>
					<p class="page-title"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php echo esc_attr( $post_title ); ?>" rel="gallery">
						<?php
						/* translators: %s: Title of parent post. */
						printf( __( '<span class="meta-nav">&larr;</span> %s', 'themestandard' ), get_the_title( $post->post_parent ) );
						?>
					</a></p>
				<?php endif; ?>

				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<h1><?php the_title(); ?></h1>

					<div class="post-meta mb-5">
						<?php
						printf(
							/* translators: %s: Author display name. */
							__( '<span class="%1$s">By</span> %2$s', 'themestandard' ),
							'meta-prep meta-prep-author',
							sprintf(
								'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
								get_author_posts_url( get_the_author_meta( 'ID' ) ),
								/* translators: %s: Author display name. */
								esc_attr( sprintf( __( 'View all posts by %s', 'themestandard' ), get_the_author() ) ),
								get_the_author()
							)
						);
						echo '<span class="meta-sep">|</span>';
						printf(
							/* translators: 1: CSS classes, 2: Date. */
							__( '<span class="%1$s">Published</span> %2$s', 'themestandard' ),
							'meta-prep meta-prep-entry-date',
							sprintf(
								'<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
								esc_attr( get_the_time() ),
								get_the_date()
							)
						);
						if ( wp_attachment_is_image() ) {
							echo ' <span class="meta-sep">|</span> ';
							$metadata = wp_get_attachment_metadata();
							printf(
								/* translators: %s: Image dimensions. */
								__( 'Full size is %s pixels', 'themestandard' ),
								sprintf(
									'<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
									esc_url( wp_get_attachment_url() ),
									esc_attr( __( 'Link to full-size image', 'themestandard' ) ),
									$metadata['width'],
									$metadata['height']
								)
							);
						}

						edit_post_link( __( 'Edit', 'themestandard' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-meta -->
					<div class="content mb-5">
						<div class="entry-attachment">
							<?php
							if ( wp_attachment_is_image() ) :
								$attachments = array_values(
									get_children(
										array(
											'post_parent'    => $post->post_parent,
											'post_status'    => 'inherit',
											'post_type'      => 'attachment',
											'post_mime_type' => 'image',
											'order'          => 'ASC',
											'orderby'        => 'menu_order ID',
										)
									)
								);
								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID ) {
										break;
									}
								}

								// If there is more than 1 image attachment in a gallery...
								if ( count( $attachments ) > 1 ) {
									$k++;
									if ( isset( $attachments[ $k ] ) ) {
										// ...get the URL of the next image attachment.
										$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
									} else {
										// ...or get the URL of the first image attachment.
										$next_attachment_url = get_attachment_link( $attachments[0]->ID );
									}
								} else {
									// Or, if there's only 1 image attachment, get the URL of the image.
									$next_attachment_url = wp_get_attachment_url();
								}
								?>
								<p><a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
									<?php
									// Filterable image width with, essentially, no limit for image height.
									echo wp_get_attachment_image( $post->ID, array( 900, 900 ), false, array('class'=>'img-fluid') );
									?>
									</a>
								</p>

								<div class="navigation mb-2">
									<div class="nav-previous"><?php previous_image_link( false ); ?></div>
									<div class="nav-next"><?php next_image_link( false ); ?></div>
								</div><!-- #nav-below -->
							<?php else : ?>
								<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php echo esc_html( wp_basename( get_permalink() ) ); ?></a>
							<?php endif; ?>
						</div><!-- .entry-attachment -->
						<div class="caption">
							<?php
							if ( ! empty( $post->post_excerpt ) ) {
								the_excerpt();
							}
							?>
						</div>

						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'themestandard' ) ); ?>
					</div><!-- content -->

					<div class="link-pages mb-5">
						<?php
						wp_link_pages(
							array(
								'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'themestandard' ) . '"><span class="label">' . __( 'Pages:', 'themestandard' ) . '</span>',
								'after'       => '</nav>',
								'link_before' => '<span class="page-number">',
								'link_after'  => '</span>',
							)
						);

						edit_post_link();
						?>
					</div>

					<div class="entry-utility">
                        <?php
                        // Retrieves tag list of current post, separated by commas.
                        $tags_list = get_the_tag_list( '', ', ' );

                        if ( $tags_list && ! is_wp_error( $tags_list ) ) {
                            /* translators: 1: Category name, 2: Tag name, 3: Post permalink, 4: Post title. */
                            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'themestandard' );
                        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
                            /* translators: 1: Category name, 3: Post permalink, 4: Post title. */
                            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'themestandard' );
                        } else {
                            /* translators: 3: Post permalink, 4: Post title. */
                            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'themestandard' );
                        }

                        // Prints the string, replacing the placeholders.
                        printf(
                            $posted_in,
                            get_the_category_list( ', ' ),
                            $tags_list,
                            get_permalink(),
                            the_title_attribute( 'echo=0' )
                        );

						edit_post_link( __( 'Edit', 'themestandard' ), ' <span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-utility -->
				</article>

				<?php comments_template(); ?>

		<?php endwhile;
		endif; // End of the loop.
		?>
		</div>
        <div class="col col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php get_footer();
