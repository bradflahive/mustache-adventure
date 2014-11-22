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

			Comment::newComment($input);

			$this->view['message'] = json_encode($points_awarded);
			
		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
	}
}
$controller = new Controller();