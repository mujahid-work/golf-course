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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
        body{
            padding-top:4.2rem;
            padding-bottom:4.2rem;
            background:rgba(0, 0, 0, 0.76);
        }
        a{
            text-decoration:none !important;
        }
        h1,h2,h3{
            font-family: 'Kaushan Script', cursive;
        }
        .myform{
            position: relative;
            display: -ms-flexbox;
            display: flex;
            padding: 1rem;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.2);
            border-radius: 1.1rem;
            outline: 0;
		    max-width: 500px;
		}
        .tx-tfm{
            text-transform:uppercase;
        }
        .mybtn{
             border-radius:50px;
        }
        
        .login-or {
            position: relative;
            color: #aaa;
            margin-top: 10px;
            margin-bottom: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .span-or {
            display: block;
            position: absolute;
            left: 50%;
            top: -2px;
            margin-left: -25px;
            background-color: #fff;
            width: 50px;
            text-align: center;
        }
        .hr-or {
            height: 1px;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

        <section class="content mt-5">
            
            <?php $this->load->view($view_to_load); ?>

        </section>
        
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
