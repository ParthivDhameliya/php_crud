<?php require_once "header.php"; ?>
<div class="container">
    <form action="" method="POST" class="form">
        <div class="box">
            <div class="head">Login Form</div>
            <div class="input">
                <input type="text" name="username" maxlength="25" placeholder="Username *" class="user" value="<?php echo $username ?>"> <span class="error"> <?php echo $usernameError ?></span>
                <input type="password" name="password" maxlength="20" placeholder="Password *" class="pass" value="<?php echo $password ?>"> <span class="error"> <?php echo $passwordError ?> </span>
            </div>
            <span class="txt"><a href="http://localhost/mvc/project/?page=signup" class="a_register">Register here</a> if account doesn't exists</span>
            <div class="btn">
                <button type="submit" value="Login" name="login" class="login">Login</button>
            </div>
        </div>  
    </form>
</div>