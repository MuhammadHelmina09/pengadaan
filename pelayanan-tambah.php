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
            <h1>Halaman Tambah Kategori Pelayanan</h1>
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
              <label>Nama Pelayanan</label>
              <input type="text" name="nama_pelayanan" required="" class="form-control" autofocus="">
            </div>
           <!--  <div class="form-group">
              <label>Pilih Jenis Pelayanan</label>
              <select class="form-control col-sm-4" name="jenis" required="">
                <option value="">Pilih</option>
                <option value="jasa">Jasa</option>
                <option value="pengadaan">Pengadaan Barang</option>
              </select>
            </div>  -->

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
          $nama_pelayanan = $_POST['nama_pelayanan'];
          /*$jenis = $_POST['jenis'];*/

          $datas = mysqli_query($koneksi, "insert into pelayanan (nama_pelayanan)values('$nama_pelayanan')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='pelayanan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

