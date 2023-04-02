<header class="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                    <div class="logo"><a href="/"><?php echo get_bloginfo('name') ?></a></div>
                    <?php get_template_part( 'template-parts/global', 'navigation' ); ?>
                    <?php Authentication::form(); ?>
                    <div class="search_container ml-auto">
                        <!-- <div class="weather">
                            <div class="temperature">+10°</div>
                            <img class="weather_icon" src="<?php assets(); ?>/images/cloud.png" alt="">
                        </div> -->
                        <form role="search" method="get" class="search-form" action="<?php echo site_url('/'); ?>">
                            <input type="search" class="header_search_input" required="required" placeholder="Type to Search..." value="<?php get_search_query();?>" name="s">
                            <img class="header_search_icon" src="<?php assets(); ?>/images/search.png" alt="">
                        </form>
                    </div>
                    <div class="hamburger ml-auto menu_mm">
                        <i class="fa fa-bars trans_200 menu_mm" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
