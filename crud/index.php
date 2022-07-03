<?php
    session_start();
    $page = (isset($_GET['page'])) ? $_GET['page'] : 'login';
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'data';
    switch ($page) {
        case 'login':
            require "./controller/user_login.php";
            break;
        case 'signup':
            require "./controller/user_signup.php";
            break;
        case 'update':
            require "./controller/user_update.php";
            break;
        case 'home':
            require "./controller/home.php";
            break;
        default:
            require "./controller/home.php";
            break;
    }
?>