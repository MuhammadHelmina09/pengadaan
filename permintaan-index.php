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
            <h1>Halaman Permintaan</h1>
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
          <a href="permintaan-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered"  id="example2">
          <thead>
            <tr style="white-space: nowrap !important;">
              <th>No</th>
              <th>Tgl Permintaan</th>
              <th>Barang</th>
              <th>Pelanggan</th>
              <th>Jumlah Minta</th>
              <th>Total</th>
              <th>Ket.</th>
              <th>Status Permintaan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
                 if($_SESSION['level'] == 'admin') {
              $datas = mysqli_query($koneksi, "select permintaan.*, daftar_barang.nama,daftar_barang.satuan, pelanggan.nama as nama_pel from permintaan JOIN daftar_barang ON daftar_barang.id = permintaan.barang_id JOIN pelanggan ON pelanggan.id = permintaan.pelanggan_id group by permintaan.id") or die(mysqli_error($koneksi));
              } else {
              $pelanggan_id = $_SESSION['user_id'];
              $datas = mysqli_query($koneksi, "select permintaan.*, daftar_barang.nama,daftar_barang.satuan, pelanggan.nama as nama_pel from permintaan JOIN daftar_barang ON daftar_barang.id = permintaan.barang_id JOIN pelanggan ON pelanggan.id = permintaan.pelanggan_id where pelanggan.id = '$pelanggan_id' group by permintaan.id") or die(mysqli_error($koneksi));
            }
              $no = 1;//untuk pengurutan nomor
               $sum = 0;
              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
                $id = $row['id'];
                $data_pengadaan   = mysqli_query($koneksi, "select pengadaan.* from pengadaan where pengadaan.permintaan_id = '$id' limit 1");
                $row_pengadaan  = mysqli_fetch_assoc($data_pengadaan);

                if(isset($row_pengadaan)) {
                    $status = $row_pengadaan['status'];
                } else {
                    $status = 'BELUM DIPROSES';
                }
            ?>  

          <tr style="white-space: nowrap !important;">
            <td><?= $no; ?></td>
            <td><?=  format_tanggal($row['tgl_permintaan']); ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nama_pel']; ?></td>
            <td><?= $row['jumlah_minta']; ?> <?= $row['satuan']; ?></td>
            <td>Rp <?= rupiah($row['total_permintaan']); ?></td>
            <td><?= $row['ket']; ?></td>
            <td><span class="badge badge-dark"><?= $status; ?></span></td>
            <td>
              <?php   if($_SESSION['level'] == 'admin') { ?>
                <a href="permintaan-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="permintaan-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
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
      $datas = mysqli_query($koneksi, "delete from permintaan where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='permintaan-index.php';</script>";
   }
  ?>