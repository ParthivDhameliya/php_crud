<?php
    if (isset($_SESSION['login'])) {
        require_once "./model/data.php"; 
        $eventname = $event_row['event_name'];
        $event_desc = $event_row['event_desc'];
        $event_city = $event_row['event_city'];
        $event_date = $event_row['event_date'];
        $ticket_price = $event_row['ticket_price'];
        $eventnameError = $event_descError = $event_cityError = $event_dateError = $ticket_priceError = "";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['create_event'])) {
                $eventname = trim(filter_input(INPUT_POST, 'eventname'));
                if (!preg_match("/^[a-zA-Z-' ]*$/", $eventname)) {
                    $eventnameError = "Only letters and white space allowed";
                }
                
                $event_desc = trim(filter_input(INPUT_POST, 'event_desc'));
                
                $event_city = trim(filter_input(INPUT_POST, 'event_city'));
                if (!preg_match("/^[a-zA-Z-' ]*$/", $event_city)) {
                    $event_cityError = "Only letters and white space allowed";
                }
                
                $event_date = trim(filter_input(INPUT_POST, 'event_date'));
                
                $ticket_price = trim(filter_input(INPUT_POST, 'ticket_price'));
                if(!preg_replace( '/[^0-9]/', '', $ticket_price )) {
                    $ticket_priceError = "Only number are allowed.";
                }
                
                if (empty(filter_input(INPUT_POST, 'eventname')) || empty(filter_input(INPUT_POST, 'event_desc')) || empty(filter_input(INPUT_POST, 'event_city'))
                        || empty(filter_input(INPUT_POST, 'event_date')) || empty(filter_input(INPUT_POST, 'ticket_price'))) {
                    $eventname = $event_row['event_name'];
                    $event_desc = $event_row['event_desc'];
                    $event_city = $event_row['event_city'];
                    $event_date = $event_row['event_date'];
                    $ticket_price = $event_row['ticket_price'];
                }

                if (empty($eventnameError) && empty($event_descError) && empty($event_cityError) && empty($event_dateError) && empty($ticket_priceError)) {
                    $event_date = date("Y-m-d", strtotime($event_date));

                    require "./model/database_event_update.php";
                }  
            } elseif(isset($_POST['cancel_event'])) {
                header("Location: http://localhost/curd/?page=home");
            }
        }
        if (isset($_GET['error'])) {
            $_SESSION['login'] = 0;
            echo "<center><h1>" . $_GET['error'] ."</center></h1>";
        }
        require "./view/event_update.php";
    } else {
        $_SESSION['login'] = 0;
        $error = "Please, login first!";
        header("Location: http://localhost/curd/?page=login&error=$error");
    } 
