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
			$this->view['test_comment'] = 'test comment';
			$user_name = "joey standin";
			// $user_name = $_SESSION['user_name'];
			$user_id = $input['user_id'] = $_POST['user_id'];
			$message = $input['message'] = $_POST['message'];
			$comment = new Comment($input);

			//may not need this passed back
			$this->view['message'] = $input['message'];
			$this->view['comment_id'] = $comment_id;
			$this->view['user_id'] = $user_id;

			$build_new_comment = new CommentViewFragment();
			$build_new_comment->comment_id = $comment_id;
			$build_new_comment->message = $message;
			$build_new_comment->user_name = $user_name;
			$build_new_comment->total = 0;
			$build_new_comment->user_id = $user_id;

			$this->view['new_comment'] = $build_new_comment->render();
			
		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
	}
}
$controller = new Controller();