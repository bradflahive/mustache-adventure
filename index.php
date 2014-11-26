<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Home/Login/Create account page
Router::add('/', '/app/controllers/home.php');

//Users
Router::add('/profile', '/app/controllers/users/profile.php');

// Comments
Router::add('/update_points', '/app/controllers/comment/update_points.php');
Router::add('/new_comment', '/app/controllers/comment/new_comment.php');
Router::add('/delete_comment', '/app/controllers/comment/delete_comment.php');


//Log In:
Router::add('/login', '/app/controllers/login/login.php');
Router::add('/account', '/app/contollers/login/account.php');
Router::add('/logout', '/app/controllers/login/logout.php');


// Issue Route
Router::route();