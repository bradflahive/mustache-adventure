<?php 

class UserLogin{

    public static function logIn ($user_name,$password){

        // $sql = "
        //     SELECT *
        //     FROM user
        //     WHERE user_name = '{user_name}'
        //     AND password = '{password}'
        //     ";

        $_SESSION['logged_user'] = 1;
    }

    public static function isLogged() {
        return is_numeric($_SESSION['logged_user']);
    }

    public static function logOut(){
        unset($_SESSION['logged_user']);
    }

    public static function getUserID(){
        return $this->$_SESSION['user_id'];
    }
}