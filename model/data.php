<?php
    $id = $_GET['id'];
    $event_id = $_GET['id'];
    
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    
    $sql = "SELECT * FROM `data` WHERE `ID` = '$id'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    
    $event_sql = "SELECT * FROM `events` WHERE `event_id` = '$event_id'";
    $event_result = $conn -> query($event_sql);
    $event_row = $event_result -> fetch_assoc();
    
    $img = $row['profile_picture'];
    $conn -> close(); 

