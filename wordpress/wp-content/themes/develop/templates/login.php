<?php
/**
 * Template Name: User Login
 */
mp_prevent_user_logged_in();
get_header();?>

<div class="container my-3">
    <?php while (have_posts()): the_post();?>

        <?php
        $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
        if ( $login === "failed" ) {
            echo '<p class="login-msg"><strong></strong> Invalid username and/or password.</p>';
        } elseif ( $login === "empty" ) {
            echo '<p class="login-msg"><strong></strong> Username and/or Password is empty.</p>';
        } elseif ( $login === "false" ) {
            echo '<p class="login-msg"><strong></strong> You are logged out.</p>';
        }
        $args = array(
            'redirect'       => home_url( 'wp-login.php' ),
            'redirect_to'    => home_url(),
            'echo'           => true,
            'remember'       => true,
            'value_username' => NULL,
            'value_remember' => false
           );
        wp_login_form_custom( $args );
        ?>
        <p class="mt-3">Don't have an account yet? <a href="/registration">register</a> here.</p>

    <?php endwhile;?>
</div>

<?php get_footer();?>

<?php
function wp_login_form_custom($args = array()) {
    ?>
    <form name="loginform" id="loginform" action="<?php echo $args['redirect']; ?>" method="POST">
        <div class="form-group">
            <label for="user_login">Username</label>
            <input type="text" name="log" id="user_login" class="form-control" placeholder="Enter username" value="" size="20">
        </div>

        <div class="form-group">
            <label for="user_pass">Password</label>
            <input type="password" name="pwd" id="user_pass" class="form-control" placeholder="Enter Password" value="" size="20">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="rememberme" id="rememberme" value="forever" size="20">
            <label class="form-check-label" for="rememberme">Remember me</label>
        </div>

        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary btn-sm" value="Login">

        <?php if ( mp_is_logout_page() ) : ?>
            <a href="/" role="button" class="btn btn-primary btn-sm">Go Home</a>
        <?php else: ?>
            <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Back</button>
        <?php endif; ?>

        <input type="hidden" name="redirect_to" value="<?php echo $args['redirect_to']; ?>">
    </form>
    <?php
}
