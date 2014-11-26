/**
 * Application JS
 */
(function() {

	var form = new ReptileForm('form');

	// Do something before validation starts
	// form.on('beforeValidation', function() {
	// // 	$('body').append('<p>Before Validation</p>');
	// });

	// Do something when errors are detected.
	// form.on('validationError', function(e, err) {
	// 	$('body').append('<p>Errors: ' + JSON.stringify(err) + '</p>');
	// });

	// Do something when errors are detected.
	form.on('validationError', function(e, err) {
		// console.log(JSON.stringify(err));
		$('body').find('.errormsg').html('<p>Unable to match the Username and Password.<br>Please check your entries and try again.</p>');
	});

	// // Do something after validation is successful, but before the form submits.
	// form.on('beforeSubmit', function() {
	// // 	$('body').append('<p>Sending Values: ' + JSON.stringify(this.getValues()) + '</p>');
	// });

	// Do something when the AJAX request has returned in success
	form.on('xhrSuccess', function(e, data) {
		if(data.redirect){
			location.href=data.redirect;
		} else if (data.errormsg) {
			var message = data.errormsg;
			$("form.login-form").append('<br><BR>' + message);
		}
	});

	// Do something when the AJAX request has returned with an error
	form.on('xhrError', function(e, xhr, settings, thrownError) {
		// $('body').append('<p>Submittion Error</p>');
	});

})();

$(function() {

	/*
	* using payload to populate an object that can be looped over to 
  * select comment and already
	* selected vote.  Will then add 'selected' attribute to the 
  * already chosen vote value.
	*/
	console.log(app.settings.votes);
	var votes = app.settings.votes;

	for (var vote in votes){
		// console.log(vote);
		// console.log(votes[vote]);
		var comment_id = votes[vote].comment_id;
		// console.log('comment id: ' + comment_id);
		var points = votes[vote].points;
		// console.log('points: ' + points);

		// can't use votes.i...because it's a variable. 
    // Have to access is with [i]
		$("div[data-comment-id='" + comment_id + "']")
      .find('.points')
      .addClass('_'+points);
  }

    // hides the e-mail input on load.
    $('.login-form .email').attr('hidden', '');

	//adds e-mail field for signup when signup is pressed on home page.
	$('.login-form').on('click', 'button.sign-up', function(e) {
		e.preventDefault();
		console.log('Sign-up pressed');
		$(this).hide();
        $('.login-form .email').toggle(); 
	});
	

	/*
	* when a select is changed from one value to another, gets that value, user id, and comment_id
	* and sends and inserts that info to the man_point database via /update_points. On success, needs
	* to update the value for the total amount in that comment.
	*/
	$('.post').on('click', '.points div', function( ) {
		var points = $(this).attr('value');
		var user_id = $(this)
      .parents('.post')
      .find("input[name='user_id']")
      .val();
		var comment_id = 
      $(this)
      .parents('.post')
      .find("input[name = 'comment_id']")
      .val();

		
		/*
		* sends data to update_points which will use points, user_id, and comment_id to increase
		* total of points and also update the total for the comment.
		*/
		$array = $.ajax({
				url: '/update_points',
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {points: points, user_id: user_id, comment_id: comment_id},
				// async: false,
				success: function(data){
					var points = data.points;
					var comment_id = data.comment_id;
					location.href = "/profile";
				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});
	});

	
	//on click of new_post button, submits post to DB and adds to the page.
	$('form.compose').on('click', 'button', function(){
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
					var new_comment = data.new_comment;
					var message = data.message;
					var comment_id = data.comment_id;
					var user_name = 'user_name would go here';
					$('aside').find('form.compose').after(data.new_comment);
					$('form.compose').find('textarea').val('');
				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});
	});

	
	//on click of remove button, removes the comment from DB.
	$('aside').on('click', 'button.remove', function(){
		var comment_id = $(this).parents('.post').find("input[name='comment_id']").val();
		console.log("comment id: " + comment_id);
		var user_id = $(this).parents('.post').find("input[name='user_id']").val();
		console.log("user id: " + user_id);

		$array = $.ajax({
				url: '/delete_comment',
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {comment_id: comment_id, user_id:user_id},
				// async: false,
				success: function(data){
					console.log('success');
					console.log(data);
					location.href = "/profile";
				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});
	});

});
