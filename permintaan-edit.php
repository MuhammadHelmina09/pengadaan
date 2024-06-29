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
            <h1>Halaman Edit Permintaan</h1>
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
          $data   = mysqli_query($koneksi, "select permintaan.*, daftar_barang.nama, daftar_barang.harga_jual from permintaan join daftar_barang on daftar_barang.id = permintaan.barang_id where permintaan.id = '$id' limit 1");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">

            <div class="form-group">
              <label>Tanggal Permintaan</label>
              <input type="date" name="tgl_permintaan" required="" class="form-control col-sm-2" value="<?= $row['tgl_permintaan']; ?>">
            </div>
            <div class="form-group">
              <label>Sabun</label>
              <input type="text" name="stok" class="form-control col-sm-4" value="<?= $row['nama']; ?>" readonly="">
            </div>
            <div class="form-group">
              <label>Harga Permintaan /satuan</label>
              <input type="text" id="harga_jual" name="harga_jual" class="form-control col-sm-4" value="<?= $row['harga_jual']; ?>" readonly="">
            </div>
            <div class="form-group">
              <label>Pelanggan</label>
              <select class="form-control  col-sm-4" name="pelanggan_id" >
                <option value="">Pilih Pelanggan</option>
                <?php
                  
                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['pelanggan_id'] == $data['id']) ? 'selected' : ''; ?>><?= $data['nama'] ?></option>
              <?php } ?>
              </select>
            </div>
           <!--  <div class="form-group">
              <label>Marketing</label>
              <select class="form-control  col-sm-4" name="sales_id" required="" >
                <option value="">Pilih</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from karyawan where jabatan ='marketing'") or die(mysqli_error($koneksi));
                  while($row1 = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row1['id'] ?>" <?= ($row['sales_id'] == $row1['id']) ? 'selected' : ''; ?>><?= $row1['nama'] ?></option>
              <?php } ?>
              </select>
            </div> -->
            <div class="form-group">
              <label>Jumlah <i>(tidak bisa diedit karena sudah masuk stok)</i></label>
              <input type="number" name="jumlah_minta" readonly="" class="form-control col-sm-4" value="<?= $row['jumlah_minta']; ?>">
            </div>
            <div class="form-group">
              <label>Total Permintaan</label>
              <input type="text" name="total_permintaan" readonly="" class="form-control col-sm-4" id="total_permintaan" value="<?=  $row['total_permintaan']; ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="ket" required class="textarea"><?= $row['ket']; ?></textarea>
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
          $tgl_permintaan = $_POST['tgl_permintaan'];
          $pelanggan_id = $_POST['pelanggan_id'];
          $ket = $_POST['ket'];

          $datas = mysqli_query($koneksi, "update permintaan set tgl_permintaan = '$tgl_permintaan',pelanggan_id = '$pelanggan_id' ,ket = '$ket' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('data berhasil diubah.');window.location='permintaan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

