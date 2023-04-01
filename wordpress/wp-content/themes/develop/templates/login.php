<?php

/**
 * Template Name: Login
 */

get_header();

$args = array(
    'redirect'       => home_url('wp-login.php'),
    'redirect_to'    => home_url(),
    'redirect_back'  => false,
    'echo'           => true,
    'value_username' => null,
    'value_remember' => false,
    'failed_message_1' => 'Username / Password can\'t empty',
    'failed_message_2' => 'Username / Password is failed',
);
?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container my-5 py-5">
        <div class="row row-lg-eq-height my-3 py-3">

            <h3>Login</h3>
            <form name="loginform" id="loginform" action="<?php echo $args['redirect']; ?>" method="POST">
                <div class="form-group">
                    <label for="user_login">Username</label>
                    <input type="text" name="log" id="user_login" class="form-control" placeholder="Enter username" value="" size="20">
                </div>

                <div class="form-group">
                    <label for="user_pass">Password</label>
                    <input type="password" name="pwd" id="user_pass" class="form-control" placeholder="Enter Password" value="" size="20">
                </div>

                <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary btn-sm" value="Login">

                <input type="hidden" name="redirect_to" value="<?php echo $args['redirect_to']; ?>">
            </form>
            <p id="login_errors_page" class="text-danger"><?php echo $failed_message; ?></p>

        </div>
    </div>
</div>

<?php get_footer(); ?>