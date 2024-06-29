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
            <h1>Halaman Tambah Daftar Barang</h1>
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
              <input type="text" name="nama" required="" class="form-control" autofocus="">
            </div>
            <div class="form-group">
              <label>Satuan</label>
              <input type="text" name="satuan" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Harga Beli</label>
              <input type="number" name="harga_beli" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Harga Jual</label>
              <input type="number" name="harga_jual" required="" class="form-control" >
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
          $nama = $_POST['nama'];
          $satuan = $_POST['satuan'];
          $harga_beli = $_POST['harga_beli'];
          $harga_jual = $_POST['harga_jual'];

          $datas = mysqli_query($koneksi, "insert into daftar_barang (nama,satuan,harga_beli,harga_jual)values('$nama','$satuan','$harga_beli','$harga_jual')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='stok-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

