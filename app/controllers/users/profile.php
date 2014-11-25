<?php

class Controller extends AppController {



	protected function init() {

		// $session = $_SESSION;
		// //dummy user id currently TODO
		// // $user_id = $_SESSION['user_id'];
		// // $user_name = $_SESSION['user_name'];
		// $user_id = 1;

		$user_id = UserLogin::getUserID();


		//gets comments from the database
		$results = Comment::getAll();

		//processes comments and puts them into the view.
		$comments = new CommentViewFragment();
		$votes = [];
		$i = 0;

		$sql = "SELECT * FROM man_point where user_id = '{$user_id}'";
		$results = db::execute($sql);
		while ($row = $results->fetch_assoc()){
			$votes[] = ['comment_id'=>$row['comment_id'], 'points'=>$row['points']];

			/*$votes[$comment['comment_id']] = $row['comment_id'];
			$votes[$comment['points']] = $row['points'];*/
		}



		//gets comments from the database
		$results = Comment::getAll();
		while ($comment = $results->fetch_assoc()) {

	    	$isSameUser = ($user_id === $comment['user_id']);
			$comments->comment_id = $comment['comment_id'];
			$comments->user_name = $comment['user_name'];
			$comments->message = $comment['message'];
			$comments->total = $comment['total'];
			$comments->user_id = $user_id;
      		$comments->remove_hidden = $isSameUser ? '' : 'hidden';
      		$comments->points_hidden = $isSameUser ? 'hidden' : '';
			$this->view->comments .= $comments->render();

		}
		$this->view->user_id = $user_id;


		//pass the results to payload so that jQuery can use them to select the dropdowns.
		Payload::add('votes', $votes);

		$user = new User($user_id);
		$this->view->totalpoints = $user->getUserPoints();
		$this->view->user_name = $user->getUserName();
		$this->view->user_rank = $user->getUserRank();

	}
}
$controller = new Controller();

extract($controller->view->vars);
?>

<a class="logout" href="/logout">Logout</a>
<div class="primary-content">
	<main>
	<?php print_r($session) ?>
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

		<!-- <div class="post"> -->
		<!-- 	<!&#45;&#45; <input type="text" name="new_post" placeholder="Compose new comment..."> &#45;&#45;> -->
		<!-- 	<textarea name="new_post" id="reptile" placeholder="Compose new post..."></textarea> -->
		<!-- 	<button>Post</button>			 -->
		<!-- </div> -->
		<form class="compose" method='POST'>
			<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
			<textarea name="new_comment" id="reptile" placeholder="Compose new post..."></textarea>
			<button class="new_comment">Post</button>
		</form>

		<?php echo $comments ?>

		<!-- <div class="post">
			<img src="/images/profile-brad.jpg">
			<div class="body">
				<div class="user_name">Brad Flahive</div>
				<div class="message">Mustache finally reached 4 inches!</div>
				<div class="display-points">7</div>
			</div>
		</div>

		<div class="post">
			<img src="/images/nathan.jpg">
			<div class="body">
				<div class="user_name">Nathan Atkinson</div>
				<div class="message">Just rode a horse bareback...</div>
				<form action=""></form>
					<select name="" id="">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<button>Add</button>
				</form>
				<div class="display-points">6</div>
			</div>
		</div>

		<div class="post">
			<img src="/images/jon.jpg">
			<div class="body">
				<div class="user_name">Jon Nyman</div>
				<div class="message">Just bought a cowboy hat</div>
				<form action=""></form>
					<select name="" id="">
						<option value="0">0</option>
						<option value="1" selected>1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<button>Add</button>
				</form>
				<div class="display-points">9</div>
			</div>
		</div>

		<div class="post">
			<img src="/images/mark.jpg">
			<div class="body">
				<div class="user_name">Mark Ragno</div>
				<div class="message">High-Five'd Burt Reynolds today</div>
				<form action=""></form>
					<select name="" id="">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5" selected>5</option>
					</select>
					<button>Add</button>
				</form>
				<div class="display-points">42</div>
			</div>
		</div>

		<div class="post">
			<img src="/images/profile-brad.jpg">
			<div class="body">
				<div class="user_name">Brad Flahive</div>
				<div class="message">Ate 2 NY strips last night</div>
				<div class="display-points">11</div>
			</div>
		</div> -->

	</aside>
</div>
<p class="copyright">&copy Mustache-Adventures Co.</p>
