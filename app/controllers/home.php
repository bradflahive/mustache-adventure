<?php

class Controller extends AppController {
	protected function init() {
		
	}
}
$controller = new Controller();

extract($controller->view->vars);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <script></script>
</head>
<body>

    <div class="logo">
        <img src="#">
    </div>
    <h3>LOGIN</h3>
    <div class="login_form">
        <form action="/login">
            <input type="text" name="user_name" data-exp-name="text" title="username">
            <input type="password" name="password" data-exp-name="password" title="password">
            <label class="signup">email</label><input type="email" class="signup" name="email" data-exp-name="email">
            <br>
            <a href="/">sign up</a>
            <button>submit</button>
        </form>
    </div>
    
</body>
</html>