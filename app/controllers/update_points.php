<?php

/**
 * Ajax Controller
 */
 class Controller extends AjaxController {


	/**
	 * The view for this controller will be an array and will be
	 * converted to JSON upon render
	 */
	// can't pass an array called input because base controller init takes no params
	protected function init() {

			$total = (new Comment())->givePoints($_POST);

			//need to get properly working
			// TODO  need to fix so that null isn't returned
			// $this->view['points'] = json_encode($points);
			$this->view['points'] = $total;
			

		// In the case of the Ajax Controller, the view is an array
		// which can can be accessed as follows. This array will be
		// converted to JSON when this script ends and sent to the client
		// automatically
	}


}
$controller = new Controller();
