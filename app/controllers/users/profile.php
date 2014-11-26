<?php

class Controller extends AppController {



	protected function init() {

		$user_id = UserLogin::getUserID();

		if (!$user_id){
			header('Location: /');
            exit();
		}

    	$user = new User($user_id);

		//gets comments from the database
		$results = Comment::getAll();

		//processes comments and puts them into the view.
		$comments = new CommentViewFragment();
		$votes = [];
		$i = 0;

		//gets votes that user has made in the past
		$votes_in_DB = $user->getVotes();
		while ($row = $votes_in_DB->fetch_assoc()){
			$votes[] = ['comment_id'=>$row['comment_id'], 'points'=>$row['points']];
		}
    //pass the results to payload so that jQuery can use them 
    //to select the dropdowns.
		Payload::add('votes', $votes);

		//gets comments from the database
		$results = Comment::getAll();
		while ($comment = $results->fetch_assoc()) {
	      $isSameUser = ($user_id === $comment['user_id']);
	      $comments->comment_id = xss::protection($comment['comment_id']);
	      $comments->user_name = xss::protection($comment['user_name']);
	      $comments->message = xss::protection($comment['message']);
	      $comments->total = xss::protection($comment['total']);
	      $comments->user_id = $user_id;
	      $comments->remove_hidden = $isSameUser ? '' : 'hidden';
	      $comments->points_hidden = $isSameUser ? 'hidden' : '';
	      $this->view->comments .= $comments->render();
		}
		$this->view->user_id = $user_id;


		$this->view->totalpoints = $user->getUserPoints();
		$this->view->user_name = $user->getUserName();
		$this->view->user_rank = $user->getUserRank();

	}
}
$controller = new Controller();

extract($controller->view->vars);
?>

<i class="fa fa-instagram"></i>
<i class="fa fa-twitter-square"></i>
<i class="fa fa-facebook-square"></i>
<i class="fa fa-reddit-square"></i>
<a class="logout" href="/logout">Logout</a>
<div class="primary-content">
	<main>
		<div class="user">
			<div class="profile-info">
				<img src="/images/profile-brad.jpg" >
				<h3><?php echo $user_name ?></h3>
				<p>Mustache Level: <?php echo $user_rank ?></p>
			</div>
			<div class="man-points">
				<p>MY MAN-POINTS: <span class="points">*<?php echo $totalpoints ?> Points*</span></p>
			</div>
		</div>

	</main>
	<aside>

		<form class="compose" method='POST'>
			<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
			<textarea name="new_comment" id="reptile" placeholder="Compose new post..."></textarea>
			<button class="new_comment">Post</button>
		</form>

		<?php echo $comments ?>

	</aside>
</div>
