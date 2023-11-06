<?php   
    $eventname = $event_desc = $event_city = $event_date = $ticket_price = "";
    $eventnameError = $event_descError = $event_cityError = $event_dateError = $ticket_priceError = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['create_event'])) {
            if (empty(filter_input(INPUT_POST, 'eventname'))) {
                $eventnameError = " Event name is required ";
            } else {
                $eventname = trim(filter_input(INPUT_POST, 'eventname'));
                if (!preg_match("/^[a-zA-Z-' ]*$/", $eventname)) {
                    $eventnameError = "Only letters and white space allowed";
                }
            }

            if (empty(filter_input(INPUT_POST, 'event_desc'))) {
                $event_descError = " Event description is required ";
            } else {
                $event_desc = trim(filter_input(INPUT_POST, 'event_desc'));
            }      

            if (empty(filter_input(INPUT_POST, 'event_city'))) {
                $event_cityError = " Event city is required ";
            } else {
                $event_city = trim(filter_input(INPUT_POST, 'event_city'));
                if (!preg_match("/^[a-zA-Z-' ]*$/", $event_city)) {
                    $event_cityError = "Only letters and white space allowed";
                }
            }

            if (empty(filter_input(INPUT_POST, 'event_date'))) {
                $event_dateError = " Event date is required ";
            } else {
                $event_date = trim(filter_input(INPUT_POST, 'event_date'));
            }

            if (empty(filter_input(INPUT_POST, 'ticket_price'))) {
                $ticket_priceError = " Ticket price is required ";
            } else {
                $ticket_price = trim(filter_input(INPUT_POST, 'ticket_price'));
                if(!preg_replace( '/[^0-9]/', '', $ticket_price )) {
                    $ticket_priceError = "Only number are allowed.";
                }
            }

            if (empty($eventnameError) && empty($event_descError) && empty($event_cityError) && empty($event_dateError) && empty($ticket_priceError)) {
                $event_date = date("Y-m-d", strtotime($event_date));

                require "./model/database_event_booking.php";
            }           
        } elseif (isset($_POST['cancel_event'])) {
            header("Location: http://localhost/curd/?page=home");
        }
    } 
    $error = filter_input(INPUT_GET, 'error');
    if (isset($error)) {
        $_SESSION['login'] = 0;
        echo "<center><h1>" . $error ."</center></h1>";
    }
require_once './view/event_booking.php';
