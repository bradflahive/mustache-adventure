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
        <form action="/login" method="POST" class="login-form">
            <input class="uname" type="text" name="user_name" title="Username">
            <input class="pword" type="password" name="password" data-exp-name="password" title="Password">
            <input class="email" type="email" name="email" data-exp-name="email" title="E-mail">
            <br>
            <button class="submit">submit</button><br>
            <button class="sign-up">sign up</button>
        </form>
        <div class="errormsg"></div>
    </main>
</div>
<p class="copyright">&copy Mustache-Adventures Co.</p>
<p class="copyright">The Worst (acting) Half of RockIT</p>


    
