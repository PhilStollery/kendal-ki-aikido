jQuery(document).ready(function($) {

	var submit_can_proceed = false;
	
	// See if WooCommerce or Affiliate WP login form is present
	if($('.woocommerce form.login').length > 0) {
		var tfa_wc_form = $('.woocommerce form.login').first();
		var tfa_wc_user_field = $('.woocommerce [name=username]').first();
		var tfa_wc_pass_field = $('.woocommerce [name=password]').first();
		var tfa_wc_submit_btn = $('.woocommerce [name=login]').first();
	} else if ($('#affwp-login-form').length > 0) {
		var tfa_wc_form = $('#affwp-login-form').first();
		var tfa_wc_user_field = $('#affwp-login-user-login, #affwp-user-login').first();
		var tfa_wc_pass_field = $('#affwp-login-user-pass, #affwp-user-pass').first();
		var tfa_wc_submit_btn = $('#affwp-login-form input[type=submit]').first();
	}
	
	if ('undefined' != typeof tfa_wc_form) {
	
		// Create a paragraph object, hidden, bottom-margin 15px
		var tfa_wc_p = document.createElement('p');
		tfa_wc_p.id = 'tfa_wc_holder';
		tfa_wc_p.style.display = 'none';
		tfa_wc_p.style.marginBottom = '15px';
		
		// Insert that paragraph before the submit button
		$(tfa_wc_p).insertBefore(tfa_wc_submit_btn);

		// Get that paragraph
		var p = document.getElementById('tfa_wc_holder');
		
		// Create a label object
		var lbl = document.createElement('label');
		lbl.for = 'two_factor_auth';
		var lbl_text = document.createTextNode(simbatfa_wc_settings.otp+' '+simbatfa_wc_settings.otp_login_help);
		lbl.appendChild(lbl_text);
		
		// Create a TFA field object
		var tfa_field = document.createElement('input');
		tfa_field.type = 'text';
		tfa_field.id = 'two_factor_auth';
		tfa_field.name = 'two_factor_code';
		tfa_field.className = 'input-text';
		tfa_field.autocomplete = 'off';
// 		tfa_field.style = 'margin-left: 10px; padding-left: 10px;';
// 		lbl.appendChild(tfa_field);
		
		//Remove button
// 		p.removeChild(document.getElementById('tfa_wc_otp-button'));
		
		// Add the label to the paragraph
		p.appendChild(lbl);
		// Add the TFA field to the paragraph
		p.appendChild(tfa_field);
// 		tfa_field.focus();
		
	}
	
	$(tfa_wc_form).on('submit', function(e) {

		if (submit_can_proceed) { return true; }
		
		e.preventDefault();
		
		// Give an error and return if no username has been entered.
		if (tfa_wc_user_field.val().length < 1) {
			alert(simbatfa_wc_settings.enter_username_first);
			e.preventDefault();
			return false;
		}
		
		if (simbatfa_wc_settings.hasOwnProperty('spinnerimg')) {
			$('label[for="rememberme"], #affwp-login-form input[type=submit]').after('<img class="simbaotp_spinner" src="'+simbatfa_wc_settings.spinnerimg+'" style="margin-left: 4px;height: 20px; width: 20px; position: relative; top: 4px; border:0px; box-shadow:none;">');
			$('#rememberme').parent('label').append('<img class="simbaotp_spinner" src="'+simbatfa_wc_settings.spinnerimg+'" style="margin-left: 4px;height: 20px; width: 20px; position: relative; top: 4px; border:0px; box-shadow:none;">');
		}
		
		$.ajax({
			url: simbatfa_wc_settings.ajaxurl,
			type: 'POST',
			data: {
				action: 'simbatfa-init-otp',
				user: tfa_wc_user_field.val()
			},
			dataType: 'json',
			success: function(response) {
				submit_can_proceed = true;
				if (response.status == true) {
					$('.simbaotp_spinner').remove();
					tfaShowOTPField();
				} else {
					$(tfa_wc_form).find('input[type="submit"], button[type="submit"]').first().click();
				}
			}
		});
		
// 		$(tfa_wc_form).off();
		
	});
	
	/**
	 * Hides the username/password inputs, and shows the TFA input
	 */
	function tfaShowOTPField() {
		$(tfa_wc_user_field).parent().hide();
		$(tfa_wc_pass_field).parent().hide();
		$('#tfa_wc_holder').slideDown().find('input[name="two_factor_code"]').focus();
	}
	
});
