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

      $user = new User($_SESSION['logged_user']);
      $_POST['user_id'] = $user->user_id;

      $comment = new Comment($_POST);
      $total = $comment->givePoints([
        'points'  => 0,
        'user_id' => $user->user_id
      ]);

			$build_new_comment = new CommentViewFragment();
			$build_new_comment->comment_id = $comment->comment_id;
			$build_new_comment->message = $comment->message;
			$build_new_comment->user_name = $user->user_name;
			$build_new_comment->total = 0;
			$build_new_comment->user_id = $user->user_id;

			$this->view['new_comment'] = $build_new_comment->render();
			
	}
}
$controller = new Controller();
