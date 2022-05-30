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
        mp_login_form( $args );
        ?>
        <p class="mt-3">Don't have an account yet? <a href="/registration">register</a> here.</p>

    <?php endwhile;?>
</div>

<?php get_footer();?>
