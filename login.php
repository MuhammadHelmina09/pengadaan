<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APLIKASI LAPORAN DAN MONITORING REALISASI PENGADAAN BARANG DAN JASA PADA PT XYZ BERBASIS WEB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page " style="background:#ef4e30;background-size: 100%;" >
<div class="login-box">
  <div class="login-logo">
    
    <img src="" style="width: 320px;">
    <br>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-danger">LOGIN ADMIN</p>

      <form action="" method="post" role="form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ketikkan username.." name="username" required="" autofocus="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="ketikkan password.." name="password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-success float-right " name="submit" value="simpan">Login sekarang!</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="row">
        <div class="col-sm-12">
          
        </div>
      </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
 
include('koneksi.php');

if(isset($_POST['submit'])) {
   session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($koneksi ,"SELECT karyawan.* from karyawan where username = '$username' and password = '$password'");

  $cek = mysqli_num_rows($result);

  if($cek > 0) {
    $data = mysqli_fetch_assoc($result);

      $_SESSION['username'] = $username;
      $_SESSION['status'] = 'sudah_login';
      $_SESSION['user_id'] = $data['id'];
      $_SESSION['level'] = 'admin';
      $_SESSION['nama'] = $data['nama'];
      
      header("location:index.php");
    } else {
      echo "<script>alert('Gagal Login! Username / Password Salah.');window.location='login.php';</script>";
    }
  }
?>