<?php
    $event_id = $_GET['id'];
    $user_role = $_SESSION['role'];
    
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    
    $event_sql_check = "SELECT * FROM `events` WHERE (event_id = '$event_id')";
    $event_result = $conn -> query($event_sql_check);
    
    if (mysqli_num_rows($event_result) > 1) {
        while ($row = $event_result -> fetch_assoc()) {
            if ($row['event_name'] === $eventname) {
                $error = "This event already exists!";
            } 
            header("Location: http://localhost/curd/?page=event_update&error=$error");
        }  
    }
    
    $sql = "UPDATE `events` SET `event_name`='$eventname',`event_desc`='$event_desc',`event_city`='$event_city',`event_date`='$event_date',"
            . "`ticket_price`='$ticket_price' WHERE `event_id` = '$event_id';";  
    
    if ($conn -> query($sql) === TRUE) {
        $_SESSION['login'] = 1;
        header("Location: http://localhost/curd/?page=home");
    } else {
        echo "<h1><center>error occured</center></h1>";
    }
    
    $conn -> close();       