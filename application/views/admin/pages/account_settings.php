
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Profile</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Dashboard/updateAdminProfile" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['admin_profile_updt_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['admin_profile_updt_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['admin_profile_updt_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['admin_profile_updt_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name_field" id="full_name_field" class="form-control" placeholder="enter full name" value="<?php echo $admin_profile_data->full_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email_field" id="email_field" class="form-control" placeholder="enter email address" value="<?php echo $admin_profile_data->email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="number_field" id="number_field" class="form-control" placeholder="enter phone number" value="<?php echo $admin_profile_data->phone; ?>" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="admin_profile_updt_btn" id="admin_profile_updt_btn" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Password</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url()?>admin/Dashboard/updateAdminPassword" method="POST">
                    <div class="card-body">
                        <?php
                            if(isset($_SESSION['admin_password_updt_err'])) {
                        ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['admin_password_updt_err'] ?></div>
                        <?php 
                            }
                        ?>

                        <?php
                            if(isset($_SESSION['admin_password_updt_succ'])) {
                        ?>
                                <div class="alert alert-success"><?php echo $_SESSION['admin_password_updt_succ'] ?></div>
                        <?php 
                            }
                        ?>
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_pass_field" id="current_pass_field" class="form-control" placeholder="enter current password">
                            <?php echo form_error('current_pass_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_pass_field" id="new_pass_field" class="form-control" placeholder="enter new password">
                            <?php echo form_error('new_pass_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_pass_field" id="confirm_pass_field" class="form-control" placeholder="confirm new password">
                            <?php echo form_error('confirm_pass_field','<p class="text-danger mt-2">','</p>'); ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="admin_password_updt_btn" id="admin_password_updt_btn" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>