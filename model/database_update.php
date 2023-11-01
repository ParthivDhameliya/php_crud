<?php
    $id = $_GET['id'];
    $user_role = $_GET['role'];
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
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
        header("Location: http://localhost/curd/?page=update&id=$id&error=$error");
    }  
    $sql = "UPDATE `data` SET `Username`='$username',`profile_picture`='$profile_pic',`Email`='$email',`Birthdate`='$birth_date',`Role`='$role' WHERE `ID` = '$id';";  
    if ($conn -> query($sql) === TRUE) {
        $_SESSION['login'] = 1;
        header("Location: http://localhost/curd/?page=home&role=$user_role");
    } else {
        echo "<h1><center>error occured</center></h1>";
    }
    $conn -> close();
?>         