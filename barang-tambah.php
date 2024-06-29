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
            <h1>Halaman Tambah Data Barang</h1>
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
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="namabarang" required="" class="form-control" autofocus="">
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" name="stock" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>deskripsi</label>
              <input type="text" name="deskripsi" required="" class="form-control" >
            </div>
          
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="foto" class="form-control col-sm-4" required="" >
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
          $nama = $_POST['namabarang'];
          $deskripsi = $_POST['deskripsi'];
          $stock = $_POST['stock'];
          
          $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);

          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = NULL;
          }
          
          $foto = $nama_unik1;

          $datas = mysqli_query($koneksi, "insert into stock (namabarang,deskripsi,stock,foto)values('$nama','$deskripsi','$stock','$foto')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='barang-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

