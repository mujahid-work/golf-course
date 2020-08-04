<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Golf Course Club | <?php echo $page_title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">

          <?php
            $total_notifications = 0;
            if(!empty($notifications_data)){
              $total_notifications = sizeof($notifications_data);
            }
          ?>

          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge"><?php echo $total_notifications; ?></span>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="height: 300px; overflow: auto;">

              <?php
                if(!empty($notifications_data)){
                  foreach ($notifications_data as $notification) {
              ?>
                      <a href="<?php echo base_url().'admin/dashboard/readNotification/'.$notification->id.'/'.$notification->order_id; ?>" class="dropdown-item">
                        <div class="media">
                          <div class="media-body">
                            <h3 class="dropdown-item-title">Hey its
                              <strong><?php echo $notification->full_name; ?>, </strong>
                              <span class="float-right text-sm text-danger"><i class="fas fa-eye"></i></span>
                            </h3>
                            <p class="text-sm"><?php echo $notification->description; ?></p>
                            <p class="text-sm text-muted mt-2">
                              <i class="far fa-clock mr-1"></i>
                              <?php
                                $dt = new DateTime($notification->created_at);
                                echo $time = $dt->format('H:i a');
                              ?>
                            </p>
                          </div>
                        </div>
                        <div class="dropdown-divider mt-2"></div>
                      </a>
              <?php
                  }
              ?>
                    <br>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo base_url().'admin/orders/fetchOrders/Submitted'?>" class="small-box-footer dropdown-footer"><label>See Submitted Orders</label> <i class="fas fa-arrow-circle-right"></i></a>
              <?php
                }
                else{
              ?>
                    <p class="text-sm text-center mt-5">No new notifications found</p>
              <?php
                }
              ?>
          </div>

        </li>

        <li class="nav-item dropdown">

          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-cogs"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <a href="<?php echo base_url() ?>admin/dashboard/accountSettings" class="dropdown-item">
            <i class="nav-icon fas fa-user mr-3" aria-hidden="true"></i>
               My Account
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url()?>login/logout" class="dropdown-item">
              <i class='nav-icon fas fa-sign-out-alt mr-3'></i>
               Logout
            </a>
            <div class="dropdown-divider"></div>
          </div>

        </li>
      
    </ul>
  </nav>
  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo base_url() ?>admin/dashboard" class="brand-link">
      <img src="<?php echo base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Golf Course Club</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <i class='nav-icon fas fa-user fa-2x' style="color: white;"></i>
        </div>
        <div class="info">
          <a href="<?php echo base_url() ?>admin/dashboard" class="d-block"><?php echo $_SESSION['logged_in_name']; ?></a>
        </div>
      </div>
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url() ?>admin/dashboard" class="nav-link <?php if($_SESSION['current_page'] == 'Dashboard'){ echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if($_SESSION['current_page'] == 'Categories'){ echo 'active';} ?>">
              <i class="nav-icon fa fa-list" aria-hidden="true"></i>
              <p>
                Manage Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/categories" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/categories/subCategories" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub-Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url() ?>admin/items" class="nav-link <?php if($_SESSION['current_page'] == 'Items'){ echo 'active';} ?>">
              <i class="nav-icon fas fa-cubes" aria-hidden="true"></i>
              <p>
                Manage Items
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url() ?>admin/customers" class="nav-link <?php if($_SESSION['current_page'] == 'Customers'){ echo 'active';} ?>">
              <i class="nav-icon fas fa-users" aria-hidden="true"></i>
              <p>
                Manage Customers
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if($_SESSION['current_page'] == 'Orders'){ echo 'active';} ?>">
              <i class="nav-icon fas fa-shopping-basket" aria-hidden="true"></i>
              <p>
                Manage Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/orders/fetchOrders/Submitted" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Submitted Orders</p>
                  <span class="badge badge-danger navbar-badge"><?php echo $_SESSION['orders_count']['total_submitted_orders']; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/orders/fetchOrders/Accepted" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accepted Orders</p>
                  <span class="badge badge-danger navbar-badge"><?php echo $_SESSION['orders_count']['total_accepted_orders']; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/orders/fetchOrders/Ready" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ready Orders</p>
                  <span class="badge badge-danger navbar-badge"><?php echo $_SESSION['orders_count']['total_ready_orders']; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/orders/fetchOrders/Serving" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Serving Orders</p>
                  <span class="badge badge-danger navbar-badge"><?php echo $_SESSION['orders_count']['total_serving_orders']; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/orders/fetchOrders/Completed" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Orders</p>
                  <span class="badge badge-danger navbar-badge"><?php echo $_SESSION['orders_count']['total_completed_orders']; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/orders/fetchOrders/Cancelled" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancelled Orders</p>
                  <span class="badge badge-danger navbar-badge"><?php echo $_SESSION['orders_count']['total_cancelled_orders']; ?></span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php if($_SESSION['current_page'] == 'Seats'){ echo 'active';} ?>">
              <i class="nav-icon fas fa-chair" aria-hidden="true"></i>
              <p>
                Manage Areas & Seats
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/seats/areas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Areas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/seats/seatTypes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Seat Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>admin/seats" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Seats</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url() ?>admin/dashboard/accountSettings" class="nav-link <?php if($_SESSION['current_page'] == 'Account Settings'){ echo 'active';} ?>">
            <i class='nav-icon fas fa-user'></i>
              <p>
                My Account
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url() ?>login/logout" class="nav-link">
            <i class='nav-icon fas fa-sign-out-alt'></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          </div>
        </div>
      </div>
    </div>

        <section class="content mt-2">
            
            <?php $this->load->view($view_to_load); ?>

        </section>

  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2025 <a href="#">Golf Course Club</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
  
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


<script src="<?php echo base_url() ?>assets/dist/js/custom_js_files/categories.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/custom_js_files/items.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/custom_js_files/seats.js"></script>

<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>

<script type='text/javascript'>
  function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function()
    {
    var output = document.getElementById('output_image');
    output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
</body>
</html>
