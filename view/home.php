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
                        <label for="select" class="form-label">Sort by</label>
                        <select name="select" id="select" class="form-control">
                            <?php 
                                $content = $_SESSION['content'];
                                if (($_SESSION['role'] === "admin" || $_SESSION['role'] === "manager") && $content === "people_list") { ?>
                                    <option value="ID" name="ID">ID</option>
                                    <option value="Username" name="Username">Username</option>
                                    <option value="Email" name="Email">Email</option>
                                    <option value="Birthdate" name="Birthdate">Birthdate</option>
                                    <option value="Role" name="Role">Role</option>
                            <?php } 
                                if (($_SESSION['role'] === "admin" || $_SESSION['role'] === "manager") && $content === "events_by_people") { ?>
                                    <option value="ID" name="ID">Id</option>
                                    <option value="Username" name="Username">Username</option>
                                    <option value="Email" name="Email">Email</option>
                                    <option value="Role" name="Role">Role</option>
                                    <option value="Birthdate" name="Birthdate">Birth date</option>
                                    <option value="Total_events" name="Total_events">Total events</option>
                            <?php }
                                if (($_SESSION['role'] === "admin" || $_SESSION['role'] === "manager") && $content === "events_list") { ?>
                                    <option value="event_id" name="event_id">Event id</option>
                                    <option value="event_name" name="event_name">Event name</option>
                                    <option value="event_desc" name="event_desc">Event description</option>
                                    <option value="event_city" name="event_city">Event city</option>
                                    <option value="event_date" name="event_date">Event date</option>
                                    <option value="ticket_price" name="ticket_price">Ticket price</option>
                                    <option value="Username" name="Username">User name</option>
                                    <option value="Role" name="Role">Role</option>                                    
                            <?php }                            
                                if($_SESSION['role'] === "user") { ?> 
                                    <option value="event_id" name="event_id">Event id</option>
                                    <option value="event_name" name="event_name">Event name</option>
                                    <option value="event_city" name="event_city">Event city</option>
                                    <option value="event_date" name="event_date">Event date</option>
                                    <option value="ticket_price" name="ticket_price">Ticket price</option>
                                
                            <?php } ?>
                        </select> 
                    </div> 
                    <div class="form-group col-sm-4 mb-3">
                        <div class="my-3">Order of sorting: </div>
                        <label for="asc" class="form-label"> Ascending </label> <input type="radio" name="sort" value="ASC" id="asc" checked> 
                        <label for="desc" class="form-label"> Descanding </label> <input type="radio" name="sort" value="DESC" id="desc" >
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
                    <label for="select" class="form-label">Search here</label>
                    <input type="text" name="search" class="form-control" id="search">
                </div>
                <div class="col-sm-8">
                    <input type="submit" name="search_btn" id="search_btn" value="Search" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" id="content">
            <?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager") { ?>
            <!--main data-->
            <form action="" method="post">
                <div class="form-group col-sm-8 offset-2 mt-5 h3">
                    <label for="content">What do you want to see:</label><br>
                    People list: <input type="radio" name="content" id="content" value="people_list" <?php echo ($_SESSION['content'] === "people_list" || !isset($_SESSION['content'])) ? "checked" : "" ?>><br>
                    Events list: <input type="radio" name="content" id="content" value="events_list" <?php echo ($_SESSION['content'] === "events_list") ? "checked" : "" ?>><br>
                    Events organized by people: <input type="radio" name="content" id="content" value="events_by_people" <?php echo ($_SESSION['content'] === "events_by_people") ? "checked" : "" ?>><br>
                    <button type="submit" class="btn btn-secondary my-3" name="content_submit">View</button>                    
                </div>
                <?php if($_SESSION['content'] === "people_list" || !isset($_SESSION['content'])) { 
                        if(mysqli_num_rows($result) > 0) { ?>
                    <div class="main my-5">
                            <div class="inner-main">
                                <div class="id">ID</div>
                                <div class="username">Username</div>
                                <div class="profile_pic">Profile-Picture</div>
                                <div class="download_pic">Download-Picture</div>
                                <div class="email_data">Email</div>
                                <div class="birth_date_data">Birthdate</div>
                                <div class="role">Role</div>
                                <div class="edit"></div>
                                <div class="delete"></div>
                            </div>
                         
                        <?php while ($row = $result -> fetch_assoc()) { 
                            if($row['Username'] !== "admin" || $_SESSION['username'] == 'admin') { ?>
                            <div class="inner-main">
                                <div class="id"><?=$row["ID"] ?></div>
                                <div class="username"><?=$row["Username"] ?></div>
                                <div class="profile_pic"><a href="http://localhost/curd/?page=home&action=profile_pic&id=<?=$row["ID"] ?>" name="picture">View Image</a></div>
                                <div class="download_pic"><a href="http://localhost/curd/?page=home&action=download_pic&id=<?=$row["ID"] ?>" name="picture_download">Download Image</a></div>
                                <div class="email_data"><?=$row["Email"] ?></div>
                                <div class="birth_date_data"><?=$row["Birthdate"] ?></div>
                                <div class="role"><?=$row["Role"] ?></div>
                                <div class="edit"><button type="submit" class="btn btn-warning" value="<?= $row["ID"] ?>" name="edit">Edit</button></div>
                                <div class="delete"><button type="submit" class="btn btn-danger" value="<?= $row["ID"] ?>" name="delete" id="delete"">Delete</button></div>
                            </div>
                        <?php } 
                            }
                        } else { ?>
                            <div class="h3">No Data Available</div>
                        <?php } ?>
                    </div>
                <?php } elseif ($_SESSION['content'] === "events_by_people") { 
                            if(mysqli_num_rows($event_by_people_result) > 0) { ?>
                    <div class="main my-5">
                            <div class="inner-main">
                                <div class="id">ID</div>
                                <div class="username">Username</div>
                                <div class="email_data">Email</div>
                                <div class="role">Role</div>
                                <div class="birth_date_data">Birth date</div>
                                <div class="role">Total events</div>
                            </div>
                         
                        <?php while ($row = $event_by_people_result -> fetch_assoc()) { ?>
                            <div class="inner-main">
                                <div class="id"><?=$row["ID"] ?></div>
                                <div class="username"><?=$row["Username"] ?></div>
                                <div class="email_data"><?=$row["Email"] ?></div>
                                <div class="role"><?=$row['Role'] ?></div>
                                <div class="birth_date_data"><?=$row["Birthdate"] ?></div>
                                <div class="role"><?=$row["Total_events"] ?></div>
                            </div>
                        <?php } 
                            } else { ?>
                            <div class="h3">No Data Available</div>
                        <?php } ?>
                    </div>                    
                <?php } elseif ($_SESSION['content'] === "events_list") { 
                            if(mysqli_num_rows($events_list) > 0) { ?>
                    <div class="main my-5">
                            <div class="inner-main">
                                <div class="id">ID</div>
                                <div class="username">Event name</div>
                                <div class="email_data">Event_desc</div>
                                <div class="role">Event city</div>
                                <div class="birth_date_data">Event date</div>
                                <div class="role">Ticket price</div>
                                <div class="username">Username</div>
                                <div class="role">Role</div>
                            </div>
                         
                        <?php while ($row = $events_list -> fetch_assoc()) { ?>
                            <div class="inner-main">
                                <div class="id"><?=$row["event_id"] ?></div>
                                <div class="username"><?=$row["event_name"] ?></div>
                                <div class="email_data"><?=$row["event_desc"] ?></div>
                                <div class="role"><?=$row['event_city'] ?></div>
                                <div class="birth_date_data"><?=$row["event_date"] ?></div>
                                <div class="role"><?=$row["ticket_price"] ?></div>
                                <div class="username"><?=$row["Username"] ?></div>
                                <div class="role"><?=$row["Role"] ?></div>
                            </div>
                        <?php } 
                            } else { ?>
                            <div class="h3">No Data Available</div>
                        <?php } ?>
                    </div>  
            </form>
            <?php   } 
                } ?>

            <?php if ($_SESSION['role'] === "user") { ?>
                <form action="" method="post">
                    <button type="submit" class="btn btn-success offset-1 mt-5" name="event_add">Add Event</button>
            <?php if(mysqli_num_rows($event_result) > 0) { ?>
                <div class="main my-5"> 
                    <div class="inner-main">
                        <div class="id">ID</div>
                        <div class="username">Event name</div>
                        <div class="event_desc">Event description</div>
                        <div class="profile_pic">Event city</div>
                        <div class="profile_pic">Event date</div>
                        <div class="ticket_price">Ticket price</div>
                        <div class="birth_date_data">Date created</div>
                        <div class="edit"></div>
                        <div class="delete"></div>
                    </div>
                    <?php while ($event_row = $event_result -> fetch_assoc()) { ?>
                        <div class="inner-main">
                            <div class="id"><?=$event_row["event_id"] ?></div>
                            <div class="username"><?=$event_row["event_name"] ?></div>
                            <div class="event_desc"><?=$event_row["event_desc"] ?></div>
                            <div class="profile_pic"><?=$event_row["event_city"] ?></div>
                            <div class="profile_pic"><?=$event_row["event_date"] ?></div>
                            <div class="ticket_price"><?=$event_row["ticket_price"] ?></div>
                            <div class="birth_date_data"><?=$event_row["date_created"] ?></div>
                            <div class="edit"><button type="submit" class="btn btn-warning" value="<?= $event_row["event_id"] ?>" name="event_edit">Edit</button></div>
                            <div class="delete"><button type="submit" class="btn btn-danger" value="<?= $event_row["event_id"] ?>" name="event_delete" id="event_delete">Delete</button></div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="h3 offset-1 my-5">No Data Available</div>
            <?php } ?>
            </form>
            <?php } ?>
        </div>
    </div> 
</div>
<?php require_once 'footer.php'; 