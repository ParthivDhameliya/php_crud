<?php require_once "header.php"; ?>
<div class="container h5">
    <div class="row my-5 text-center">
        <div class="col-sm-12">
            <div class="display-4">
                Event update form
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-2">
            <form action="" method="POST">
                <div class="form-group col-sm-8 mb-3">
                  <label for="eventname" class="form-label">Event name</label>
                  <input type="text" name="eventname" maxlength="25" class="form-control" id="eventname" value="<?php echo $eventname ?>"><span class="error"> <?php echo $eventnameError ?></span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="event_desc" class="form-label">Event Description</label>
                  <input type="textarea" name="event_desc" maxlength="200" class="form-control" id="event_desc" value="<?php echo $event_desc ?>"><span class="error"> <?php echo $event_descError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="event_city" class="form-label">Event City</label>
                  <input type="text" name="event_city" maxlength="50" class="form-control" id="event_city" value="<?php echo $event_city; ?>"><span class="error"> <?php echo $event_cityError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="event_date" class="form-label">Event Date</label>
                  <input type="date" name="event_date" maxlength="20" class="form-control" id="event_date" value="<?php echo $event_date; ?>"><span class="error"> <?php echo $event_dateError ?> </span>
                </div>
                <div class="form-group col-sm-8 mb-3">
                  <label for="ticket_price" class="form-label">Ticket Price</label>
                  <input type="number" name="ticket_price" maxlength="50" class="form-control" id="ticket_price" value="<?php echo $ticket_price; ?>"><span class="error"> <?php echo $ticket_priceError ?> </span>
                </div>
                <div class="col-sm-8 text-center">
                    <button type="submit" name="cancel_event" class="btn btn-secondary my-5">Cancel</button>
                    <button type="submit" name="create_event" class="btn btn-primary my-5">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?php require_once 'footer.php';