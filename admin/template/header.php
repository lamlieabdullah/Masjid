<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Memaparkan waktu solat, info dan berbagai maklumat.  Khusus untuk kegunaan masjid">
  <meta name="author" content="Hairilfaiz @ denshie.com">
  <link rel="shortcut icon" href="../setting/assets/images/islamic-symbols-icon-png-13211-128x106.png" type="image/x-icon">
  <title><?php echo $title; ?> - Sistem Paparan Digital</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $home_url; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo $home_url; ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo $home_url; ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="<?php echo $home_url; ?>vendor/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link href="<?php echo $home_url; ?>vendor/bootstrapTimePicker/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo $home_url; ?>css/sb-admin.css" rel="stylesheet">
  <style>
  /* Bootstrap Toggle v2.2.2 corrections for Bootsrtap 4*/
  .toggle-off {
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
  }
  .toggle.off {
    border-color: rgba(0, 0, 0, .25);
  }

  .toggle-handle {
    background-color: white;
    border: thin rgba(0, 0, 0, .25) solid;
  }
  #table-sort tr {
    cursor:move;
  }

  .jarakkan{
    margin-left: 1px;
    margin-top: 1px;
  }

  .dok-tepi-kanan{
    position: fixed;
    right: 0;
    margin-right: 5%;
  }

  .action-button{
    margin-top: 1%;
    margin-bottom: 1%;
  }

  .card-header{
    font-size: 1.4em;
    font-weight: bold;
  }
  .gambar-icon{
    margin: auto;
  }
  </style>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo $home_url; ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $home_url; ?>vendor/jquery-ui/jquery-ui.js"></script>
  <script src="<?php echo $home_url; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $home_url; ?>vendor/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo $home_url . 'admin/'; ?>index.php">Sistem Paparan Digital</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo $home_url . 'admin/'; ?>index.php">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span class="nav-link-text">Utama</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="<?php echo $home_url . 'admin/'; ?>slider.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Slide</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="<?php echo $home_url . 'admin/'; ?>text.php">
            <i class="fa fa-text-width" aria-hidden="true"></i>
            <span class="nav-link-text">Scroll Text</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="<?php echo $home_url . 'admin/'; ?>device.php">
            <i class="fa fa-wrench" aria-hidden="true"></i>
            <span class="nav-link-text">Setting Device</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="<?php echo $home_url; ?>kemaskini1-2.php">
            <i class="fa fa-download" aria-hidden="true"></i>
            <span class="nav-link-text">Kemaskini Sistem</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="container-fluid">
