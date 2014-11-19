<?php

// Controller
class Controller extends AppController {
	protected function init() {
		
		// Send a variable to the main view
		$this->view->welcome = 'Welcome to MVC';

		// Send a variable to a sub view
		$this->view->primary_header->welcome = 'Welcome Student!';

	}
}
$controller = new Controller();

// Extract Main Controller Vars
extract($controller->view->vars);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

<!-- for testing - remove after -->
    <link rel="stylesheet" href="mockups/mark_styles.css">
    <script src="mockup/mark_main.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script>

</head>
<body>

    <div class="page">
        <div class="logo">
            <img src="#">
        </div>
        <h3>LOGIN</h3>
        <div class="login_form">
            <form action="/profile" method="">
                <label>username: </label><input type="text" name="user_id" data-exp-name="text">
                    <br>
                <label>password: </label><input type="password" name="password" data-exp-name="password">
                    <br>
                <label class="signup">email: </label><input type="email" name="email" class="signup" data-exp-name="email">
                <br>
                <a href="">sign up</a>
                <button>submit</button>
            </form>
        </div>
    </div>
    
</body>
</html>