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

$(function() {

	//verifies that a button was clicked
	$('body').on('click', 'button', function(e) {
		// e.preventDefault();
		console.log('Button pressed');
	});

    // hides the e-mail input on load.
    $('.login-form .email').attr('hidden', '');

	//adds e-mail field for signup when signup is pressed on home page.
	$('.login-form').on('click', 'button.sign-up', function(e) {
		e.preventDefault();
		console.log('Sign-up pressed');
        $('.login-form .email').toggle();
	});
	

	//when a select is changed from one value to another, gets that value, user id, and comment_id
	//and sends and inserts that info to the man_point database via /update_points. On success, needs
	//to update the value for the total amount in that comment.
	$('select').change(function( ) {
		console.log('select changed:');
		var points = $(this).val();
		console.log('points: ' + $(this).val());
		var user_id = $(this).parents('.post').find("input[name = 'user_id']").val();
		console.log('user_id: ' + user_id);
		var comment_id = $(this).parents('.post').find("input[name = 'comment_id']").val();
		console.log('comment_id: ' + comment_id);
		
		//sends data to update_points which will use points, user_id, and comment_id to increase
		//total of points and also update the total for the comment.
		$array = $.ajax({
				url: '/update_points',
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {points: points, user_id: user_id, comment_id: comment_id},
				// async: false,
				success: function(data){
					console.log('success');
					console.log(data);
					var points = data.points;

					//not getting the value of the display points div.  Need TODO
					//After that, can set the total points w/o a DB call. (Would in future?)
					/*var total = $(this).parents('.post').find('.display-points').text();
					console.log ($(this).parents('.post'));
					console.log($(this).parents('.post').find('.display-points'));
					console.log(total);
					total += points;
					console.log('total' + total);
					$(this).parents('.post').find('.display-points').text(total);*/


				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});
	});

	
	//on click of new_post button, submits post to DB and adds to the page.
	$('form').on('click', 'button', function(){
		var message = $(this).parents('.compose').find("textarea[name='new_comment']").val();
		console.log(message);
		var user_id = $(this).parents('.compose').find("input[name='user_id']").val();
		console.log(user_id);

		$array = $.ajax({
				url: '/new_comment',
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {message: message, user_id: user_id},
				// async: false,
				success: function(data){
					console.log('success');
					console.log(data);
					var message = data.message;
					var comment_id = data.comment_id;
					// var points = data.points;
					var user_name = 'user_name would go here';




					/*// building of new post...  how can we reuse CommentViewFragment here w/i JS?TODO
					var build_new_comment = new CommentViewFragment;
					$build_new_comment->comment_id = comment_id;
					$build_new_comment->message = message;
					$build_new_comment->user_name = user_name;
					$build_new_comment->total = 0;
					// how to pass user_id from above as a variable to useTODO
					// $build_new_comment->user_id = user_id;
					new_comment = $build_new_comment->render();*/

					$('aside').find('form').after('new_comment');


				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});


	})





});
