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
			$points_awarded = $_POST['points_awarded'];
			$points_awarded = $_POST['user_id'];
			$points_awarded = $_POST['comment_id'];
			

			$this->view['points_awarded'] = json_encode($points_awarded);
			
		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
	}
}
$controller = new Controller();