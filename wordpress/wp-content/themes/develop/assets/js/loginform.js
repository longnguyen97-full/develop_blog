jQuery(function($) {

	$login_status = $("#login_status").val();

	if ($login_status != '') {
		$("#open_login_form").click();

		message = $login_status == 'empty'? 'username or password cannot empty' : 'username or password cannot is failed';

		$("#login_errors").text(message);
	}

	$register_status = $("#register_status").val();

	if ($register_status != '') {
		$("#open_register_form").click();
	}
});
