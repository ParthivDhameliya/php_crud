<?php
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    $sql = "SELECT * FROM `data` WHERE Username = '$username'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    if (empty($row['Username']) || $row['Username'] !== $username) {
        $error = "Username is incorrect!";
        header("Location: http://localhost/curd/?page=login&error=$error");
    } else {
        $pass = $row['Password'];
        $varify_pass = password_verify($password, $pass);
        if ($varify_pass === TRUE) {
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $row['Email'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['id'] = $row['ID'];
            $_SESSION['content'] = "people_list";
            header("Location: http://localhost/curd/?page=home");
        } else { 
            $error = "Username or password incorrect!";
            header("Location: http://localhost/curd/?page=login&error=$error");
        }
    }
    $conn -> close();   
