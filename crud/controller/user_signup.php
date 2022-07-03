<?php
    $file_dir = "./img/";
    $username = $profile_pic = $email = $mobile_num = $birth_date = $role = $password = $re_password = "";
    $usernameError = $profile_picError = $emailError = $mobile_numError = $birth_dateError = $passwordError = $re_passwordError = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['username'])) {
            $usernameError = " Username is required ";
        } else {
            $username = trim($_POST['username']);
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

        if (empty($_POST['email'])) {
            $emailError = " Email is required ";
        } else {
            $email = trim($_POST['email']);
            if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
            }
        }

        if (empty($_POST['mobile_num'])) {
            $mobile_numError = " Mobile number is required ";
        } else {
            $mobile_num = trim($_POST['mobile_num']);
            if (!preg_match("/^[0-9]{10}+$/", $mobile_num)) {
                $mobile_numError = "only numbers are allowed or 10 numbers required";
            }
        }
        
        if (empty($_POST['birth_date'])) {
            $birth_dateError = " Birth date is required ";
        } else {
            $birth_date = trim($_POST['birth_date']);
            $date1 = date_create($birth_date);
            $date2 = date_create(date("d-m-Y"));
            $diff = date_diff($date1, $date2);
            $difference = $diff->format("%y");
            if ($difference < 15) {
                $birth_dateError = " Sorry, minimum 15 years is required ";
            }
        }

        $role = $_POST['select'];

        if (empty($_POST['password'])) {
            $passwordError = " Password is required ";
        } else {
            $password = trim($_POST['password']);
            if (strlen($_POST["password"]) <= '8') {
                $passwordError = "Your Password Must Contain At Least 8 Characters!";
            } elseif(!preg_match("/[0-9]+/",$password)) {
                $passwordError = "Your Password Must Contain At Least 1 Number!";
            } elseif(!preg_match("/[A-Z]+/",$password)) {
                $passwordError = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif(!preg_match("/[a-z]+/",$password)) {
                $passwordError = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
        }
  
        if (empty($_POST['re_password'])) {
            $re_passwordError = " Password is required ";
        } else {
            $re_password = trim($_POST['re_password']);
            if ($password !== $re_password) {
                $re_passwordError = "Please, ckeck your password properly ";
            }
        }

        if (empty($usernameError) && empty($emailError) && empty($profile_picError) && empty($mobile_numError) && empty($birth_dateError) && 
            empty($passwordError) && empty($re_passwordError)) {
            $password = password_hash($password, PASSWORD_DEFAULT);   
            $birth_date = date("Y-m-d", strtotime($birth_date));

            $file[0] = $username;
            if (!file_exists($profile_pic)) {
                if (move_uploaded_file($temp_file, $file_dir. $profile_pic)) { 
                } else { 
                    $error = "Sorry, there is an error while uploading your file.";
                    header("Location: http://localhost/mvc/project/?page=signup&error=$error");
                }
            }
            require "./model/database_signup.php";
        }                        
    } 
    if (isset($_GET['error'])) {
        $_SESSION['login'] = 0;
        echo "<center><h1>" . $_GET['error'] ."</center></h1>";
    }
    require_once './view/signup.php';
?>   