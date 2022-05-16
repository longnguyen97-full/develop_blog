<?php
$class = !empty($args['class'])?$args['class']:'';
$per_page = !empty($args['per_page'])?$args['per_page']:4;
$is_slider = !empty($args['is_slider'])?'slick_slider':'';
$args = array(
    'paged' => 1,
    'posts_per_page' => $per_page,
    'ignore_sticky_posts' => true,
);
$query = new WP_Query($args);
if( $query->have_posts() ) {
?>
<div class="section-post <?php echo $class ?>">
    <h3 class="widget-title">Related articles</h3>
    <div class="<?php echo $is_slider ?>">
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
wp_reset_query();wp_reset_postdata();
unset($query);
}
?>
