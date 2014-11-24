<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Home/Login/Create account page
Router::add('/', '/app/controllers/home.php');

//Users
Router::add('/profile', '/app/controllers/users/profile.php');
Router::add('/update_points', '/app/controllers/update_points.php');

// Comments
Router::add('/new_comment', '/app/controllers/new_comment.php');


//Log In:
Router::add('/login', '/app/controllers/login/login.php');
Router::add('/account', '/app/contollers/login/account.php');
Router::add('/logout', '/app/controllers/login/logout.php');


// Issue Route
Router::route();