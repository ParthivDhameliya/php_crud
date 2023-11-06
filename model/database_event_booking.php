<?php
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $date = date("Y-m-d");
    
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    
    $sql = "INSERT INTO `events`(`event_name`, `event_desc`, `event_city`, `event_date`, `ticket_price`, `organizer_name`, `organizer_email`, `date_created`) "
            . "VALUES ('$eventname','$event_desc','$event_city','$event_date','$ticket_price','$name', '$email', '$date')";  
    
    $sql1 = "SELECT * FROM `events` WHERE (event_name = '$eventname')";
    $result = $conn -> query($sql1);
    while ($row = $result -> fetch_assoc()) {
        if ($row['event_name'] === $eventname) {
            $error = "This event already exists!";
        }  
        header("Location: http://localhost/curd/?page=event&error=$error");
    }  
    if ($conn -> query($sql) === TRUE) {
        $_SESSION['login'] = 1;
        $_SESSION['event_name'] = $eventname;
        header("Location: http://localhost/curd/?page=home");
    } else {
        echo "<h1><center>error occured</center></h1>";
    } 
    $conn -> close();
