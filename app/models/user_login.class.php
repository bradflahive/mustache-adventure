<?php 

class UserLogin{

    public static function logIn ($user_id){
        // session_start();
        $_SESSION['logged_user'] = $user_id;
        // print_r($_SESSION);
    }

    public static function isLogged(){
        return is_numeric($_SESSION['logged_user']);
    }

    public static function logOut(){
        unset($_SESSION['logged_user']);
    }

    public static function getUserID(){
        return $this->$_SESSION['user_id'];
    }
}