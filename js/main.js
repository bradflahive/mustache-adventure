/**
 * Application JS
 */
(function() {

	var form = new ReptileForm('form');

	// Do something before validation starts
	form.on('beforeValidation', function() {
		$('body').append('<p>Before Validation</p>');
	});

	// Do something when errors are detected.
	form.on('validationError', function(e, err) {
		$('body').append('<p>Errors: ' + JSON.stringify(err) + '</p>');
	});

	// Do something after validation is successful, but before the form submits.
	form.on('beforeSubmit', function() {
		$('body').append('<p>Sending Values: ' + JSON.stringify(this.getValues()) + '</p>');
	});

	// Do something when the AJAX request has returned in success
	form.on('xhrSuccess', function(e, data) {
		if(data.redirect){
			location.href=data.redirect;
		}
	});

	// Do something when the AJAX request has returned with an error
	form.on('xhrError', function(e, xhr, settings, thrownError) {
		$('body').append('<p>Submittion Error</p>');
	});

})();

$(function {

	//verifies that a button was clicked
	$('body').on('click', 'button', function(e) {
		// e.preventDefault();
		console.log('Button pressed');

	});


	//adds e-mail field for signup when signup is pressed on home page.
	$('body').on('click', 'sign-up', function(e) {
		e.preventDefault();
		console.log('Sign-up pressed');
		$(this).parents('form').append('<div class="field email text">
											<div class="field-input">
												<input type="email" class="signup" name="email">
											</div>
										</div> ');
	});
	






});