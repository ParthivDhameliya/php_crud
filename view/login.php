<?php require_once "header.php"; ?>
<div class="container h5">
    <div class="row my-5 text-center">
        <div class="col-sm-12">
            <div class="display-4">
                Login
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-2">
            <form action="" method="POST" class="form">
                <div class="form-group col-sm-8 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" maxlength="25" class="user form-control" id="username" value="<?php echo $username ?>"><span class="error"> <?php echo $usernameError ?></span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" maxlength="20" class="pass form-control" id="password" value="<?php echo $password ?>"><span class="error"> <?php echo $passwordError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="role" class="form-label">Login As</label>
                  <select name="select" class="form-control" id="role" value="<?php echo $role; ?>">
                        <option value="user" name="user">User</option>
                        <option value="manager" name="manager">Manager</option>
                        <option value="admin" name="admin">Admin</option>
                  </select>
                </div>
                <div class="txt col-sm-8 text-center">
                    <a href="http://localhost/curd/?page=signup" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Register here</a> if account doesn't exists
                </div>
                <div class="col-sm-8 text-center">
                    <button type="submit" name="login" class="btn btn-primary my-5">Login</button>
                </div>
                <span class="txt"></span>
            </form>
        </div>
    </div>
</div> 
<?php require_once 'footer.php';