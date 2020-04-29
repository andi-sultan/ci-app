<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?> | CI App</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-3.0.2/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-3.0.2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-3.0.2/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <!-- closing tags in footer.php -->
  <div class="wrapper">

    <?php $this->load->view('_partials/navbar'); ?>
    <?php $this->load->view('_partials/sidebar_menu'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <?php echo $this->uri->segment(1) != 'home' ? '<li class="breadcrumb-item"><a href="' . base_url() . '">Home</a></li>' : '' ?>
                <?php
                if ($this->uri->segment(2) != null) {
                  echo '<li class="breadcrumb-item"><a href="' . base_url() . $this->uri->segment(1) . '">' . ucfirst($this->uri->segment(1)) . '</a></li>';
                  echo '<li class="breadcrumb-item active">' . ucfirst($this->uri->segment(2)) . '</li>';
                } else {
                  echo $this->uri->segment(1) != 'home' ? '<li class="breadcrumb-item active">' . $title . '</li>' : '';
                }
                ?>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
