<?php

/**
 * Ajax Controller
 */
 class Controller extends AjaxController {

	protected function init() {

      $user = new User(UserLogin::getUserID());
      $_POST['user_id'] = $user->user_id;

      $comment_id= $_POST['comment_id'];

      $comment = new Comment($comment_id);

      $comment->deleteComment();
      
	}
}
$controller = new Controller();
