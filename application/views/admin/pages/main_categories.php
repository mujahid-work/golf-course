
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Main Category</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Categories/addMainCategory" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['main_catg_add_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['main_catg_add_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['main_catg_add_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['main_catg_add_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Main Category Title</label>
                            <input type="text" name="main_catg_title_field" id="main_catg_title_field" class="form-control" placeholder="enter main category title" value="<?php echo set_value('main_catg_title_field'); ?>">
                            <?php echo form_error('main_catg_title_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label >Main Category Status</label>
                            <select class="form-control" name="main_catg_status_field" id="main_catg_status_field">
                                <option value="">select a status</option>
                                <option value="Active" <?php if(set_value('main_catg_status_field') == 'Active'){echo 'selected';} ?>>Active</option>
                                <option value="In-Active" <?php if(set_value('main_catg_status_field') == 'In-Active'){echo 'selected';} ?>>In-Active</option>
                            </select>
                            <?php echo form_error('main_catg_status_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label >Main Category Image</label>
                                    <input type="file" name="main_catg_image_field" id="main_catg_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_add_main_catg(event)" required>
                                </div>
                                <div class="col-md-5">
                                    <img src="" id="output_image_add_main_catg"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                </div>
                            </div>
                            <?php echo form_error('main_catg_image_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <input type="submit" name="main_catg_add_btn" id="main_catg_add_btn" class="btn btn-primary" value="Add Main Category">
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Main Categories</h3>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_SESSION['main_catg_enable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['main_catg_enable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['main_catg_enable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['main_catg_enable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['main_catg_disable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['main_catg_disable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['main_catg_disable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['main_catg_disable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['main_catg_edit_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['main_catg_edit_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['main_catg_edit_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['main_catg_edit_succ'] ?></div>
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
                                <th>Status</th>
                                <th>Child Categories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($main_all_catgs_data) && sizeof($main_all_catgs_data) > 0){
                                    $no=0;
                                    foreach ($main_all_catgs_data as $catg) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a  data-toggle="modal" id="<?php echo $catg->id; ?>" base_url="<?php echo base_url(); ?>" class="editMainCatg text-success">
                                                    <label class="text-primary" id="<?php echo $catg->id.'main_catg_edit_link'; ?>">Edit</label>
                                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $catg->id.'main_catg_edit_waiting'; ?>"></i>
                                                </a>
                                                /
                                                <?php 
                                                    if($catg->main_catg_status=='Active'){
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Categories/disableMainCategory/'.$catg->id; ?>" onclick="return confirm('Are you sure to disable this main category?')">
                                                            <label class="text-danger">Disable</label>
                                                        </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Categories/enableMainCategory/'.$catg->id; ?>"onclick="return confirm('Are you sure to enable this main category?')">
                                                            <label class="text-success">Enable</label>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                            <img src="<?php echo base_url().'uploads/'.$catg->main_catg_image;?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                            </td>
                                            <td><?php echo $catg->main_catg_title; ?></td>
                                            <td>
                                                <?php 
                                                    if($catg->main_catg_status=='Active'){
                                                ?>
                                                        <label class="text-success"><?php echo $catg->main_catg_status; ?></label>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <label class="text-danger"><?php echo $catg->main_catg_status; ?></label>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <div style=" height: 70px; overflow: auto;">
                                                    <?php 
                                                        if(!empty($sub_active_catgs_data) && sizeof($sub_active_catgs_data) > 0){
                                                            foreach ($sub_active_catgs_data as $sub_catg) {
                                                                if($sub_catg->main_catg_id == $catg->id){
                                                    ?>
                                                                    <?php echo $sub_catg->sub_catg_title; ?> <label class="text-danger"> <strong> | </strong> </label>   
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </div>
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


<!-- Edit Main Category Modal starts here -->

    <div class="modal fade" id="editMainCatgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Main Category</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editMainCatgForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Main Category Title</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="main_catg_edit_title_field" id="main_catg_edit_title_field" class="form-control" placeholder="enter main category title" required>
                            </div>
                            <div class="form-group">
                                <label >Main Category Status</label>
                                <select class="form-control" name="main_catg_edit_status_field" id="main_catg_edit_status_field" required>
                                    <option value="">select a status</option>
                                    <option value="Active">Active</option>
                                    <option value="In-Active">In-Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label >Main Category Image</label>
                                        <input type="hidden" id="main_catg_old_pic_field" name="main_catg_old_pic_field">
                                        <input type="file" name="main_catg_edit_image_field" id="main_catg_edit_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_edit_main_catg(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="" id="output_image_edit_main_catg"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="main_catg_edit_btn" id="main_catg_edit_btn" class="btn btn-primary" value="Update Main Category">
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>

<!-- Edit Main Category Modal ends here -->