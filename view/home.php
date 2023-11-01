<?php 
    require "header.php"; 
    if (isset($_GET['error'])) {
        echo "<h1><center>". $_GET['error'] ."</h1></center>";
    }
?>
<div class="container-fluid h5 my-0">
    <div class="row offset-2">
        <div class="col-sm-12">
            <form action="" method="post">
                <!--logout button-->
                <div class="my-5 ">
                    <input type="submit" value="Logout" name="logout" class="btn btn-secondary">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">            
            <!--sorting-->
            <form action="" method="post">                
                <div class="offset-4">
                    <div class="form-group col-sm-4 my-3">
                        <label for="select">Sort by</label>
                        <select name="select" id="select" class="form-control">
                            <option value="ID" name="ID">ID</option>
                            <option value="Username" name="Username">Username</option>
                            <option value="Email" name="Email">Email</option>
                            <option value="Birthdate" name="Birthdate">Birthdate</option>
                            <option value="Role" name="Role">Role</option>
                        </select> 
                    </div> 
                    <div class="form-group col-sm-4">
                        <div class="my-3">Order of sorting: </div>
                        <label for="asc"> Ascending </label> <input type="radio" name="sort" value="ASC" id="asc" checked> 
                        <label for="desc"> Descanding </label> <input type="radio" name="sort" value="DESC" id="desc" >
                    </div>
                    <div class="col-sm-8">
                        <input type="submit" value="Sort" name="sort_btn" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <!--searching-->
            <form action="" method="post">               
                <div class="form-group col-sm-4 my-3">
                    <label for="select">Search here</label>
                    <input type="text" name="search" class="form-control" id="search">
                </div>
                <div class="col-sm-8">
                    <input type="submit" name="search_btn" value="Search" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!--main data-->
            <form action="" method="post">
                <div class="main my-5">
                    <div class="inner-main">
                        <?php  
                            if ($_GET['role'] === "admin") { ?>
                            <div class="checkbox"></div>
                        <?php } ?>
                        <div class="id">ID</div>
                        <div class="username">Username</div>
                        <?php  
                            if ($_GET['role'] === "admin") { ?>
                            <div class="profile_pic">Profile-Picture</div>
                            <div class="profile_pic">Download-Picture</div>
                        <?php } ?>
                        <div class="email_data">Email</div>
                        <div class="birth_date_data">Birthdate</div>
                        <div class="role">Role</div>
                        <?php  
                            if ($_GET['role'] === "admin") { ?>
                                <div class="edit"></div>
                        <?php } ?>
                    </div>
                    <?php while ($row = $result -> fetch_assoc()) { ?>
                        <div class="inner-main">
                        <?php  
                            if ($_GET['role'] === "admin") { ?>
                            <div class="checkbox"><input type="checkbox" name="checkbox[]" value="<?=$row["ID"] ?>"></div>
                        <?php } ?>
                            <div class="id"><?=$row["ID"] ?></div>
                            <div class="username"><?=$row["Username"] ?></div>
                        <?php  
                        if ($_GET['role'] === "admin") { ?>
                            <div class="profile_pic"><a href="http://localhost/curd/?page=home&action=profile_pic&id=<?=$row["ID"] ?>" name="picture">View Image</a></div>
                            <div class="download_pic"><a href="http://localhost/curd/?page=home&action=download_pic&id=<?=$row["ID"] ?>" name="picture_download">Download Image</a></div>
                        <?php } ?>
                            <div class="email_data"><?=$row["Email"] ?></div>
                            <div class="birth_date_data"><?=$row["Birthdate"] ?></div>
                            <div class="role"><?=$row["Role"] ?></div>
                        <?php  
                            if ($_GET['role'] === "admin") { ?>
                            <div class="edit"><button type="submit" value="<?= $row["ID"] ?>" name="edit">Edit</button></div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </form>
            
            <!--pagination-->
            <form action="" method="post" class="my-3 offset-2">
                <div class="page">
                    <span class="txt"> page : </span><select name="select_page" id="select" class="select">
                                                        <option value=5>5</option>
                                                        <option value=10>10</option>
                                                        <option value=100>all</option>
                                                    </select>
                    <span class="txt"> Enter page number : </span> <input type="number" name="page" id="page" value=1> <input type="submit" value="Submit" name="page_btn"> <br><br>
                </div>
            </form>
        <?php if ($_GET['role'] === "admin") { ?>
            <form action="" method="post" class="my-5 offset-2">
                <div>
                    <span class="display-5">Select checkbox to delete record </span> <input type="submit" name="delete" value="Delete record" class="btn btn-danger">
                </div>        
            </form>
        <?php } ?>
        </div>
    </div>    
</div>
<?php require_once 'footer.php';