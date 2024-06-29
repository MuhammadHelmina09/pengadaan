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
            <h1>Halaman Edit Pengadaan</h1>
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

          $id = $_GET['id']; 
          $data   = mysqli_query($koneksi, "select pengadaan.* from pengadaan where pengadaan.id = '$id' limit 1");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">

            <div class="form-group">
              <label>Tanggal Pengadaan</label>
              <input type="date" name="tgl_pengadaan" required="" class="form-control col-sm-2" value="<?= $row['tgl_pengadaan']; ?>">
            </div>
            <div class="form-group">
              <label>Permintaan</label>
              <select class="form-control col-sm-12" name="permintaan_id" required="" disabled >
                <?php
                  $datas2 = mysqli_query($koneksi, "select permintaan.*, daftar_barang.nama,daftar_barang.satuan, pelanggan.nama as nama_pel from permintaan JOIN daftar_barang ON daftar_barang.id = permintaan.barang_id JOIN pelanggan ON pelanggan.id = permintaan.pelanggan_id group by permintaan.id") or die(mysqli_error($koneksi));
                  while($row2 = mysqli_fetch_assoc($datas2)) {
                ?> 
                <option value="<?= $row2['id'] ?>"  <?= ($row['permintaan_id'] == $row2['id']) ? 'selected' : ''; ?>> Barang : <?= $row2['nama'] ?> // Pelanggan : <?= $row2['nama_pel'] ?> // Permintaan : <?= $row2['jumlah_minta'] ?> <?= $row2['satuan'] ?> // Total : Rp <?= rupiah($row2['total_permintaan']);?> </option>
              <?php } ?>
              </select>
            </div>
            

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="ket" required class="textarea"><?= $row['ket']; ?></textarea>
            </div>

            <div class="form-group">
              <label>Pilih Status</label>
              <select class="form-control col-sm-4" name="status" required="">
                <option value="">Pilih</option>
                <option value="SEDANG DIPROSES" <?= ($row['status'] == 'SEDANG DIPROSES') ? 'selected' : ''; ?>>SEDANG DIPROSES</option>
                <option value="PENDING" <?= ($row['status'] == 'PENDING') ? 'selected' : ''; ?>>PENDING</option>
                <option value="BATAL" <?= ($row['status'] == 'BATAL') ? 'selected' : ''; ?>>BATAL</option>
                <option value="SELESAI DIPENUHI" <?= ($row['status'] == 'SELESAI DIPENUHI') ? 'selected' : ''; ?>>SELESAI DIPENUHI</option>
              </select>
            </div> 
            <div class="form-group">
              <label>Bukti Acc</label><br>
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
          $id = $_POST['id'];
          $tgl_pengadaan = $_POST['tgl_pengadaan'];
          $ket = $_POST['ket'];
          $status = $_POST['status'];
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

          $datas = mysqli_query($koneksi, "update pengadaan set tgl_pengadaan = '$tgl_pengadaan', ket = '$ket', status = '$status',foto='$foto' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('data berhasil diubah.');window.location='pengadaan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

