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
            <h1>Halaman Jasa</h1>
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
        <!--   <a href="#" data-toggle="modal" data-target="#lap-jasa" class="btn btn-sm btn-warning float-right ml-1">
                  Laporan Jasa
                </a>  -->
          <a href="jasa-tambah.php" class="btn btn-sm btn-warning float-right">+ Tambah Data</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered"  id="example2">
          <thead>
            <tr  style="white-space: nowrap !important;">
              <th>No</th>
              <th>Jenis Jasa</th>
              <th>Nama Pelanggan</th>
              <th>Tanggal</th>
              <th>Biaya</th>
              <th>Status</th>
              <th>Detail</th>
              <th>Penanggung Jawab</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
               if($_SESSION['level'] == 'admin') {
              $datas = mysqli_query($koneksi, "select jasa.*, pelayanan.nama_pelayanan, karyawan.nama as nama_pj, pelanggan.nama from jasa left join karyawan on karyawan.id = jasa.penanggung_jawab join pelanggan on pelanggan.id = jasa.pelanggan_id join pelayanan on pelayanan.id = jasa.jasa_id group by jasa.id") or die(mysqli_error($koneksi));
            } else {
              $pelanggan_id = $_SESSION['user_id'];
               $datas = mysqli_query($koneksi, "select jasa.*,pelayanan.nama_pelayanan, karyawan.nama as nama_pj, pelanggan.nama from jasa  left join karyawan on karyawan.id = jasa.penanggung_jawab join pelanggan on pelanggan.id = jasa.pelanggan_id  join pelayanan on pelayanan.id = jasa.jasa_id where pelanggan.id = '$pelanggan_id' group by jasa.id") or die(mysqli_error($koneksi));
            }

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr style="white-space: nowrap !important;">
            <td><?= $no; ?></td>
            <td><?= $row['nama_pelayanan']; ?></td>
            <td><?= $row['nama']; ?></td>

            <td><?= format_tanggal($row['tanggal']); ?></td>
            <td>Rp <?= $row['biaya_budget']; ?></td>
            <td><?= $row['status']; ?></td>
            <td><?= $row['detail']; ?></td>
            <td><?= $row['nama_pj']; ?></td>
            <td>
               <?php if($_SESSION['level'] == 'admin') { ?>
                <a href="jasa-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="jasa-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
                 <?php } ?>
            </td>
          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
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
      $datas = mysqli_query($koneksi, "delete from jasa where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='jasa-index.php';</script>";
   }
  ?>


  <div class="modal fade" id="lap-jasa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form method="GET" action="laporan-jasa.php">
      <div class="modal-body">
        <input type="month" name="bulan" required="" class="form-control"/>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

     </form>
    </div>
  </div>
</div>