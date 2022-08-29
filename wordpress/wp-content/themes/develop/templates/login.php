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

$params_login_status = $_GET['login'] ?: '';
if ($params_login_status != '' && $params_login_status != 'success' && $params_login_status != 'logout') {
	$failed_message = $params_login_status == 'empty' ? $args['failed_message_1'] : $args['failed_message_2'];
}
?>

<div class="container my-3 mt-5">
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

	<?php mp_user_profile_execute(); ?>
</div>

<?php get_footer(); ?>