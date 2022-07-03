<?php 
    require_once "header.php"; 
    if (isset($_GET['error'])) {
        echo "<h1><center>". $_GET['error'] ."</h1></center>";
    }
?>
<form action="" method="post">
    <div class="logout_div">
        <input type="submit" value="Logout" name="logout" class="logout_btn">
    </div>
    <div class="sort">
        <span class= "txt"> Sort by </span>:<select name="select" id="select">
                                                <option value="ID" name="ID">ID</option>
                                                <option value="Username" name="Username">Username</option>
                                                <option value="Email" name="Email">Email</option>
                                                <option value="Birthdate" name="Birthdate">Birthdate</option>
                                                <option value="Role" name="Role">Role</option>
                                            </select> 
        <span class= "txt"> Order of sorting </span>: <span class= "txt"> Ascending </span> <input type="radio" name="sort" value="ASC" checked>
                                                    <span class= "txt"> Descanding </span> <input type="radio" name="sort" value="DESC">
        <input type="submit" value="Submit" name="sort_btn">
    </div> <br><br>
    <div class="search">
        <span class="txt">Search here </span> <input type="text" name="search" id="search">
        <input type="submit" name="search_btn" value="search">
    </div>
    <div class="main">
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
            <div class="phone_num">Phonenumber</div>
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
                <div class="profile_pic"><a href="http://localhost/mvc/project/?page=home&action=profile_pic&id=<?=$row["ID"] ?>" name="picture">View Image</a></div>
                <div class="download_pic"><a href="http://localhost/mvc/project/?page=home&action=download_pic&id=<?=$row["ID"] ?>" name="picture_download">Download Image</a></div>
            <?php } ?>
                <div class="email_data"><?=$row["Email"] ?></div>
                <div class="phone_num"><?=$row["Phonenumber"] ?></div>
                <div class="birth_date_data"><?=$row["Birthdate"] ?></div>
                <div class="role"><?=$row["Role"] ?></div>
            <?php  
                if ($_GET['role'] === "admin") { ?>
                <div class="edit"><button type="submit" value="<?= $row["ID"] ?>" name="edit">Edit</button></div>
            <?php } ?>
            </div>
        <?php } ?>
    </div> <br><br>
    <div class="page">
        <span class="txt"> page : </span><select name="select_page" id="select" class="select">
                                            <option value=5>5</option>
                                            <option value=10>10</option>
                                            <option value=100>all</option>
                                        </select>
        <span class="txt"> Enter page number : </span> <input type="number" name="page" id="page" value=1> <input type="submit" value="Submit" name="page_btn"> <br><br>
    </div>
    <?php  
            if ($_GET['role'] === "admin") { ?>
    <div class="delete">
        <span class="txt">Select checkbox to delete record </span> <input type="submit" name="delete" value="Delete record">
    </div>        
    <?php } ?>
</form>