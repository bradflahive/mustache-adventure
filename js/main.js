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

// ******************************************************************************
	// Do something after validation is successful, but before the form submits.
	form.on('beforeSubmit', function() {
		$('.errormsg').html('<p>Unable to match the Username and Password.<br>Please check your entries and try again.</p>');
	});

	// // Do something after validation is successful, but before the form submits.
	// form.on('beforeSubmit', function() {
	// 	$('body').append('<p>Sending Values: ' + JSON.stringify(this.getValues()) + '</p>');
	// });
// ******************************************************************************

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

	// using payload to populate an object that can be looped over to select comment and already
	//selected vote.  Will then add 'selected' attribute to the already chosen vote value.
	console.log(app.settings.votes);
	var votes = app.settings.votes;


	for (var vote in votes){
		console.log(vote);
		console.log(votes[vote]);
		var comment_id = votes[vote].comment_id;
		console.log('comment id: ' + comment_id);
		var points = votes[vote].points;
		console.log('points: ' + points);


		// console.log(votes);

		//can't use votes.i...because it's a variable. Have to access is with [i]
		$("div[data-comment-id='" + comment_id + "']").find("select option[value='" + points + "']").prop('selected', true);
		
	}

	//gets size/length of the votes object
	/*var count = Object.keys(app.settings.votes).length;
	console.log(count);
	for (var i = 1; i < count; i++){
		var comment_id = i;
		console.log('comment id: ' + comment_id);

		// console.log(votes);

		//can't use votes.i...because it's a variable. Have to access is with [i]
		var points = votes[i];
		console.log('points: ' + points);



		$("div[data-comment-id='" + comment_id + "']").find("select option[value='" + points + "']").prop('selected', true);
		// console.log($("div[data-comment-id='" + comment_id + "']").html());
		// console.log($("select option[value='" + points + "']").val());
	}*/



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
		$(this).hide();
        $('.login-form .email').toggle(); 
	});
	

	//when a select is changed from one value to another, gets that value, user id, and comment_id
	//and sends and inserts that info to the man_point database via /update_points. On success, needs
	//to update the value for the total amount in that comment.
	$('.post select').change(function( ) {
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
					var comment_id = data.comment_id;
					//issue with refresh is that it's not going back to where it was...anchors to top
					//TODO
					location.href = "/profile";
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
	$('form.compose').on('click', 'button', function(){
		var message = $(this).parents('.compose').find("textarea[name='new_comment']").val();
		console.log(message);
		var user_id = $(this).parents('.compose').find("input[name='user_id']").val();
		console.log(user_id);


		// switched type from json to html.  Switching new_comment.php to an AppController
		//instead of Ajax.
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
					// var points = data.points;
					var user_name = 'user_name would go here';

					// $('aside').find('form.compose').after(new_comment);
					// $('aside').find('form.compose').after(message);
					$('aside').find('form.compose').after(data.new_comment);
					$('form.compose').find('textarea').val('');
					// $('aside').find('form').after(new_comment);
					// $('aside').find('form').after(data.test_comment);

				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});


	})

	
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
					// var comment_id = data.comment_id;
					location.href = "/profile";
					//refresh page because comment has been deleted.
				},
				error: function(){
					console.log('error');
					console.log('data: ' + data);
				}
		});


	})



});
