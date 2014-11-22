<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Home/Login/Create account page
Router::add('/', '/app/controllers/home.php');

//Users
Router::add('/profile', '/app/controllers/users/profile.php');
Router::add('/update_points', '/app/controllers/update_points.php');

// Comments
Router::add('/new_comment', '/app/controllers/new_comment');


//Log In:
Router::add('/login', '/mockups/login/login.php');
Router::add('/process_login', '/mockups/login/process_login.php');
Router::add('/account', '/mockups/login/account.php');
Router::add('/logout', '/mockups/login/logout.php');




// Issue Route
Router::route();