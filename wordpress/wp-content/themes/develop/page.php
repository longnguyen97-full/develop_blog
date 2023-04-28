<?php get_header(); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/regular.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row">

            <!-- Post Content -->

            <div class="col-lg-10 offset-lg-1">
                <div class="post_content">

                    <!-- Post Body -->

                    <div class="post_body">
                        <main class="app_container container">
                            <div class="row">
                                <div class="col col-md-12">
                                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                            <article>
                                                <h1 class="entry-title"><?php the_title() ?></h1>
                                                <div class="content post-content mb-3">
                                                    <?php the_content(); ?>
                                                </div>
                                            </article>
                                    <?php endwhile;
                                    endif; ?>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>