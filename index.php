<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Home/Login/Create account page
Router::add('/', '/app/controllers/home.php');

//Users
Router::add('/profile', '/app/controllers/users/profile.php');

//Log In:
Router::add('/login', '/mockups/login/login.php');
Router::add('/create_user', '/mockups/login/create_user.php');
Router::add('/process_login', '/mockups/login/process_login.php');
Router::add('/account', '/mockups/login/account.php');
Router::add('/logout', '/mockups/login/logout.php');


/*// Users
Router::add('/users', '/app/controllers/users/list.php');
Router::add('/users/register', '/app/controllers/users/register/form.php');
Router::add('/users/register/process_form/', '/app/controllers/users/register/process_form.php');*/

// Issue Route
Router::route();