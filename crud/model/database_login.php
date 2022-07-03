<?php
    $conn = new mysqli("localhost", "root", "", "register");
    $sql = "SELECT * FROM `data` WHERE Username = '$username'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    if (empty($row['Username']) || $row['Username'] !== $username) {
        $_SESSION['login'] = 0;
        $error = "Username is incorrect!";
        header("Location: http://localhost/mvc/project/?page=login&error=$error");
    } else {
        $pass = $row['Password'];
        $varify_pass = password_verify($password, $pass);
        if ($varify_pass === TRUE) {
            $_SESSION['login'] = 1;
            $role = $row['Role'];
            $id = $row['ID'];
            header("Location: http://localhost/mvc/project/?page=home&role=$role&id=$id");
        } else {
            $_SESSION['login'] = 0;
            $error = "Username or password incorrect!";
            header("Location: http://localhost/mvc/project/?page=login&error=$error");
        }
    }
    $conn -> close();   
?>