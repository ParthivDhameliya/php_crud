<?php
    $role = "user";
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    $sql = "INSERT INTO `data`(`Username`, `profile_picture`, `Email`, `Birthdate`, `Role`, `Password`) VALUES ('$username','$profile_pic','$email','$birth_date','$role','$password')";  
    $sql1 = "SELECT * FROM `data` WHERE (Username = '$username' OR Email = '$email')";
    $result = $conn -> query($sql1);
    while ($row = $result -> fetch_assoc()) {
        if ($row['Username'] === $username) {
            $error = "This username already exists!";
        } elseif ($row['Email'] === $email) {
            $error = "This email address already exists!";
        }  
        header("Location: http://localhost/curd/?page=signup&error=$error");
    }  
    if ($conn -> query($sql) === TRUE) {
        $_SESSION['login'] = 1;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['id'] = $row['ID'];
        $_SESSION['content'] = "people_list";
        header("Location: http://localhost/curd/?page=home");
    } else {
        echo "<h1><center>error occured</center></h1>";
    } 
    $conn -> close();
