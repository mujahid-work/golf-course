<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h1 class="profile-username text-center">
                        <b>
                            <?php echo $customer_data->full_name; ?>
                        </b>
                    </h1>
                    <p class="text-muted text-center"><?php echo $customer_data->email; ?></p>
                    <p class="text-muted text-center"><?php echo $customer_data->phone; ?></p>
                    <p class="text-muted text-center">
                        <?php 
                            if($customer_data->status == 'Active'){
                        ?>
                                <label class="text-success"><?php echo $customer_data->status; ?></label>
                        <?php
                            }
                            else{
                        ?>
                                <label class="text-success"><?php echo $customer_data->status; ?></label>
                        <?php
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header p-2"> <h3 class="profile-username text-center">Customer Orders List</h3> </div>
                <div class="card-body box-profile">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Order No</th>
                                <th>Area</th>
                                <th>Seat Place</th>
                                <th>Seat No</th>
                                <th>Status</th>
                                <th>Date Submitted</th>
                                <th>Sub Total</th>
                                <th>Discount Amount</th>
                                <th>Tax Amount</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($customer_orders) && sizeof($customer_orders) > 0){
                                    $no=0;
                                    foreach ($customer_orders as $order) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'admin/Orders/viewOrderDetails/'.$order->id; ?>">
                                                    <label class="text-info">View Details</label>
                                                </a>
                                            </td>
                                            <td><?php echo $order->order_no; ?></td>
                                            <td><?php echo $order->area_title; ?></td>
                                            <td><?php echo $order->seat_type_title; ?></td>
                                            <td><?php echo $order->seat_no; ?></td>
                                            <td><?php echo $order->order_status; ?></td>
                                            <td>
                                                <?php 

                                                    $dt = new DateTime($order->created_at);
                                                    echo $dt->format('M-d-Y');
                                                ?>
                                            </td>
                                            <td>&#163;<?php echo $order->sub_total; ?></td>
                                            <td>
                                                &#163; <?php echo $order->discount_amount; ?>
                                            </td>
                                            <td>
                                                &#163; <?php echo $order->tax_amount; ?>
                                            </td>
                                            <td>&#163;<?php echo $order->grand_total; ?></td>
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
