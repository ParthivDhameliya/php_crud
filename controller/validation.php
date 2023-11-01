<?php

function validate_username($username, $usernameError) {
    if (empty($username)) {
        $usernameError = " Username is required ";
        return $usernameError;
    } else {
        $username = trim($username);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $usernameError = "Only letters and white space allowed";
            return $usernameError;
        }
    }
    return $username;
}

function validate_profile_pic($profile_pic, $profile_picError, $username, $max_files_size) {
    if (!isset($profile_pic)) {
        $profile_picError = " Profile picture is required ";
        return $profile_picError;
    } else {
        $file = explode(".", basename($_FILES['profile_pic']['name']));
        $profile_pic = $file[0].".". $file[1];
        $filename = $file[0];
        $extension = $file[1]; 
        $profile_pic = str_replace($filename, $username, basename($_FILES['profile_pic']['name']));
        $files_size = $_FILES['profile_pic']['size'];

        if ($extension !== "png") {
            $profile_picError = " Sorry, only png files are allowed. ";
            return $profile_picError;
        } 
        if ($files_size > $max_files_size) {
            $profile_picError = " Sorry, file size must be less than 1MB. ";
            return $profile_picError;
        } 
    }
    return $profile_pic;
}

function validate_email($email, $emailError) {
    if (empty($email)) {
        $emailError = " Email is required ";
        return $emailError;
    } else {
        $email = trim($email);
        if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            return $emailError;
        }
    }
    return $email;
}

function validate_mobile_num($mobile_num, $mobile_numError) {
    if (empty($mobile_num)) {
        $mobile_numError = " Mobile number is required ";
        return $mobile_numError;
    } else {
        $mobile_num = trim($mobile_num);
        if (!preg_match("/^[0-9]{10}+$/", $mobile_num)) {
            $mobile_numError = "only numbers are allowed or 10 numbers required";
            return $mobile_numError;
        }
    }
    return $mobile_num;
}

function validate_birthdate($birth_date, $birth_dateError, $min_age) {
    if (empty($birth_date)) {
        $birth_dateError = " Birth date is required ";
        return $birth_dateError;
    } else {
        $birth_date = trim($birth_date);
        if ($min_age > 0) {
            $date1 = date_create($birth_date);
            $date2 = date_create(date("d-m-Y"));
            $diff = date_diff($date1, $date2);
            $difference = $diff->format("%y");
            if ($difference < $min_age) {
                $birth_dateError = " Sorry, minimum $min_age years is required ";
                return $birth_dateError;
            }
        }
    }
    return $birth_date;
}

function validate_role($user_role) {
    $role = $user_role;
    return $role;
}

function validate_password($password, $passwordError) {
    if (empty($password)) {
        $passwordError = " Password is required ";
        return $passwordError;
    } else {
        $password = trim($password);
        if (strlen($password) <= '8') {
            $passwordError = "Your Password Must Contain At Least 8 Characters!";
            return $passwordError;
        } elseif(!preg_match("/[0-9]+/",$password)) {
            $passwordError = "Your Password Must Contain At Least 1 Number!";
            return $passwordError;
        } elseif(!preg_match("/[A-Z]+/",$password)) {
            $passwordError = "Your Password Must Contain At Least 1 Capital Letter!";
            return $passwordError;
        } elseif(!preg_match("/[a-z]+/",$password)) {
            $passwordError = "Your Password Must Contain At Least 1 Lowercase Letter!";
            return $passwordError;
        }
    }
    return $password;
}

function validate_re_password($password, $re_password, $re_passwordError) {
    if (empty($re_password)) {
        $re_passwordError = " Password is required ";
        return $re_passwordError;
    } 
    if ($password !== $re_password) {
        $re_passwordError = "Please, ckeck your password properly ";
        return $re_passwordError;
    }
    return $re_password;
}