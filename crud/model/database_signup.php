<?php
    $id = $_GET['id'];
    $user_role = $_GET['role'];
    $conn = new mysqli("localhost", "root", "", "register");
    $sql = "INSERT INTO `data`(`Username`, `profile_picture`, `Email`, `Phonenumber`, `Birthdate`, `Role`, `Password`) VALUES ('$username','$profile_pic','$email','$mobile_num','$birth_date','$role','$password')";  
    $sql1 = "SELECT * FROM `data` WHERE (Username = '$username' OR Email = '$email' OR Phonenumber = '$mobile_num')";
    $result = $conn -> query($sql1);
    while ($row = $result -> fetch_assoc()) {
        if ($row['Username'] === $username) {
            $_SESSION['login'] = 0;
            $error = "This username already exists!";
        } elseif ($row['Email'] === $email) {
            $_SESSION['login'] = 0;
            $error = "This email address already exists!";
        } elseif ($row['Phonenumber'] === $mobile_num) {
            $_SESSION['login'] = 0;
            $error = "This mobile number already exists!";
        }    
        $_SESSION['login'] = 0;
        header("Location: http://localhost/mvc/project/?page=signup&id=$id&error=$error");
    }  
    if ($conn -> query($sql) === TRUE) {
        $_SESSION['login'] = 1;
        header("Location: http://localhost/mvc/project/?page=home&role=$role");
    } else {
        echo "<h1><center>error occured</center></h1>";
    }
    $conn -> close();
?>