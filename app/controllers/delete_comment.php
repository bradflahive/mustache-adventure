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

      //after checking if user if valid, then create comment object and delete comment
      //TODO believe this is what's causing error...  needs to be an array?
      $comment_id= $_POST['comment_id'];

      $comment = new Comment($comment_id);

      $comment->deleteComment($comment_id);
      
      echo "deleted";
      
			
	}
}
$controller = new Controller();
