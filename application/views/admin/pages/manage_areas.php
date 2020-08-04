
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Area</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Seats/addArea" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['area_add_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['area_add_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['area_add_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['area_add_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Area Title</label>
                            <input type="text" name="area_title_field" id="area_title_field" class="form-control" placeholder="enter area title" value="<?php echo set_value('area_title_field'); ?>">
                            <?php echo form_error('area_title_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label >Area Image</label>
                                    <input type="file" name="area_image_field" id="area_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_add_area(event)" required>
                                </div>
                                <div class="col-md-5">
                                    <img src="" id="output_image_add_area"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="area_add_btn" id="area_add_btn" class="btn btn-primary">Add Area</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Areas</h3>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_SESSION['area_disable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['area_disable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['area_disable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['area_disable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['area_enable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['area_enable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['area_enable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['area_enable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['area_edit_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['area_edit_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['area_edit_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['area_edit_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Image</th>
                                <th>Area Title</th>
                                <th>Area Seat Types</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if(!empty($all_areas_data) && sizeof($all_areas_data) > 0){
                                    $no=0;
                                    foreach ($all_areas_data as $area) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a  data-toggle="modal" id="<?php echo $area->id; ?>" base_url="<?php echo base_url(); ?>" class="editArea text-success">
                                                    <label class="text-primary" id="<?php echo $area->id.'area_edit_link'; ?>">Edit</label>
                                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $area->id.'area_edit_waiting'; ?>"></i>
                                                </a>
                                                /
                                                <?php 
                                                    if($area->area_status=='Active'){
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Seats/disableArea/'.$area->id; ?>" onclick="return confirm(' If you disable a area, seats types and seats associated to this area would not be shown on app. Are you sure to disable this Area?')">
                                                            <label class="text-danger">Disable</label>
                                                        </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Seats/enableArea/'.$area->id; ?>"onclick="return confirm('Are you sure to enable this Area?')">
                                                            <label class="text-success">Enable</label>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url().'uploads/'.$area->area_image;?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                            </td>
                                            <td><?php echo $area->area_title; ?></td>
                                            <td>
                                                <div style=" height: 70px; overflow: auto;">
                                                    <?php 
                                                        if(!empty($area_seat_types_data) && sizeof($area_seat_types_data) > 0){
                                                            foreach ($area_seat_types_data as $seat_type) {
                                                                if($seat_type->area_id == $area->id){
                                                    ?>
                                                                    <?php echo $seat_type->seat_type_title; ?> <label class="text-danger"> <strong> | </strong> </label>   
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($area->area_status=='Active'){
                                                ?>
                                                        <label class="text-success"><?php echo $area->area_status; ?></label>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <label class="text-danger"><?php echo $area->area_status; ?></label>
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

    <div class="modal fade" id="editAreaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Area</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editAreaForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Area Title</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="area_title_edit_field" id="area_title_edit_field" class="form-control" placeholder="enter area title" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label >Area Image</label>
                                        <input type="hidden" id="area_old_pic_field" name="area_old_pic_field">
                                        <input type="file" name="area_edit_image_field" id="area_edit_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_edit_area(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="" id="output_image_edit_area"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="area_edit_btn" id="area_edit_btn" class="btn btn-primary" value="Update Area">
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>

<!-- Edit Item Modal ends here -->