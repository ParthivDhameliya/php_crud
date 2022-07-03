<?php
    $id = $_GET['id'];
    $conn = new mysqli("localhost", "root", "", "register");
    $sql = "SELECT * FROM `data` WHERE `ID` = '$id'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $img = $row['profile_picture'];
    $conn -> close();
?>
