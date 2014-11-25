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

      $user = new User(UserLogin::getUserID());
      $_POST['user_id'] = $user->user_id;

      $comment = new Comment($_POST);
      $total = $comment->givePoints([
        'points'  => 0,
        'user_id' => $user->user_id
      ]);

      $isSameUser = ($user->user_id === $comment->user_id);

			$build_new_comment = new CommentViewFragment();
			$build_new_comment->comment_id = htmlentities($comment->comment_id);
			$build_new_comment->message = htmlentities($comment->message);
			$build_new_comment->user_name = htmlentities($user->user_name);
			$build_new_comment->total = 0;
			$build_new_comment->user_id = htmlentities($user->user_id);
      $build_new_comment->remove_hidden = $isSameUser ? '' : 'hidden';
      $build_new_comment->points_hidden = $isSameUser ? 'hidden' : '';

			$this->view['new_comment'] = $build_new_comment->render();
			
	}
}
$controller = new Controller();
