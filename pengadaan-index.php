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
            <h1>Halaman Pengadaan</h1>
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
          <a href="pengadaan-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered"  id="example2">
          <thead>
            <tr style="white-space: nowrap !important;">
              <th>No</th>
              <th>Tgl Pengadaan</th>
              <th>Tgl Permintaan</th>
              <th>Barang</th>
              <th>Pelanggan</th>
              <th>Jumlah Minta</th>
              <th>Total</th>
              <th>Ket.</th>
              <th>Status</th>
              <th>Bukti Acc</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select pengadaan.*, daftar_barang.nama, daftar_barang.satuan, permintaan.jumlah_minta,permintaan.total_permintaan,permintaan.tgl_permintaan, pelanggan.nama as nama_pel from pengadaan JOIN permintaan ON permintaan.id = pengadaan.permintaan_id JOIN daftar_barang ON daftar_barang.id = permintaan.barang_id JOIN pelanggan ON pelanggan.id = permintaan.pelanggan_id group by permintaan.id") or die(mysqli_error($koneksi));

              $no = 1;//untuk pengurutan nomor
               $sum = 0;
              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr style="white-space: nowrap !important;">
            <td><?= $no; ?></td>
            <td><?=  format_tanggal($row['tgl_pengadaan']); ?></td>
            <td><?=  format_tanggal($row['tgl_permintaan']); ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nama_pel']; ?></td>
            <td><?= $row['jumlah_minta']; ?> <?= $row['satuan']; ?></td>
            <td>Rp <?= rupiah($row['total_permintaan']); ?></td>
            <td><?= $row['ket']; ?></td>
            <td><?= $row['status']; ?></td>
            <td><a href="assets/gambar/<?= $row['foto'];?>"><img src="assets/gambar/<?= $row['foto'];?>" width="100"></a></td>
            <td>
                <a href="pengadaan-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="pengadaan-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
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
      $datas = mysqli_query($koneksi, "delete from pengadaan where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='pengadaan-index.php';</script>";
   }
  ?>