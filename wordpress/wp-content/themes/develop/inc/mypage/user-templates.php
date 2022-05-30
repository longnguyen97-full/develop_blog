<?php
function mp_login_form($args = array())
{
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

        <?php if (mp_is_logout_page()): ?>
            <a href="/" role="button" class="btn btn-primary btn-sm">Go Home</a>
        <?php else: ?>
            <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Back</button>
        <?php endif;?>

        <input type="hidden" name="redirect_to" value="<?php echo $args['redirect_to']; ?>">
    </form>
    <?php
}

function mp_hook_login_modal()
{
    ?>
	<!-- Modal -->
	<div class="modal fade" id="loginModalCenter" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="loginModalLongTitle">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php
                    $args = array(
                        'redirect'       => home_url( 'wp-login.php' ),
                        'redirect_to'    => home_url(),
                        'echo'           => true,
                        'remember'       => true,
                        'value_username' => NULL,
                        'value_remember' => false
                    );
                    mp_login_form($args);
                    ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
