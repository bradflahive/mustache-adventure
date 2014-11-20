<?php

// Create new user

class Controller extends AjaxController {
    protected function init() {

        $user = new User($_POST);

        $this->view['response'] = 'User ' . $user->user_name . ' was successfully created';

    }
}

$controller = new Controller();