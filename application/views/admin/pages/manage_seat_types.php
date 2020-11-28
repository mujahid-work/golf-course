
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Seat Type</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Seats/addSeatType" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['seat_type_add_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['seat_type_add_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['seat_type_add_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['seat_type_add_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Seat Type Title</label>
                            <input type="text" name="seat_type_title_field" id="seat_type_title_field" class="form-control" placeholder="enter seat type title" value="<?php echo set_value('seat_type_title_field'); ?>">
                            <?php echo form_error('seat_type_title_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label >Area</label>
                            <select class="form-control" name="area_field" id="area_field">
                                <option value="">select an area</option>

                                <?php
                                    if(!empty($all_active_areas_data) && sizeof($all_active_areas_data) > 0){
                                        foreach ($all_active_areas_data as $area) {
                                ?>
                                            <option value="<?php echo $area->id; ?>" <?php if(set_value('area_field') == $area->id ){echo 'selected';} ?>>
                                                <?php echo $area->area_title; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>

                            </select>
                            <?php echo form_error('area_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label >Seat Type Image</label>
                                    <input type="file" name="seat_type_image_field" id="seat_type_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_add_seat_type(event)" required>
                                </div>
                                <div class="col-md-5">
                                    <img src="" id="output_image_add_seat_type"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="seat_type_add_btn" id="seat_type_add_btn" class="btn btn-primary">Add Seat Type</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Seat Types</h3>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_SESSION['seat_type_disable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['seat_type_disable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_type_disable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['seat_type_disable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_type_enable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['seat_type_enable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_type_enable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['seat_type_enable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_type_edit_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['seat_type_edit_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_type_edit_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['seat_type_edit_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <!-- <th>Image</th> -->
                                <th>Seat Type Title</th>
                                <th>Seat Type Area</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if(!empty($all_seat_types_data) && sizeof($all_seat_types_data) > 0){
                                    $no=0;
                                    foreach ($all_seat_types_data as $seat_type) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a  data-toggle="modal" id="<?php echo $seat_type->id; ?>" base_url="<?php echo base_url(); ?>" class="editSeatType text-success">
                                                    <label class="text-primary" id="<?php echo $seat_type->id.'seat_type_edit_link'; ?>">Edit</label>
                                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $seat_type->id.'seat_type_edit_waiting'; ?>"></i>
                                                </a>
                                                /
                                                <?php 
                                                    if($seat_type->seat_type_status=='Active'){
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Seats/disableSeatType/'.$seat_type->id; ?>" onclick="return confirm(' If you disable a seat type, seats associated to this type would not be shown on app. Are you sure to disable this Seat Type?')">
                                                            <label class="text-danger">Disable</label>
                                                        </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Seats/enableSeatType/'.$seat_type->id; ?>"onclick="return confirm('Are you sure to enable this Seat Type?')">
                                                            <label class="text-success">Enable</label>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <!-- <td>
                                                <img src="<?php echo base_url().'uploads/'.$seat_type->seat_type_image;?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                            </td> -->
                                            <td><?php echo $seat_type->seat_type_title; ?></td>
                                            <td><?php echo $seat_type->area_title; ?></td>
                                            <td>
                                                <?php 
                                                    if($seat_type->seat_type_status=='Active'){
                                                ?>
                                                        <label class="text-success"><?php echo $seat_type->seat_type_status; ?></label>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <label class="text-danger"><?php echo $seat_type->seat_type_status; ?></label>
                                                <?php
                                                    }
                                                ?>
                                            </td>
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

    <div class="modal fade" id="editSeatTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Seat Type</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editSeatTypeForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Seat Type Title</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="seat_type_title_edit_field" id="seat_type_title_edit_field" class="form-control" placeholder="enter seat type title" required>
                            </div>
                            <div class="form-group">
                                <label >Area</label>
                                <select class="form-control" name="area_edit_field" id="area_edit_field" required>
                                    <option value="">select an area</option>

                                    <?php
                                        if(!empty($all_active_areas_data) && sizeof($all_active_areas_data) > 0){
                                            foreach ($all_active_areas_data as $area) {
                                    ?>
                                                <option value="<?php echo $area->id; ?>">
                                                    <?php echo $area->area_title; ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                    ?>

                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label >Seat Type Image</label>
                                        <input type="hidden" id="seat_type_old_pic_field" name="seat_type_old_pic_field">
                                        <input type="file" name="seat_type_edit_image_field" id="seat_type_edit_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_edit_seat_type(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="" id="output_image_edit_seat_type"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="seat_type_edit_btn" id="seat_type_edit_btn" class="btn btn-primary" value="Update Seat Type">
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>

<!-- Edit Item Modal ends here -->