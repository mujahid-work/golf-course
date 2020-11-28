<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Event</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url() ?>admin/events/addEvent" method="POST">
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['event_add_err'])) {
                        ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['event_add_err'] ?></div>
                        <?php
                        }
                        ?>

                        <?php
                        if (isset($_SESSION['event_add_succ'])) {
                        ?>
                            <div class="alert alert-success"><?php echo $_SESSION['event_add_succ'] ?></div>
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" name="event_title_field" id="event_title_field" class="form-control" placeholder="enter event title" value="<?php echo set_value('event_title_field'); ?>">
                            <?php echo form_error('event_title_field', '<p class="text-danger mt-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea name="event_description_field" id="event_description_field" class="form-control" placeholder="enter event description"><?php echo set_value('event_description_field'); ?></textarea>
                            <?php echo form_error('event_description_field', '<p class="text-danger mt-2">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Event Date</label>
                            <input type="date" name="event_date_field" id="event_date_field" class="form-control" value="<?php echo set_value('event_date_field'); ?>">
                            <?php echo form_error('event_date_field', '<p class="text-danger mt-2">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Event Status</label>
                            <select class="form-control" name="event_status_field" id="event_status_field">
                                <option value="">select a status</option>
                                <option value="Active" <?php if (set_value('event_status_field') == 'Active') {
                                                            echo 'selected';
                                                        } ?>>Active</option>
                                <option value="In-Active" <?php if (set_value('event_status_field') == 'In-Active') {
                                                                echo 'selected';
                                                            } ?>>In-Active</option>
                            </select>
                            <?php echo form_error('event_status_field', '<p class="text-danger mt-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label>Event Image</label>
                                    <input type="file" name="event_image_field" id="event_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_add_event(event)" required>
                                </div>
                                <div class="col-md-5">
                                    <img src="" id="output_image_add_event" onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="event_add_btn" id="event_add_btn" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Events</h3>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_SESSION['event_enable_err'])) {
                    ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['event_enable_err'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['event_enable_succ'])) {
                    ?>
                        <div class="alert alert-success"><?php echo $_SESSION['event_enable_succ'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['event_disable_err'])) {
                    ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['event_disable_err'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['event_disable_succ'])) {
                    ?>
                        <div class="alert alert-success"><?php echo $_SESSION['event_disable_succ'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['event_edit_err'])) {
                    ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['event_edit_err'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['event_edit_succ'])) {
                    ?>
                        <div class="alert alert-success"><?php echo $_SESSION['event_edit_succ'] ?></div>
                    <?php
                    }
                    ?>

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Event Date</th>
                                <th>Status</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (!empty($all_events_data) && sizeof($all_events_data) > 0) {
                                $no = 0;
                                foreach ($all_events_data as $event) {
                                    $no++;
                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>
                                            <a data-toggle="modal" id="<?php echo $event->id; ?>" base_url="<?php echo base_url(); ?>" class="editEvent text-success">
                                                <label class="text-primary" id="<?php echo $event->id . 'event_edit_link'; ?>">Edit</label>
                                                <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $event->id . 'event_edit_waiting'; ?>"></i>
                                            </a>
                                            /
                                            <?php
                                            if ($event->event_status == 'Active') {
                                            ?>
                                                <a href="<?php echo base_url() . 'admin/events/disableEvent/' . $event->id; ?>" onclick="return confirm('Are you sure to disable this Event?')">
                                                    <label class="text-danger">Disable</label>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo base_url() . 'admin/events/enableEvent/' . $event->id; ?>" onclick="return confirm('Are you sure to enable this Event?')">
                                                    <label class="text-success">Enable</label>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <img src="<?php echo base_url() . 'uploads/' . $event->event_image; ?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                        </td>
                                        <td><?php echo $event->event_title; ?></td>
                                        <td><?php echo $event->event_date; ?></td>
                                        <td>
                                            <?php
                                            if ($event->event_status == 'Active') {
                                            ?>
                                                <label class="text-success"><?php echo $event->event_status; ?></label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="text-danger"><?php echo $event->event_status; ?></label>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $event->event_description; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal starts here -->

<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Event</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editEventForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Event Title</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="event_edit_title_field" id="event_edit_title_field" class="form-control" placeholder="enter event title" required>
                            </div>
                            <div class="form-group">
                                <label>Event Description</label>
                                <textarea name="event_edit_description_field" id="event_edit_description_field" class="form-control" placeholder="enter event description"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Event Date</label>
                                <input type="date" name="event_edit_date_field" id="event_edit_date_field" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Event Status</label>
                                <select class="form-control" name="event_edit_status_field" id="event_edit_status_field" required>
                                    <option value="">select a status</option>
                                    <option value="Active">Active</option>
                                    <option value="In-Active">In-Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Event Image</label>
                                        <input type="hidden" id="event_old_pic_field" name="event_old_pic_field">
                                        <input type="file" name="event_edit_image_field" id="event_edit_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_edit_event(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="" id="output_image_edit_event" onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="event_edit_btn" id="event_edit_btn" class="btn btn-primary" value="Update Event">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal ends here -->