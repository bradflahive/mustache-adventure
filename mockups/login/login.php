<?php 

// Log In

class Controller extends AjaxController {
    protected function init() {
        
        // if($_POST['user_id']){
        //     $user = new User($_POST['user_id']);
        //     $user->update($_POST);

        // } else {
        //     $user = new User($_POST);             
        // }

        // UserLogin::logIn($_POST['user_name'], $_POST['password']);
        $this->view['redirect'] = '/profile';
     
    }
}

$controller = new Controller();