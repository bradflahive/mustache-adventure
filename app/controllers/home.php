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
    <link rel="stylesheet" href="/mockups/mark_styles.css">
    <script src="mockups/mark_main.js"></script>

</head>
<body>

    <div class="page">
        <div class="logo">
            <img src="#">
        </div>
        <h3>LOGIN</h3>
        <div class="login_form">
            <form action="/profile" method="">
                <input type="text" name="user_id" data-exp-name="text" title="username">
                <input type="password" name="password" data-exp-name="password" title="password">
                <label class="signup">email</label><input type="email" class="signup" name="email" data-exp-name="email">
                <br>
                <a href="">sign up</a>
                <button>submit</button>
            </form>
        </div>
    </div>
    
</body>
</html>