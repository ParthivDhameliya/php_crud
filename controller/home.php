<?php
    if ($_SESSION['login'] === 0 || !isset($_SESSION['login'])) {
        $error = "Please, login first!";
        header("Location: http://localhost/curd/?page=login&error=$error");
    }
    if(isset($_POST['event_add'])){
        header("Location: http://localhost/curd/?page=event_add");
    }
    
    switch ($action) {
        case 'data': 
            require "./model/database_home.php"; 
            require "./view/home.php";
            break;
        case 'profile_pic':
            require "./model/data.php";
            require "./view/profile_pic.php";
            break;
        case 'download_pic':
            require "./model/database_download_pic.php";
            break;
    } 

    
