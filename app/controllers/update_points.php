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

		// if(isset($_POST['points_awarded']) == 1) {
			$input['points'] = $_POST['points'];
			$input['user_id'] = $_POST['user_id'];
			$input['comment_id'] = $_POST['comment_id'];

			Comment::givePoints($input);

			//need to get properly working
			// TODO  need to fix so that null isn't returned
			// $this->view['points'] = json_encode($points);
			$this->view['points'] = json_encode(5);
			

		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
	}
}
$controller = new Controller();