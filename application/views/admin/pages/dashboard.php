
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $total_submitted_orders->total_submitted_orders; ?></h3>
                    <p>Submitted Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <a href="<?php echo base_url().'admin/orders/fetchOrders/Submitted'?>" class="small-box-footer"><label>More info </label> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 style="color: white;"><?php echo $total_users->total_users; ?></h3>
                    <p style="color: white;">Total User</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url().'admin/customers'?>" class="small-box-footer"><label style="color: white;"> More info </label> <i class="fas fa-arrow-circle-right" style="color: white;"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo $total_items->total_items; ?></h3>
                    <p>Total Items</p>
                </div>
                <div class="icon">
                    <i class=" fas fa-cubes"></i>
                </div>
                <a href="<?php echo base_url() ?>admin/items" class="small-box-footer"><label>More info </label> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo $total_seats->total_seats; ?></h3>
                    <p>Total Seats</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chair"></i>
                </div>
                <a href="<?php echo base_url() ?>admin/seats" class="small-box-footer"><label>More info </label> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>