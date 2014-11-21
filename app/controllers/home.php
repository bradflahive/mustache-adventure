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

        <h3>LOGIN</h3>
        <div class="login_form">
            <form action="/login">
                <input type="text" name="user_name" data-exp-name="text" title="-Username-">
                <input type="password" name="password" data-exp-name="password" title="-Password-">
                <br>
                <button class="sign-up">sign up</button>
                <button>submit</button>
            </form>
            <form action="/login" class="e-expand">
                <input type="text" name="user_name" data-exp-name="text" title="-Username-">
                <input type="password" name="password" data-exp-name="password" title="-Password-">
                <input type="email" name="email" data-exp-name="email" title="-E-mail-">
                <br>
                <button class="sign-up">sign up</button>
                <button>submit</button>
            </form>
        </div>
    </main>
</div>


    