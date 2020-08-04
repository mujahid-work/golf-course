
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Seat</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Seats/addSeat" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['seat_add_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['seat_add_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['seat_add_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['seat_add_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Seat No</label>
                            <input type="text" name="seat_no_field" id="seat_no_field" class="form-control" placeholder="enter seat no" value="<?php echo set_value('seat_no_field'); ?>">
                            <?php echo form_error('seat_no_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label >Area</label>
                            <select class="form-control" name="area_field" id="area_field">
                                <option value="">select an area</option>
                                <?php
                                    if(!empty($all_active_areas_data)){
                                        foreach ($all_active_areas_data as $area) {
                                ?>
                                            <option value="<?php echo $area->id; ?>" <?php if(set_value('area_field') == $area->id){echo 'selected';} ?>>
                                                <?php echo $area->area_title; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <?php echo form_error('area_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label >Seat Type</label>
                            <select class="form-control" name="seat_type_field" id="seat_type_field">
                                <option value="">select a seat type</option>
                                <?php
                                    if(!empty($all_active_seat_types_data)){
                                        foreach ($all_active_seat_types_data as $seat_type) {
                                ?>
                                            <option value="<?php echo $seat_type->id; ?>" <?php if(set_value('seat_type_field') == $seat_type->id){echo 'selected';} ?>>
                                                <?php echo $seat_type->seat_type_title; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <?php echo form_error('seat_type_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="seat_add_btn" id="seat_add_btn" class="btn btn-primary">Add Seat</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Seats</h3>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_SESSION['seat_del_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['seat_del_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_del_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['seat_del_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_edit_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['seat_edit_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['seat_edit_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['seat_edit_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Seat No</th>
                                <th>Seat Area</th>
                                <th>Seat Type</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if(!empty($all_seats_data) && sizeof($all_seats_data) > 0){
                                    $no=0;
                                    foreach ($all_seats_data as $seat) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a  data-toggle="modal" id="<?php echo $seat->id; ?>" base_url="<?php echo base_url(); ?>" class="editSeat text-success">
                                                    <label class="text-primary" id="<?php echo $seat->id.'seat_edit_link'; ?>">Edit</label>
                                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $seat->id.'seat_edit_waiting'; ?>"></i>
                                                </a>
                                                /
                                                <a href="<?php echo base_url().'admin/Seats/deleteSeat/'.$seat->id; ?>" onclick="return confirm('Are you sure to delete this Seat?')">
                                                    <label class="text-danger">Delete</label>
                                                </a>
                                            </td>
                                            <td><?php echo $seat->seat_no; ?></td>
                                            <td><?php echo $seat->area_title; ?></td>
                                            <td><?php echo $seat->seat_type_title; ?></td>
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

    <div class="modal fade" id="editSeatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Seat</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editSeatForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Seat No</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="seat_no_edit_field" id="seat_no_edit_field" class="form-control" placeholder="enter seat no" required>
                            </div>
                            <div class="form-group">
                                <label >Area</label>
                                <select class="form-control" name="area_edit_field" id="area_edit_field">
                                    <option value="">select an area</option>
                                    <?php
                                        if(!empty($all_active_areas_data)){
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
                            <div class="form-group">
                                <label >Seat Type</label>
                                <select class="form-control" name="seat_type_edit_field" id="seat_type_edit_field">
                                    <option value="">select a seat type</option>
                                    <?php
                                        if(!empty($all_active_seat_types_data)){
                                            foreach ($all_active_seat_types_data as $seat_type) {
                                    ?>
                                                <option value="<?php echo $seat_type->id; ?>">
                                                    <?php echo $seat_type->seat_type_title; ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="seat_edit_btn" id="seat_edit_btn" class="btn btn-primary" value="Update Seat">
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>

<!-- Edit Item Modal ends here -->