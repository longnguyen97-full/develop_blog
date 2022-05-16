<?php
//for use in the loop, list 5 post titles related to first tag on current post
$tags = wp_get_post_tags(get_the_ID());
if ( $tags ) {
	$tags_ids = array_column($tags,'term_id');
	$args = array(
		'tag__in' => array($tags_ids),
		'post__not_in' => array(get_the_ID()),
		'posts_per_page' => 4,
	);
	$query = new WP_Query($args);
	if ( $query->have_posts() ) {
	?>
	<div class="single-related-articles widget">
		<h3 class="widget-title">Related articles</h3>
		<div class="related-articles-list">
			<?php
			while ($query->have_posts()) : $query->the_post(); ?>
			<div class="media">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('post-thumbnail',['class' => 'img-fluid mr-3']) ?></a>
				<div class="media-body">
					<div class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
                    <span class="meta section-meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
				</div>
			</div>
			<?php
			endwhile;
			?>
		</div>
	</div>
	<?php
	wp_reset_query(); wp_reset_postdata(); unset($query);
	}
}
?>
