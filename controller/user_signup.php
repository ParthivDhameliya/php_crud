<?php   
    require 'validation.php';
    
    $file_dir = "/var/www/html/curd_img/";
    
    $username = $profile_pic = $email = $birth_date = $role = $password = $re_password = "";
    $usernameError = $profile_picError = $emailError = $mobile_numError = $birth_dateError = $passwordError = $re_passwordError = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (empty(filter_input(INPUT_POST, 'username'))) {
            $usernameError = " Username is required ";
        } else {
            $username = trim(filter_input(INPUT_POST, 'username'));
            if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
                $usernameError = "Only letters and white space allowed";
            }
        }
        
        if (!isset($profile_pic)) {
            $profile_picError = " Profile picture is required ";
        } else {
            $file = explode(".", basename($_FILES['profile_pic']['name']));
            $profile_pic = $file[0].".". $file[1];
            $filename = $file[0];
            $extension = $file[1]; 
            $profile_pic = str_replace($filename, $username, basename($_FILES['profile_pic']['name']));
            $files_size = $_FILES['profile_pic']['size'];

            if ($extension !== "png") {
                $profile_picError = " Sorry, only png files are allowed. ";
                if ($files_size > 100000) {
                    $profile_picError = " Sorry, file size must be less than 1MB. ";
                } 
            }
        }      

        if (empty(filter_input(INPUT_POST, 'email'))) {
            $emailError = " Email is required ";
        } else {
            $email = trim(filter_input(INPUT_POST, 'email'));
            if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
            }
        }
        
        if (empty(filter_input(INPUT_POST, 'birth_date'))) {
            $birth_dateError = " Birth date is required ";
        } else {
            $birth_date = trim(filter_input(INPUT_POST, 'birth_date'));
            $date1 = date_create($birth_date);
            $date2 = date_create(date("d-m-Y"));
            $diff = date_diff($date1, $date2);
            $difference = $diff->format("%y");
            if ($difference < $min_age) {
                $birth_dateError = " Sorry, minimum $min_age years is required ";
            }
        }
        
        $role = filter_input(INPUT_POST, 'select');

        if (empty(filter_input(INPUT_POST, 'password'))) {
            $passwordError = " Password is required ";
        } else {
            $password = trim(filter_input(INPUT_POST, 'password'));
            if (strlen($password) <= '8') {
                $passwordError = "Your Password Must Contain At Least 8 Characters!";
            } elseif(!preg_match("/[0-9]+/",$password)) {
                $passwordError = "Your Password Must Contain At Least 1 Number!";
            } elseif(!preg_match("/[A-Z]+/",$password)) {
                $passwordError = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif(!preg_match("/[a-z]+/",$password)) {
                $passwordError = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
        }
        
        if (empty(filter_input(INPUT_POST, 're_password'))) {
            $re_passwordError = " Password is required ";
        } else {
            $re_password = trim(filter_input(INPUT_POST, 're_password'));
            if ($password !== $re_password) {
                $re_passwordError = "Please, ckeck your password properly ";
            }
        }

        if (empty($usernameError) && empty($emailError) && empty($profile_picError) && empty($mobile_numError) && empty($birth_dateError) && 
            empty($passwordError) && empty($re_passwordError)) {
            $password = password_hash($password, PASSWORD_DEFAULT);   
            $birth_date = date("Y-m-d", strtotime($birth_date));

            $image = $file_dir.$profile_pic;
            $temp_file = $_FILES["profile_pic"]["tmp_name"];
            if (!file_exists($profile_pic)) {
                if (move_uploaded_file($temp_file, $image)) { 
                } else { 
                    $error = "Sorry, there is an error while uploading your file.";
                    header("Location: http://localhost/curd/?page=signup&error=$error");
                }
            }
            require "./model/database_signup.php";
        }                        
    } 
    $error = filter_input(INPUT_GET, 'error');
    if (isset($error)) {
        echo "<center><h1>" . $error ."</center></h1>";
    }
    require_once './view/signup.php';
