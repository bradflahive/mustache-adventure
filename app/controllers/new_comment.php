<?php


 class Controller extends AppController {

	
	protected function init() {

			$user_id = $input['user_id'] = $_POST['user_id'];
			$message = $input['message'] = $_POST['message'];

			//TODO assuming that when an array is sent to create a new Comment,
			//it inserts a new comment and returns the comment_id
			$comment_id = new Comment($input);
			// $comment_id = $comment->newComment($input);
			// $comment_id = $comment->comment_id;

			//may not need this passed back
			$this->view->message = $input['message'];
			$this->view->comment_id = $comment_id;
			$this->view->user_id = $user_id;

			$build_new_comment = new CommentViewFragment;
			$build_new_comment->comment_id = $comment_id;
			$build_new_comment->user_name = $user_name;
			$build_new_comment->message = $message;
			$build_new_comment->total = 0;
			$build_new_comment->user_id = $user_id;
			$this->view->new_comment = $build_new_comment->render();


			
		
	}
}
$controller = new Controller();

extract($controller->view->vars);

