<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo get_bloginfo(); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Demo project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php is_category() ? '' : body_class(); ?>>

    <div class="super_container">

        <!-- Header -->
        <?php get_template_part( 'template-parts/global', 'header' ); ?>
