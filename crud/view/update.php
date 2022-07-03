<?php require_once "header.php"; ?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="box">
        <div class="head">Update Form</div>
            <div class="input">
                <input type="text" name="username" maxlength="25" placeholder="Username *" class="user" value="<?php echo $username ?>"><span class="error"> <?php echo $usernameError ?></span>
                <input type="file" name="profile_pic" id="profile_pic"><span class="error"> <?php echo $profile_picError ?> </span>
                <input type="email" name="email" maxlength="50" placeholder="Email *" class="email" value="<?php echo $email; ?>"><span class="error"> <?php echo $emailError ?> </span>
                <input type="tel" name="mobile_num" maxlength="10" placeholder="Mobile number *" class="mobile_num" value="<?php echo $mobile_num; ?>"><span class="error"> <?php echo $mobile_numError ?> </span>
                <input type="date" name="birth_date" maxlength="10" placeholder="YYYY-MM-DD *" class="birth_date" value="<?php echo $birth_date; ?>"><span class="error"> <?php echo $birth_dateError ?> </span>
                <select name="select" id="role" value="<?=$role; ?>">
                    <option value="user" name="user">User</option>
                    <option value="manager" name="manager">Manager</option>
                    <option value="admin" name="admin">Admin</option>
                </select>
            </div>
            <div class="btn">
                <input type="submit" value="Update" name="update" class="signup">
            </div>
        </div>  
    </form>
</div>