<?php require_once "header.php"; ?>
<div class="container h5">
    <div class="row my-5 text-center">
        <div class="col-sm-12">
            <div class="display-4">
                Signup
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-2">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group col-sm-8 mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" name="username" maxlength="25" class="form-control" id="username" value="<?php echo $username ?>"><span class="error"> <?php echo $usernameError ?></span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="profile_picture" class="form-label">Profile Picture</label>
                  <input type="file" name="profile_pic" class="form-control" id="profile_picture"><span class="error"> <?php echo $profile_picError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" maxlength="50" class="form-control" id="email" value="<?php echo $email; ?>"><span class="error"> <?php echo $emailError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="birth_date" class="form-label">Birth Date</label>
                  <input type="date" name="birth_date" maxlength="10" class="form-control" id="birth_date" value="<?php echo $birth_date; ?>"><span class="error"> <?php echo $birth_dateError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" maxlength="20" class="form-control" id="password" value="<?php echo $password ?>"><span class="error"> <?php echo $passwordError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="re_password" class="form-label">Re-enter Password</label>
                  <input type="password" name="re_password" maxlength="20" class="form-control" id="re_password" value="<?php echo $re_password ?>"><span class="error"> <?php echo $re_passwordError ?> </span>
                </div>
                <div class="txt col-sm-8 text-center">
                    <a href="http://localhost/curd/?page=login" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login</a> if already hava an account
                </div>
                <div class="col-sm-8 text-center">
                    <button type="submit" name="signup" class="btn btn-primary my-5">Signup</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php require_once 'footer.php';