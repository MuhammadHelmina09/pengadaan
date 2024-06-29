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
            <h1>Halaman Edit Kategori Pelayanan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data</h3>
        </div>
        <div class="card-body">
          <?php
          include('koneksi.php');

          $id = $_GET['id']; //mengambil id pelayanan yang ingin diubah

          //menampilkan pelayanan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from pelayanan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nama Pelayanan</label>
              <input type="text" name="nama_pelayanan" required="" value="<?= $row['nama_pelayanan']; ?>" class="form-control" autofocus="">
            </div>
           <!--   <div class="form-group">
              <label>Pilih Jenis</label>
              <select class="form-control col-sm-4" name="jenis" required="">
                <option value="">Pilih</option>
                <option value="jasa" <?= ($row['jenis'] == 'jasa') ? 'selected' : ''; ?>>Jasa</option>
                <option value="pengadaan" <?= ($row['jenis'] == 'pengadaan') ? 'selected' : ''; ?>>Pengadaan Barang</option>
              </select>
            </div>  -->
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

        //jika klik tombol submit maka akan melakukan perubahan
        if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $nama_pelayanan = $_POST['nama_pelayanan'];
        

          mysqli_query($koneksi, "update pelayanan set nama_pelayanan='$nama_pelayanan' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
          echo "<script>alert('data berhasil diupdate.');window.location='pelayanan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

