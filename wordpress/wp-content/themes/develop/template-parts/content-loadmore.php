<?php
$key         = $args['key'];
$post_link   = get_permalink(get_the_ID());
$post_title  = get_the_title();
$post_date   = date('M d, Y \a\t g:i A', strtotime(get_the_date()));
$post_author = get_the_author_posts_link();

if (in_array($key, [0, 2, 3, 6])) :
?>

    <!-- Small Card With Image -->
    <div class="card card_small_with_image grid-item">
        <img class="card-img-top" src="<?php assets(); ?>/images/post_10.jpg" alt="">
        <div class="card-body">
            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
            <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
        </div>
    </div>

<?php
elseif (in_array($key, [1, 7, 8])) :
?>
    <!-- Small Card Without Image -->
    <div class="card card_default card_small_no_image grid-item">
        <div class="card-body">
            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
            <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
        </div>
    </div>
<?php
elseif (in_array($key, [4, 5])) :
?>
    <!-- Small Card With Background -->
    <div class="card card_default card_small_with_background grid-item">
        <div class="card_background" style="background-image:url(<?php assets(); ?>/images/post_11.jpg)"></div>
        <div class="card-body">
            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
            <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
        </div>
    </div>

<?php
elseif (in_array($key, [9, 10])) :
?>
    <!-- Default Card With Background -->
    <div class="card card_default card_default_with_background grid-item">
        <div class="card_background" style="background-image:url(<?php assets(); ?>/images/post_12.jpg)"></div>
        <div class="card-body">
            <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
        </div>
    </div>
<?php endif;
