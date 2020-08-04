
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Item</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Items/addItem" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['item_add_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['item_add_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['item_add_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['item_add_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Item Title</label>
                            <input type="text" name="item_title_field" id="item_title_field" class="form-control" placeholder="enter item title" value="<?php echo set_value('item_title_field'); ?>">
                            <?php echo form_error('item_title_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label >Main Category</label>
                            <select class="form-control" name="item_main_catg_field" id="item_main_catg_field">
                                <option value="">select main category</option>
                                <?php
                                    if(!empty($main_active_catgs_data) && sizeof($main_active_catgs_data) > 0){
                                        foreach ($main_active_catgs_data as $main_catg) {
                                ?>
                                            <option value="<?php echo $main_catg->id; ?>" <?php if(set_value('item_main_catg_field') == $main_catg->id ){echo 'selected';} ?>>
                                                <?php echo $main_catg->main_catg_title; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <?php echo form_error('item_main_catg_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label >Sub Category</label>
                            <select class="form-control" name="item_sub_catg_field" id="item_sub_catg_field">
                                <option value="">select sub category</option>
                                <?php
                                    if(!empty($sub_active_catgs_data) && sizeof($sub_active_catgs_data) > 0){
                                        foreach ($sub_active_catgs_data as $sub_catg) {
                                ?>
                                            <option value="<?php echo $sub_catg->id; ?>" <?php if(set_value('item_sub_catg_field') == $sub_catg->id ){echo 'selected';} ?>>
                                                <?php echo $sub_catg->sub_catg_title; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <?php echo form_error('item_sub_catg_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Item Description</label>
                            <textarea name="item_description_field" id="item_description_field" class="form-control" placeholder="enter item description"><?php echo set_value('item_description_field'); ?></textarea>
                            <?php echo form_error('item_description_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="number" name="item_price_field" id="item_price_field" class="form-control" placeholder="enter item price" value="<?php echo set_value('item_price_field'); ?>">
                            <?php echo form_error('item_price_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label >Availability</label>
                            <select class="form-control" name="item_availability_field" id="item_availability_field">
                                <option value="">select an option</option>
                                <option value="Yes" <?php if(set_value('item_availability_field') == 'Yes'){echo 'selected';} ?>>Yes</option>
                                <option value="No" <?php if(set_value('item_availability_field') == 'No'){echo 'selected';} ?>>No</option>
                            </select>
                            <?php echo form_error('item_availability_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label >Item Status</label>
                            <select class="form-control" name="item_status_field" id="item_status_field">
                                <option value="">select a status</option>
                                <option value="Active" <?php if(set_value('item_status_field') == 'Active'){echo 'selected';} ?>>Active</option>
                                <option value="In-Active" <?php if(set_value('item_status_field') == 'In-Active'){echo 'selected';} ?>>In-Active</option>
                            </select>
                            <?php echo form_error('item_status_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label >Item Image</label>
                                    <input type="file" name="item_image_field" id="item_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_add_item(event)" required>
                                </div>
                                <div class="col-md-5">
                                    <img src="" id="output_image_add_item"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="item_add_btn" id="item_add_btn" class="btn btn-primary">Add Item</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Items</h3>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_SESSION['item_enable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['item_enable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['item_enable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['item_enable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['item_disable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['item_disable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['item_disable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['item_disable_succ'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['item_edit_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['item_edit_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['item_edit_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['item_edit_succ'] ?></div>
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
                                <th>Price</th>
                                <th>Availability</th>
                                <th>Main Category</th>
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if(!empty($all_items_data) && sizeof($all_items_data) > 0){
                                    $no=0;
                                    foreach ($all_items_data as $item) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a  data-toggle="modal" id="<?php echo $item->id; ?>" base_url="<?php echo base_url(); ?>" class="editItem text-success">
                                                    <label class="text-primary" id="<?php echo $item->id.'item_edit_link'; ?>">Edit</label>
                                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size:18px; display: none;" id="<?php echo $item->id.'item_edit_waiting'; ?>"></i>
                                                </a>
                                                /
                                                <?php 
                                                    if($item->item_status=='Active'){
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Items/disableItem/'.$item->id; ?>" onclick="return confirm('Are you sure to disable this Item?')">
                                                            <label class="text-danger">Disable</label>
                                                        </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Items/enableItem/'.$item->id; ?>"onclick="return confirm('Are you sure to enable this Item?')">
                                                            <label class="text-success">Enable</label>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url().'uploads/'.$item->item_image;?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                            </td>
                                            <td><?php echo $item->item_title; ?></td>
                                            <td>&#163; <?php echo $item->item_price; ?></td>
                                            <td><?php echo $item->item_availability; ?></td>
                                            <td><?php echo $item->main_catg_title; ?></td>
                                            <td><?php echo $item->sub_catg_title; ?></td>
                                            <td>
                                                <?php 
                                                    if($item->item_status=='Active'){
                                                ?>
                                                        <label class="text-success"><?php echo $item->item_status; ?></label>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <label class="text-danger"><?php echo $item->item_status; ?></label>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $item->item_description; ?></td>
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

    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Item</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editItemForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Item Title</label>
                                <input type="hidden" name="id_field" id="id_field">
                                <input type="hidden" id="base_url_field" name="base_url_field" value="<?php echo base_url(); ?>">
                                <input type="text" name="item_edit_title_field" id="item_edit_title_field" class="form-control" placeholder="enter item title" required>
                            </div>
                            <div class="form-group">
                                <label >Main Category</label>
                                <select class="form-control" name="item_edit_main_catg_field" id="item_edit_main_catg_field" required>
                                    <option value="">select main category</option>
                                    <?php
                                        if(!empty($main_active_catgs_data) && sizeof($main_active_catgs_data) > 0){
                                            foreach ($main_active_catgs_data as $main_catg) {
                                    ?>
                                                <option value="<?php echo $main_catg->id; ?>">
                                                    <?php echo $main_catg->main_catg_title; ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Sub Category</label>
                                <select class="form-control" name="item_edit_sub_catg_field" id="item_edit_sub_catg_field" required>
                                    <option value="">select sub category</option>
                                    <?php
                                        if(!empty($sub_active_catgs_data) && sizeof($sub_active_catgs_data) > 0){
                                            foreach ($sub_active_catgs_data as $sub_catg) {
                                    ?>
                                                <option value="<?php echo $sub_catg->id; ?>">
                                                    <?php echo $sub_catg->sub_catg_title; ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Item Description</label>
                                <textarea name="item_edit_description_field" id="item_edit_description_field" class="form-control" placeholder="enter item description"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Item Price</label>
                                <input type="number" name="item_edit_price_field" id="item_edit_price_field" class="form-control" placeholder="enter item price">
                            </div>
                            <div class="form-group">
                                <label >Availability</label>
                                <select class="form-control" name="item_edit_availability_field" id="item_edit_availability_field" required>
                                    <option value="">select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Item Status</label>
                                <select class="form-control" name="item_edit_status_field" id="item_edit_status_field" required>
                                    <option value="">select a status</option>
                                    <option value="Active">Active</option>
                                    <option value="In-Active">In-Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label >Item Image</label>
                                        <input type="hidden" id="item_old_pic_field" name="item_old_pic_field">
                                        <input type="file" name="item_edit_image_field" id="item_edit_image_field" class="form-control" id="file" accept="image/*" onchange="preview_image_edit_item(event)">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="" id="output_image_edit_item"  onclick="$(#file).click()" style=" height: 150px; width: 150px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="submit" name="item_edit_btn" id="item_edit_btn" class="btn btn-primary" value="Update Item">
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>

<!-- Edit Item Modal ends here -->