jQuery(function($) {

	if (params.login_status != '' && params.login_status != 'success' && params.login_status != 'logout') {
		message = params.login_status == 'empty' ? 'Username / Password can\'t empty' : 'Username / Password is failed';

		$("#login_errors").text(message);
	}

	if (params.register_status != '') {
		$("#open_register_form").click();
	}
});
