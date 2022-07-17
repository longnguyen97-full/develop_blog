jQuery(function($) {

	/* Switch popup when click login / register button */
	$("#open_login_form").click(function() {
		switchPopup($("#registerModalCenter"), $("#open_register_form"));
	});

	$("#open_register_form").click(function() {
		switchPopup($("#loginModalCenter"), $("#open_login_form"));
	});

	function switchPopup(modal, button) {
		if (modal.hasClass("show")) {
			button.click();
		}
	}
});
