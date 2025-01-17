
<?php 
session_start();
  if($_SESSION['status'] != 'sudah_login') {
    header("location:login-index.php");
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APLIKASI LAPORAN DAN MONITORING REALISASI PENGADAAN BARANG DAN JASA PADA PT XYZ BERBASIS WEB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="./assets/gambar/logo.png" rel="icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
     <link rel="stylesheet" href="./assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <style type="text/css">
    .active {
      background-color: #ef4e30 !important;
    }
    .nav-treeview>.nav-item>.nav-link.active, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
      background-color: #ef4e30 !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #b23119;">
      <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-light" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link text-light">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->