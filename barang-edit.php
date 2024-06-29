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
            <h1>Halaman Edit Barang</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Barang</h3>
        </div>
        <div class="card-body">
          <?php
          include('koneksi.php');

          $id = $_GET['id']; 
          $data   = mysqli_query($koneksi, "select stock.* from stock where stock.idbarang = '$id' limit 1");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="idbarang" required="" value="<?= $row['idbarang']; ?>">

            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="namabarang" required="" class="form-control col-sm-2" value="<?= $row['namabarang']; ?>">
            </div>

            <div class="form-group">
              <label>deskripsi</label>
              <input type="text" name="deskripsi" required="" class="form-control col-sm-2" value="<?= $row['deskripsi']; ?>">
            </div>
           
            
            <div class="form-group">
              <label>Gambar</label><br>
              <img src="assets/gambar/<?= $row['foto'];?>" width="100" class="mb-3">
              <input type="file" name="foto" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti bukti)</i>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Ubah data</button>
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
         
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['idbarang'];
          $namabarang = $_POST['namabarang'];
          $deskripsi = $_POST['deskripsi'];
          $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);
          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = $row['foto'];
          }
          $foto = $nama_unik1;

          $datas = mysqli_query($koneksi, "UPDATE stock SET namabarang = '$namabarang', deskripsi = '$deskripsi', foto='$foto' WHERE idbarang = '$id'") or die(mysqli_error($koneksi));
          echo "<script>alert('data berhasil diubah.');window.location='barang-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

