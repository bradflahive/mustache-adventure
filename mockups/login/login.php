<?php 

class Controller extends AjaxController {
    protected function init() {
        if(isset($_POST['email'])){
            $user = new User($_POST);
        } 
        else {
            $user = (new User())->isValid($_POST);
        }

        if($user){
            $this->view['redirect'] = '/profile?user_id='.$user->user_id;
            UserLogin::logIn($_POST['user_name'], $_POST['password']);
        } else {
            $this->view['message'] = 
                'Please enter a valid User Name and Password.';
        }
        exit();
    }
}

$controller = new Controller();
