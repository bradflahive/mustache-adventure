<?php

class Controller extends AppController {
	protected function init() {
		
	}
}
$controller = new Controller();

extract($controller->view->vars);

?>

<div class="login-content">
    <main class="login-main">

        <!-- <div class="logo">
            <img src="#">
        </div> -->

        <h3>LOGIN</h3>
        <div class="login_form">
            <form action="/login">
                <input type="text" name="user_name" data-exp-name="text" title="-Username-">
                <input type="password" name="password" data-exp-name="password" title="-Password-">
                <label class="signup">-Email-</label><input type="email" class="signup" name="email" data-exp-name="email">
                <br>
                <a href="/">sign up</a>
                <button>submit</button>
            </form>
        </div>

    </main>
</div>


    