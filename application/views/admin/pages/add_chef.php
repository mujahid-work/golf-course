<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Profile</h3>
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url() ?>admin/Chefs/addChefAccount" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name_field" id="full_name_field" class="form-control" placeholder="enter chef full name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email_field" id="email_field" class="form-control" placeholder="enter chef email address" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="pass_field" id="pass_field" class="form-control" placeholder="enter chef password" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="number_field" id="number_field" class="form-control" placeholder="enter chef phone number" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="add_chef_btn" id="add_chef_btn" class="btn btn-primary">Create Chef Account</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>