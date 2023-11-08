<?php
    $username = $_SESSION['username'];
    
    $conn = new mysqli("localhost", "root", "letmein", "projectDB");
    
    $sql = "SELECT * FROM `data`";
    $result = $conn ->  query($sql);
    
    $events_sql = "SELECT * FROM `events` WHERE organizer_name='$username'";
    $event_result = $conn -> query($events_sql);
    
    $events_list_sql = "SELECT e.event_id, e.event_name, e.event_desc, e.event_city, e.event_date, e.ticket_price, d.Username, d.Role
                        FROM data d, events e
                        WHERE d.Username = e.organizer_name AND
                              d.Email = e.organizer_email";
    $events_list = $conn -> query($events_list_sql);
    
    $event_by_people_sql_start = "SELECT d.ID, d.Username, d.Email, d.Role, d.Birthdate, COUNT(e.event_name) AS 'Total_events'
                            FROM data d, events e
                            WHERE d.Username = e.organizer_name AND
                                  d.Email = e.organizer_email";
    $event_by_people_sql_end = " GROUP BY d.ID, d.Username, d.Email, d.Role, d.Birthdate";
    $event_by_people_sql = $event_by_people_sql_start . $event_by_people_sql_end;
    $event_by_people_result = $conn -> query($event_by_people_sql);
    
//    content                   
    if(isset($_POST['content_submit'])) {
        $_SESSION['content'] = $_POST['content']; 
    }
    
//    logout
    if (isset($_POST['logout'])) {
        $_SESSION['login'] = 0;
        $_SESSION['username'] = "";
        $_SESSION['email'] = "";
        $_SESSION['role'] = "";
        $_SESSION['id'] = "";
        $_SESSION['content'] = "";
        header("Location: http://localhost/curd/?page=login");
    }
    
//    edit events
    if(isset($_POST['event_edit'])) {
        $username = $_SESSION['username'];
        $id = $_POST['event_edit'];
        header("Location: http://localhost/curd/?page=event_update&id=$id");
    }
    
//    edit profiles
    if (isset($_POST['edit'])) {
        $user_role = $_SESSION['role'];
        if ($user_role !== "admin") {
            $error = "Only admin can change information!";
            header("Location: http://localhost/curd/?page=home&error=$error");
        } else {
            $id = $_POST['edit'];
            header("Location: http://localhost/curd/?page=update&id=$id");
        }
    }

//   profile delete
    if (isset($_POST['delete'])) {
        $user_role = $_SESSION['role'];
        if ($user_role !== "admin") {
            $error = "Only admin can delete information!";
            header("Location: http://localhost/curd/?page=home&error=$error");
        } else {
            $id = $_POST['delete'];
            $delete="DELETE FROM `data` WHERE `ID` = $id";
            $result = $conn -> query($delete);
            if ($result === TRUE) {
                header("Location: http://localhost/curd/?page=home");
            }
        }
    }
    
//    event delete
    if (isset($_POST['event_delete'])) {
        $id = $_POST['event_delete'];
        $event_delete="DELETE FROM `events` WHERE `event_id` = '$id'";
        $result = $conn -> query($event_delete);
        if ($result === TRUE) {
            header("Location: http://localhost/curd/?page=home");
        }
    }

    $is_events_sorted = $is_people_sorted = $is_event_by_people_sorted = $is_events_list_sorted = 0;
    
//    search
    $search_value = @$_POST['search']; 
    
    $search_query = " WHERE (`ID` LIKE '%$search_value%' OR `Username` LIKE '%$search_value%' OR `Email` LIKE '%$search_value%' OR `Birthdate` LIKE '%$search_value%' OR `Role` LIKE '%$search_value%')";
    
    $event_search_query = " AND (`event_id` LIKE '%$search_value%' OR `event_name` LIKE '%$search_value%' OR `event_desc` LIKE '%$search_value%' OR `event_date` LIKE '%$search_value%' OR "
                        . "`event_city` LIKE '%$search_value%' OR `ticket_price` LIKE '%$search_value%' OR 'date_created' LIKE '%$search_value%')";
    
    $events_list_search_query = " AND (e.event_id LIKE '%$search_value%' OR e.event_name LIKE '%$search_value%' OR e.event_desc LIKE '%$search_value%' OR e.event_date LIKE '%$search_value%' OR "
                        . "e.event_city LIKE '%$search_value%' OR e.ticket_price LIKE '%$search_value%' OR d.Username LIKE '%$search_value%' OR d.Role LIKE '%$search_value%')";
    
    $event_by_people_search_query = " AND (`ID` LIKE '%$search_value%' OR `Username` LIKE '%$search_value%' OR `Email` LIKE '%$search_value%' OR "
                                    . "`Birthdate` LIKE '%$search_value%' OR `Role` LIKE '%$search_value%')";
    
    $search = $sql . $search_query;
    $event_search = $events_sql . $event_search_query;
    $events_list_search = $events_list_sql . $events_list_search_query;
    $event_by_people_search = $event_by_people_sql_start . $event_by_people_search_query . $event_by_people_sql_end;
    
//    sorting
    $role= "";
    $order= "";
    if (isset($_POST['sort_btn'])) {
        $order = $_POST['sort'];
        $role = $_POST['select'];
    }
    
    $sort_query = " ORDER BY $role $order";

    $sort = $search . $sort_query;
    $event_sort = $event_search . $sort_query;
    $event_by_people_sort = $event_by_people_sql . $sort_query;
    $events_list_sort = $events_list_search . $sort_query;
    
    if (isset($_POST['search_btn'])) {
        if (!empty($_POST['search'])) { 
            if ($is_people_sorted == 1) {
                $search = $search . $sort_query;
            }
            $result = $conn -> query($search);
            if($_SESSION['role'] === "user") {
                if ($is_events_sorted == 1) {
                    $event_search = $event_search . $sort_query;
                }
                $event_result = $conn -> query($event_search);
            }
            if($_SESSION['content'] === "events_by_people") {
                if ($is_event_by_people_sorted == 1) {
                    $event_by_people_search = $event_by_people_search . $sort_query;
                }
                $event_by_people_result = $conn -> query($event_by_people_search);
            }
            if($_SESSION['content'] === "events_list") {
                if ($is_events_list_sorted == 1) {
                    $events_list_search = $events_list_search . $sort_query;
                }
                $events_list = $conn -> query($events_list_search);
            }
        }
    }


    if ($_SESSION['role'] === "user") {
        switch ($role) {
            case 'event_id': case 'event_name': case 'event_date': case 'event_city': case 'ticket_price':
                $is_events_sorted = 1;
                $event_result = $conn ->query($event_sort);
                break;
        }
    } elseif ($_SESSION['content'] === "events_by_people") {
        switch ($role) {
            case 'ID': case 'Username': case 'Email': case 'Role': case 'Birthdate': case 'Total_events':
                $is_event_by_people_sorted = 1;
                $event_by_people_result = $conn ->query($event_by_people_sort);
                break;
        }
    } elseif ($_SESSION['content'] === "people_list") {
        switch ($role) {
            case 'ID': case 'Username': case 'Email': case 'Birthdate': case 'Role':
                $is_people_sorted = 1;
                $result = $conn -> query($sort);
                break;
        }
    } elseif ($_SESSION['content'] === "events_list") {
        switch ($role) {
            case 'event_id': case 'event_name': case 'event_date': case 'event_city': case 'ticket_price': case 'Username': case 'Role':
                $is_events_list_sorted = 1;
                $events_list = $conn -> query($events_list_sort);
                break;
        }
    }
    
    $conn -> close();
?>
