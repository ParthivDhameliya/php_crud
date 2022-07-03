<?php
    $conn = new mysqli("localhost", "root", "", "register");
    $sql = "SELECT * FROM `data`";

    if (isset($_POST['logout'])) {
        $_SESSION['login'] = 0;
        header("Location: http://localhost/mvc/project/?page=login");
    }

    if (isset($_POST['edit'])) {
        $user_role = $_GET['role'];
        if ($user_role !== "admin") {
            $error = "Only admin have access to change information!";
            header("Location: http://localhost/mvc/project/?page=home&id=$id&role=$user_role&error=$error");
        } else {
            $id = $_POST['edit'];
            header("Location: http://localhost/mvc/project/?page=update&id=$id&role=$user_role");
        }
    }

    if (isset($_POST['delete'])) {
        if (!empty($_POST['checkbox'])) {
            $all_id = $_POST['checkbox'];
            $extract_id = implode(",", $all_id);
            $delete="DELETE FROM `data` WHERE ID IN($extract_id)";
            $result = $conn -> query($delete);
        }
    }

    $search_value = @$_POST['search']; 
    $search_query = " WHERE (`ID` LIKE '%$search_value%' OR `Username` LIKE '%$search_value%' OR `Email` LIKE '%$search_value%' OR `Phonenumber` LIKE '%$search_value%' OR `Birthdate` LIKE '%$search_value%' OR `Role` LIKE '%$search_value%')";
    $search = $sql . $search_query;
    if (isset($_POST['search_btn'])) {
        if (!empty($_POST['search'])) {
            $result = $conn -> query($search);
        }
    }

    $role= "ID";
    $order= "ASC";
    if (isset($_POST['sort_btn'])) {
        $order = $_POST['sort'];
        $role = $_POST['select'];
    }

    $sort_query = " ORDER BY $role $order";
    $sort = $search . $sort_query;
    switch ($role) {
        case 'ID': case 'Username': case 'Email': case 'Birthdate': case 'Role':
            $result = $conn -> query($sort);
            break;
    }

    @$page = $_POST['page'];
    if ($page > 0) {
        $result_per_page = $_POST['select_page'];
        $number_of_results = $result -> num_rows;
        $number_of_pages = ceil($number_of_results/$result_per_page);
        $page_result = ($page - 1) * $result_per_page;
        $page_limit = " LIMIT ". $page_result.",". $result_per_page;
        $limit = $sort . $page_limit;
        if (isset($_POST['page_btn'])) {
            $result = $conn -> query($limit);
        }
    }
    $conn -> close();
?>