<?php

/**
 * Ajax Controller
 */
 class Controller extends AjaxController {

	/**
	 * The view for this controller will be an array and will be
	 * converted to JSON upon render
	 */
	protected function init() {

			$input['user_id'] = $_POST['user_id'];
			$input['message'] = $_POST['message'];

			$comment_id = Comment::newComment($input);

			$this->view['message'] = $input['message'];
			$this->view['comment_id'] = $comment_id;


			
		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
	}
}
$controller = new Controller();