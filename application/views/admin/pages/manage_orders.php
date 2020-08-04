
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All <?php echo $page_title ?></h3>
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Submitted By</th>
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
                                if(!empty($orders_data) && sizeof($orders_data) > 0){
                                    $no=0;
                                    foreach ($orders_data as $order) {
                                        $no++;
                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'admin/Orders/viewOrderDetails/'.$order->id; ?>">
                                                    <label class="text-info">View Details</label>
                                                </a>
                                            </td>
                                            <td><?php echo $order->full_name; ?></td>
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