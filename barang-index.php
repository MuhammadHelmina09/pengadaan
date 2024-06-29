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
            <h1>Halaman Daftar Barang</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data</h3>
          <a href="barang-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
        </div>
        <div class="card-body">
        <table class="table table-bordered" id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>Gambar</th>
              <th>Nama</th>
              <th>deskripsi</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select * from stock") or die(mysqli_error($koneksi));

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td ><?= $no; ?></td>
            <td><a href="assets/gambar/<?= $row['foto'];?>"><img src="assets/gambar/<?= $row['foto'];?>" width="100"></a></td>
            <td><?= $row['namabarang']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td><?= $row['stock']; ?></td>
            <td>
                <a href="barang-edit.php?id=<?= $row['idbarang']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="barang-index.php?id=<?= $row['idbarang']; ?>&status=hapus"  class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
            </td>
           
          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>
        <!-- /.card-body -->
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('templates/footer.php');
  ?>

  <?php
   if ((isset($_GET['status'])) && ($_GET['status'] == 'hapus')) {
      $id = $_GET['id']; //menampung id
      //query hapus
      $datas = mysqli_query($koneksi, "delete from stock where idbarang ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php
      
      echo "<script>alert('data berhasil dihapus.');window.location='barang-index.php';</script>";
   }
  ?>

