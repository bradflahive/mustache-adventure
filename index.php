<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Home/Login/Create account page
Router::add('/', '/app/controllers/home.php');

//Users
Router::add('/profile', '/app/controllers/users/profile.php');



/*// Users
Router::add('/users', '/app/controllers/users/list.php');
Router::add('/users/register', '/app/controllers/users/register/form.php');
Router::add('/users/register/process_form/', '/app/controllers/users/register/process_form.php');*/

// Issue Route
Router::route();