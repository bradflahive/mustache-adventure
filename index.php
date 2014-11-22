<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Home/Login/Create account page
Router::add('/', '/app/controllers/home.php');

//Users
Router::add('/profile', '/app/controllers/users/profile.php');
Router::add('/award_points', '/app/controllers/users/update_points.php');


//Log In:
Router::add('/login', '/mockups/login/login.php');
Router::add('/process_login', '/mockups/login/process_login.php');
Router::add('/account', '/mockups/login/account.php');
Router::add('/logout', '/mockups/login/logout.php');




// Issue Route
Router::route();