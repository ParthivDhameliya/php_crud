<?php
    $username = $password = "";
    $usernameError = $passwordError = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['username'])) {
            $usernameError = " Username is required ";
        } else {
            $username = trim($_POST['username']);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                $usernameError = "Only letters and white space allowed";
            }
        }

        if (empty($_POST['password'])) {
            $passwordError = " Password is required ";
        } else {
            $password = trim($_POST['password']);
            if (strlen($_POST["password"]) <= '8') {
                $passwordError = "Your Password Must Contain At Least 8 Characters!";
            }
        }

        if (empty($usernameError) && empty($passwordError)) {
            require "./model/database_login.php";
            $username = $password = "";
        }
    }
    if (isset($_GET['error'])) {
        echo "<center><h1>" . $_GET['error'] ."</center></h1>";
    }
    require_once "./view/login.php";
?>