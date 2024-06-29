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
            <h1>Halaman Tambah Supplier</h1>
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
              <label>Nama</label>
              <input type="text" name="nama_supplier" required="" class="form-control" autofocus="">
            </div>
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="no_hp" required="" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" >
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
          $nama_supplier = $_POST['nama_supplier'];
          $no_hp = $_POST['no_hp'];
          $alamat = $_POST['alamat'];
          $email = $_POST['email'];

          $datas = mysqli_query($koneksi, "insert into supplier (nama_supplier,no_hp,alamat,email)values('$nama_supplier','$no_hp','$alamat','$email')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='supplier-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

