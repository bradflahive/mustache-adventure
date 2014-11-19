<?php

// Controller
class Controller extends AppController {
	protected function init() {

		//need to build the profile page

	}

}
$controller = new Controller();

// Extract Main Controler Vars
extract($controller->view->vars);

?>

<!DOCTYPE html>
<html lang="en">
<head>  
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/css/brad-style.css">
</head>
<body>
	<div class="page">
		<header>
			<div class="logo">logo</div>
			<h1>MANPOINT</h1>
			<a class="logout" href="">Logout</a>
		</header>
		<div class="primary-content">
			<main>
				<div class="user">
					<div class="image">
						Profile Pic
						<img src="" >
					</div>
					<h3>USERNAME</h3>
					<a href="">edit profile</a><br>
					<p>MY MAN-POINTS: </p><span class="points">*Points*</span>
				</div>
			</main>
			<aside>

				<form class="compose">
					<textarea placeholder="Compose new post..."></textarea>
					<button>Post</button>
				</form>
						
				<div class="post">
					<img src="">
					<div class="body">
						<div class="user_name">Brad Flahive</div>
						<div class="message">Message</div>
						<select name="" id="">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<div class="display-points">1</div>
					</div>
				</div>
				<div class="post">
					<img src="">
					<div class="body">
						<div class="user_name">Brad Flahive</div>
						<div class="message">Message</div>
						<select name="" id="">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<div class="display-points">1</div>
					</div>
				</div>
				<div class="post">
					<img src="">
					<div class="body">
						<div class="user_name">Brad Flahive</div>
						<div class="message">Message</div>
						<select name="" id="">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<div class="display-points">1</div>
					</div>
				</div>

			</aside>
		</div>
	</div>
</body>
</html>

