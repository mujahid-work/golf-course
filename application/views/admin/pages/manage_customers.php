
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Customers</h3>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_SESSION['customer_enable_err'])) {
                    ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['customer_enable_err'] ?></div>
                    <?php 
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['customer_enable_succ'])) {
                    ?>
                            <div class="alert alert-success"><?php echo $_SESSION['customer_enable_succ'] ?></div>
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
                                if(!empty($customers_data) && sizeof($customers_data) > 0){
                                    $no=0;
                                    foreach ($customers_data as $customer) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'admin/Customers/viewCustomerDetails/'.$customer->id; ?>">
                                                    <label class="text-info">View Details</label>
                                                </a>
                                                /
                                                <?php 
                                                    if($customer->status=='Active'){
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Customers/disableCustomer/'.$customer->id; ?>" onclick="return confirm('Are you sure to disable this customer account?')">
                                                            <label class="text-danger">Disable</label>
                                                        </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo base_url().'admin/Customers/enableCustomer/'.$customer->id; ?>"onclick="return confirm('Are you sure to enable this customer account?')">
                                                            <label class="text-success">Enable</label>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $customer->full_name; ?></td>
                                            <td><?php echo $customer->email; ?></td>
                                            <td><?php echo $customer->phone; ?></td>
                                            <td><?php echo $customer->role; ?></td>
                                            <td>
                                                <?php 
                                                    if($customer->status=='Active'){
                                                ?>
                                                        <label class="text-success"><?php echo $customer->status; ?></label>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <label class="text-danger"><?php echo $customer->status; ?></label>
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