<?php 

// Log In

class Controller extends AjaxController {
    protected function init() {
        
        $user = User::isValid($_POST);

        if($user){
        $this->view['redirect'] = '/profile?user_id=' . $user->user_id;
        UserLogin::logIn($_POST['user_name'], $_POST['password']);
        } else {
            $this->view['message'] = 'Please enter a valid User Name and Password.';
        }
        exit();
    }
}

$controller = new Controller();