<?php
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    $sql = "INSERT INTO `data`(`Username`, `profile_picture`, `Email`, `Birthdate`, `Role`, `Password`) VALUES ('$username','$profile_pic','$email','$birth_date','$role','$password')";  
    $sql1 = "SELECT * FROM `data` WHERE (Username = '$username' OR Email = '$email')";
    $result = $conn -> query($sql1);
    while ($row = $result -> fetch_assoc()) {
        if ($row['Username'] === $username) {
            $_SESSION['login'] = 0;
            $error = "This username already exists!";
        } elseif ($row['Email'] === $email) {
            $_SESSION['login'] = 0;
            $error = "This email address already exists!";
        }  
        $_SESSION['login'] = 0;
        header("Location: http://localhost/curd/?page=signup&id=$id&error=$error");
    }  
    if ($conn -> query($sql) === TRUE) {
        $_SESSION['login'] = 1;
        header("Location: http://localhost/curd/?page=home&role=$role");
    } else {
        echo "<h1><center>error occured</center></h1>";
    }
    $conn -> close();
?>