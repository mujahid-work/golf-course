<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="card-title">All Chefs</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="<?php echo base_url() ?>admin/Chefs/addChef" class="btn btn-danger"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Add Chef</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    <?php
                    if (isset($_SESSION['chef_enable_err'])) {
                    ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['chef_enable_err'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['chef_enable_succ'])) {
                    ?>
                        <div class="alert alert-success"><?php echo $_SESSION['chef_enable_succ'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['add_chef_err'])) {
                    ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['add_chef_err'] ?></div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['add_chef_succ'])) {
                    ?>
                        <div class="alert alert-success"><?php echo $_SESSION['add_chef_succ'] ?></div>
                    <?php
                    }
                    ?>

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (!empty($chefs_data) && sizeof($chefs_data) > 0) {
                                $no = 0;
                                foreach ($chefs_data as $chef) {
                                    $no++;
                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'admin/Chefs/viewChefDetails/' . $chef->id; ?>">
                                                <label class="text-info">View Details</label>
                                            </a>
                                            /
                                            <?php
                                            if ($chef->status == 'Active') {
                                            ?>
                                                <a href="<?php echo base_url() . 'admin/Chefs/disableChef/' . $chef->id; ?>" onclick="return confirm('Are you sure to disable this chef account?')">
                                                    <label class="text-danger">Disable</label>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo base_url() . 'admin/Chefs/enableChef/' . $chef->id; ?>" onclick="return confirm('Are you sure to enable this chef account?')">
                                                    <label class="text-success">Enable</label>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $chef->full_name; ?></td>
                                        <td><?php echo $chef->email; ?></td>
                                        <td><?php echo $chef->phone; ?></td>
                                        <td><?php echo $chef->role; ?></td>
                                        <td>
                                            <?php
                                            if ($chef->status == 'Active') {
                                            ?>
                                                <label class="text-success"><?php echo $chef->status; ?></label>
                                            <?php
                                            } else {
                                            ?>
                                                <label class="text-danger"><?php echo $chef->status; ?></label>
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