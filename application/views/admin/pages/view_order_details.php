<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center"><?php echo $order_data->order_no; ?></h3>
                    <p class="text-muted text-center"><?php echo $order_data->full_name; ?></p>
                    <p class="text-muted text-center">
                        <b>
                            <?php
                                $dt = new DateTime($order_data->created_at);
                                echo $dt->format('M-d-Y');
                            ?>
                        </b>
                    </p>
                    <form action="<?php echo base_url()?>admin/Orders/updateOrderDetails" method="POST">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Seat No.</b> <span class="float-right"><?php echo $order_data->seat_no; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Seat Location</b> <span class="float-right"><?php echo $order_data->seat_type_title; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Sub-Total</b> <span class="float-right">&#163; <?php echo $order_data->sub_total; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Discount Amount</b> <span class="float-right">
                                    <?php 
                                        if($order_data->discount_amount != ''){
                                            
                                            echo '&#163; '.$order_data->discount_amount; 
                                        }
                                        else{
                                            
                                            echo 0; 
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Tax Amount</b> <span class="float-right">
                                    <?php 
                                        if($order_data->tax_amount != ''){
                                            
                                            echo '&#163; '.$order_data->tax_amount; 
                                        }
                                        else{
                                            
                                            echo 0; 
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Grand Total</b> <span class="float-right">&#163; <?php echo $order_data->grand_total; ?></span>
                            </li>
                            <li class="list-group-item">
                                <input type="hidden" value="<?php echo $order_data->id; ?>" name="order_id_field" id="order_id_field">
                                <input type="hidden" value="<?php echo $order_data->sub_total; ?>" name="sub_total_field" id="sub_total_field">
                                <div>
                                    <b>Discount Value</b>
                                    <input name="discount_value_field" id="discount_value_field" type="number" class="form-control" value="<?php if($order_data->discount != ''){ echo $order_data->discount; } else{ echo 0; } ?>" min="0" />
                                </div>
                                <div class="mt-2">
                                    <b>Discount Type</b>
                                    <select name="discount_type_field" id="discount_type_field" class="form-control">
                                        <option value=""> select a discount type</option>
                                        <option value="amount" <?php if($order_data->discount_type == 'amount'){echo 'selected'; } ?>> Fixed Amount </option>
                                        <option value="percentage" <?php if($order_data->discount_type == 'percentage'){echo 'selected'; } ?>> Percentage </option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <b>Tax Value</b>
                                    <input name="tax_value_field" id="tax_value_field" type="number" class="form-control" value="<?php if($order_data->tax != ''){ echo $order_data->tax; } else{ echo 0; } ?>" min="0" />
                                </div>
                                <div class="mt-2">
                                    <b>Tax Type</b>
                                    <select name="tax_type_field" id="tax_type_field" class="form-control">
                                        <option value=""> select a tax type</option>
                                        <option value="amount" <?php if($order_data->tax_type == 'amount'){echo 'selected'; } ?>> Fixed Amount </option>
                                        <option value="percentage" <?php if($order_data->tax_type == 'percentage'){echo 'selected'; } ?>> Percentage </option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <b>Order Status</b>
                                    <select name="order_status_field" id="order_status_field" class="form-control">
                                        <option value=""> select an order status</option>
                                        <option value="Submitted" <?php if($order_data->order_status == 'Submitted'){echo 'selected'; } ?>> Submitted </option>
                                        <option value="Accepted" <?php if($order_data->order_status == 'Accepted'){echo 'selected'; } ?>> Accepted </option>
                                        <option value="Ready" <?php if($order_data->order_status == 'Ready'){echo 'selected'; } ?>> Ready </option>
                                        <option value="Serving" <?php if($order_data->order_status == 'Serving'){echo 'selected'; } ?>> Serving </option>
                                        <option value="Completed" <?php if($order_data->order_status == 'Completed'){echo 'selected'; } ?>> Completed </option>
                                        <option value="Cancelled" <?php if($order_data->order_status == 'Cancelled'){echo 'selected'; } ?>> Cancelled </option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <input class="btn btn-primary btn-block" type="submit" value="Update Order Details" name="update_order_btn" id="update_order_btn">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header p-2"> <h3 class="profile-username text-center">Order Items</h3> </div>
                <div class="card-body box-profile">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Main Category</th>
                                <th>Sub Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Item Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($order_items_data)){
                                    $no=0;
                                    foreach ($order_items_data as $item) {
                                        $no++;
                                ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <img src="<?php echo base_url().'uploads/'.$item->item_image;?>" style=" height: 50px; width: 50px; border-radius: 10px;" onerror="this.src='<?php echo base_url() ?>assets/dist/img/camera.png';">
                                            </td>
                                            <td><?php echo $item->item_title; ?></td>
                                            <td><?php echo $item->main_catg_title; ?></td>
                                            <td><?php echo $item->sub_catg_title; ?></td>
                                            <td><?php echo $item->item_price; ?></td>
                                            <td><?php echo $item->item_quantity; ?></td>
                                            <td><?php echo $item->item_total; ?></td>
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
