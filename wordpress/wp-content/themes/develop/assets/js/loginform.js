jQuery(function($) {

	if (params.login_status != '') {
		$("#open_login_form").click();

		message = params.login_status == 'empty' ? 'Username / Password can\'t empty' : 'Username / Password is failed';

		$("#login_errors").text(message);
	}

	if (params.register_status != '') {
		$("#open_register_form").click();
	}
});
