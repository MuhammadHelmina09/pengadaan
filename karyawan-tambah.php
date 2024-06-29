<?php
  include('templates/header.php');
  include('templates/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Tambah Karyawan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
          <form action="" method="post" role="form">
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control  col-sm-4" name="jenkel" required="">
                <option value="">Pilih</option>
                <option value="L">Laki - Laki</option>
                <option value="P">Wanita</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control  col-sm-4" name="jabatan" required="">
                <option value="">Pilih</option>
                <option value="Pimpinan">Pimpinan</option>
                <option value="Marketing">Marketing</option>
                <option value="Admin">Admin</option>
                <option value="Helper">Helper</option>
              </select>
            </div>
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="no_hp" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" required="" class="form-control" >
            </div>

            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
          </form>
      </div>
    </div>
        <!-- /.card-body -->
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
        include('koneksi.php');
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $jenkel = $_POST['jenkel'];
          $jabatan = $_POST['jabatan'];
          $no_hp = $_POST['no_hp'];
          $alamat = $_POST['alamat'];
          $status_aktif = 'aktif';
          $username = $_POST['username'];
          $password = $_POST['password'];

          $datas = mysqli_query($koneksi, "insert into karyawan (nik,nama,jenkel,jabatan,no_hp,alamat,status_aktif,username,password)values('$nik','$nama','$jenkel','$jabatan','$no_hp','$alamat','$status_aktif','$username','$password')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='karyawan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

