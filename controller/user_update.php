<?php
    if (isset($_SESSION['login'])) {
        $file_dir = "./img/";
        require_once "./model/data.php"; 
        $username = $row['Username'];
        $profile_pic = $row['profile_picture'];
        $email = $row['Email'];
        $birth_date = $row['Birthdate'];
        $role = $row['Role'];
        $usernameError = $profile_picError = $emailError = $mobile_numError = $birth_dateError = "";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
                $usernameError = "Only letters and white space allowed";
            }

            if (isset($_POST['profile_pic'])) {
                $file = explode(".", basename($_FILES['profile_pic']['name']));
                $profile_pic = $file[0].".". $file[1];
                $filename = $file[0];
                $extension = $file[1]; 
                $profile_pic = str_replace($file[0], $username, basename($_FILES['profile_pic']['name']));
                $temp_file = $_FILES['profile_pic']['tmp_name'];
                $files_size = $_FILES['profile_pic']['size'];

                if ($extension !== "png") {
                    $profile_picError = " Sorry, only png files are allowed. ";
                    if ($files_size > 100000) {
                        $profile_picError = " Sorry, file size must be less than 1MB. ";
                    } 
                } 
            }

            $email = trim($_POST['email']);
            if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
            }
            
            if (!empty($_POST['birth_date'])) {
                $birth_date = trim($_POST['birth_date']);
            } else {
                $date1 = date_create($birth_date);
                $date2 = date_create(date("d-m-Y"));
                $diff = date_diff($date1, $date2);
                $difference = $diff->format("%y");
                if ($difference < 15) {
                    $birth_dateError = " Sorry, minimum 15 years is required ";
                }
            }

            $role = $_POST['select'];

            if (empty($username) || empty($email) || empty($birth_date) || empty($role)) {
                $username = $row['Username'];
                $profile_pic = $row['profile_picture'];
                $email = $row['Email'];
                $mobile_num = $row['Phonenumber'];
                $birth_date = $row['Birthdate'];
                $role = $row['Role'];
            }
            
            if (empty($usernameError) && empty($emailError) && empty($profile_picError) && empty($birth_dateError)) {
                $birth_date = date("Y-m-d", strtotime($birth_date));
                if (isset($_POST['profile_pic'])) {
                    $file[0] = $username;
                    if (move_uploaded_file($temp_file, $file_dir. $profile_pic)) { 
                    } else { 
                        $error = "Sorry, there is an error while uploading your file.";
                        header("Location: http://localhost/curd/?page=update&error=$error");
                    }
                }
                require "./model/database_update.php";
            }   
        }
        if (isset($_GET['error'])) {
            $_SESSION['login'] = 0;
            echo "<center><h1>" . $_GET['error'] ."</center></h1>";
        }
        require "./view/update.php";
    } else {
        $_SESSION['login'] = 0;
        $error = "Please, login first!";
        header("Location: http://localhost/curd/?page=login&error=$error");
    } 
?> 