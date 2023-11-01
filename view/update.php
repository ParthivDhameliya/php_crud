<?php require_once "header.php"; ?>
<div class="container h5">
    <div class="row my-5 text-center">
        <div class="col-sm-12">
            <div class="display-4">
                Update Information
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-2">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group col-sm-8">
                  <label for="username">Username</label>
                  <input type="text" name="username" maxlength="25" class="form-control" id="username" value="<?php echo $username ?>"><span class="error"> <?php echo $usernameError ?></span>
                </div>
                <div class="form-group col-sm-8">
                  <label for="profile_picture">Profile Picture</label>
                  <input type="file" name="profile_pic" class="form-control" id="profile_picture"><span class="error"> <?php echo $profile_picError ?> </span>
                </div>
                <div class="form-group col-sm-8">
                  <label for="email">Email</label>
                  <input type="email" name="email" maxlength="50" class="form-control" id="email" value="<?php echo $email; ?>"><span class="error"> <?php echo $emailError ?> </span>
                </div>
                <div class="form-group col-sm-8">
                  <label for="birth_date">Birth Date</label>
                  <input type="date" name="birth_date" maxlength="10" class="form-control" id="birth_date" value="<?php echo $birth_date; ?>"><span class="error"> <?php echo $birth_dateError ?> </span>
                </div>
                <div class="form-group col-sm-8">
                  <label for="role">Role</label>
                  <select name="select" class="form-control" id="role" value="<?php echo $role; ?>">
                        <option value="user" name="user">User</option>
                        <option value="manager" name="manager">Manager</option>
                        <option value="admin" name="admin">Admin</option>
                  </select>
                </div>
                <div class="col-sm-8 text-center">
                    <button type="submit" name="update" class="btn btn-primary my-5">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php require_once 'footer.php';