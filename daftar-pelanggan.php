
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APLIKASI LAPORAN DAN MONITORING REALISASI PENGADAAN BARANG DAN JASA PADA CV ABC BERBASIS WEB</title>
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
<body class=" " style="background: url('assets/gambar/bg.jpg') no-repeat; background-size: 100% 100%;overflow-x: hidden;" >
  <?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "SELECT max(kode) as kodeTerbesar FROM pelanggan");
    $data = mysqli_fetch_array($query);
    $kode = $data['kodeTerbesar'];
     
    $urutan = (int) substr($kode, 1, 4);
    $urutan++;
     
    $huruf = "P";
    $kode = $huruf . sprintf("%04s", $urutan);
?>
  <div class="row mt-5">
    <div class="col-md-6 offset-3">
<div class="card bg-dark">
        <div class="card-header">
          <h3 class="card-title">Daftar Pelanggan</h3>
        </div>
        <div class="card-body">
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label>Kode</label>
              <input type="text" name="kode" value="<?= $kode; ?>" required="" class="form-control col-sm-4" readonly>
            </div>
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4" autofocus="">
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4" >
            </div>
            
            <div class="form-group">
              <label>Jenkel</label>
              <select class="form-control  col-sm-4" name="jenkel" required="">
                <option value="">Pilih</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
              </select>
            </div>

            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="hp" required="" class="form-control col-sm-4" >
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" required="" class="form-control col-sm-4" >
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" >
            </div>
            
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" required="" class="form-control col-sm-4" >
            </div>

            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
          </form>
      </div>
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
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $kode = $_POST['kode'];
          $jenkel = $_POST['jenkel'];
          $hp = $_POST['hp'];
          $alamat = $_POST['alamat'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $tgl_daftar = date('Y-m-d');
         
          $data_cek   = mysqli_query($koneksi, "select * from pelanggan where nik = '$nik'");
          $row_cek  = mysqli_fetch_assoc($data_cek);

          if($row_cek > 0) {
            echo "<script>alert('data nik sudah terdaftar.');window.location='daftar-pelanggan.php';</script>";
          } else {

          $datas = mysqli_query($koneksi, "insert into pelanggan (nik,nama,hp,alamat,username,password,email,kode,verifikasi,tgl_daftar,jenkel)values('$nik','$nama','$hp','$alamat','$username','$password','$email','$kode','waiting','$tgl_daftar','$jenkel')") or die(mysqli_error($koneksi));

          echo "<script>alert('Berhasil Daftar, tunggu verifikasi admin.');window.location='login-pelanggan.php';</script>";
          }


        }
        ?>
