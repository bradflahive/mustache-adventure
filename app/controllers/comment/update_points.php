<?php

/**
 * Ajax Controller
 */
 class Controller extends AjaxController {

  protected function init() {

    if ($_POST['comment_id']) {

      $_POST['user_id'] = UserLogin::getUserID();
      $total = (new Comment($_POST['comment_id']))->givePoints($_POST);
      $this->view['points'] = $total;

    }
    else {
        $this->view['message'] = 'No comment ID provided';
    }

  }

}
$controller = new Controller();
