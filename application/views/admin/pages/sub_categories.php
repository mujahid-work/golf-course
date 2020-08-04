
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Sub-Category</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Categories/addSubCategory" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['sub_catg_add_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['sub_catg_add_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['sub_catg_add_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['sub_catg_add_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Sub-Category Title</label>
                            <input type="text" name="sub_catg_title_field" id="sub_catg_title_field" class="form-control" placeholder="enter sub-category title" value="<?php echo set_value('sub_catg_title_field'); ?>">
                            <?php echo form_error('sub_catg_title_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label >Main Category</label>
                            <select class="form-control" name="main_catg_field" id="main_catg_field">
                                <option value="">select main category</option>

                                <?php
                                    if(!empty($main_active_catgs_data) && sizeof($main_active_catgs_data) > 0){
                                        foreach ($main_active_catgs_data as $catg) {
                                ?>
                                            <option value="<?php echo $catg->id; ?>" <?php if(set_value('main_catg_field') == $catg->id ){echo 'selected';} ?>>
                                                <?php echo $catg->main_catg_title; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>

                            </select>
                            <?php echo form_error('main_catg_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label >Sub-Category Status</label>
                            <select class="form-control" name="sub_catg_status_field">
                                <option value="">select a status</option>
                                <option value="Active" <?php if(set_value('sub_catg_status_field') == 'Active'){echo 'selected';} ?>>Active</option>
                                <option value="In-Active" <?php if(set_value('sub_catg_status_field') == 'In-Active'){echo 'selected';} ?>>In-Active</option>
                            </select>
                            <?php echo form_error('sub_catg_status_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label >Sub-Category Image</label>
                                    <input type="file" name="sub_catg_image_field" id="sub_catg_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_add_sub_catg(event)" required>
                                </div>
                                <div class="col-md-5">
                                    <img src="" id="output_image_add_sub_catg"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="sub_catg_add_btn" class="btn btn-primary">Add Sub-Category</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sub Categories</h3>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_SESSION['sub_catg_enable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['sub_catg_enable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['sub_catg_enable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['sub_catg_enable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['sub_catg_disable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['sub_catg_disable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['sub_catg_disable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['sub_catg_disable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['sub_catg_edit_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['sub_catg_edit_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['sub_catg_edit_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['sub_catg_edit_succ'] ?></div>
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
                                <th>Parrent Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($sub_all_catgs_data) && sizeof($sub_all_catgs_data) > 0){
                                    $no=0;
                                    foreach ($sub_all_catgs_data as $catg) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a  data-toggle="modal" id="<?php echo $catg->id; ?>" base_url="<?php echo base_url(); ?>" class="editSubCatg text-success">
                                                    <label class="text-primary" id="<?php echo $catg->id.'sub_catg_edit_link'; ?>">Edit</label>
                                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $catg->id.'sub_catg_edit_waiting'; ?>"></i>
                                                </a>
                                                /
                                                <?php 
                                                    if($catg->sub_catg_status=='Active'){
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Categories/disableSubCategory/'.$catg->id; ?>" onclick="return confirm('Are you sure to disable this sub category?')">
                                                            <label class="text-danger">Disable</label>
                                                        </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Categories/enableSubCategory/'.$catg->id; ?>"onclick="return confirm('Are you sure to enable this sub category?')">
                                                            <label class="text-success">Enable</label>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url().'uploads/'.$catg->sub_catg_image;?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                            </td>
                                            <td><?php echo $catg->sub_catg_title; ?></td>
                                            <td>
                                                <?php 
                                                    if($catg->sub_catg_status=='Active'){
                                                ?>
                                                        <label class="text-success"><?php echo $catg->sub_catg_status; ?></label>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <label class="text-danger"><?php echo $catg->sub_catg_status; ?></label>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $catg->main_catg_title; ?> 
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

    <div class="modal fade" id="editSubCatgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Sub Category</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editSubCatgForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Sub Category Title</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="sub_catg_edit_title_field" id="sub_catg_edit_title_field" class="form-control" placeholder="enter sub category title" required>
                            </div>
                            <div class="form-group">
                                <label >Main Category</label>
                                <select class="form-control" name="main_catg_edit_field" id="main_catg_edit_field" required>
                                    <option value="">select main category</option>

                                    <?php
                                        if(!empty($main_active_catgs_data) && sizeof($main_active_catgs_data) > 0){
                                            foreach ($main_active_catgs_data as $catg) {
                                    ?>
                                                <option value="<?php echo $catg->id; ?>">
                                                    <?php echo $catg->main_catg_title; ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label >Sub Category Status</label>
                                <select class="form-control" name="sub_catg_edit_status_field" id="sub_catg_edit_status_field" required>
                                    <option value="">select a status</option>
                                    <option value="Active">Active</option>
                                    <option value="In-Active">In-Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label >Sub Category Image</label>
                                        <input type="hidden" id="sub_catg_old_pic_field" name="sub_catg_old_pic_field">
                                        <input type="file" name="sub_catg_edit_image_field" id="sub_catg_edit_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_edit_sub_catg(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="" id="output_image_edit_sub_catg"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="sub_catg_edit_btn" id="sub_catg_edit_btn" class="btn btn-primary" value="Update Sub Category">
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>

<!-- Edit Main Category Modal ends here -->