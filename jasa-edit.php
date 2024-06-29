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
            <h1>Halaman Edit Jasa</h1>
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
          $data   = mysqli_query($koneksi, "select * from jasa where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
             <div class="form-group">
              <label>Tanggal Permintaan Jasa</label>
              <input type="date" name="tanggal" class="form-control col-4" value="<?= $row['tanggal']; ?>" readonly >
            </div>
            <div class="form-group">
              <label>Pilih Pelanggan</label>
              <select class="form-control col-sm-4" name="pelanggan_id" required="" >
                <option value="">Pilih</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($row1 = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row1['id'] ?>" <?= ($row['pelanggan_id'] == $row1['id']) ? 'selected' : ''; ?>><?= $row1['nama'] ?></option>
              <?php } ?>
              </select>
            </div> 

            <div class="form-group">
              <label>Jasa</label>
              <select class="form-control col-sm-4" name="jasa_id" required="" >
                <option value="">Pilih</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from pelayanan") or die(mysqli_error($koneksi));
                  while($row1 = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row1['id'] ?>" <?= ($row['jasa_id'] == $row1['id']) ? 'selected' : ''; ?>><?= $row1['nama_pelayanan'] ?></option>
              <?php } ?>
              </select>
            </div> 


            <div class="form-group">
              <label>Biaya Budget</label>
              <input type="number" min="0" name="biaya_budget" class="form-control col-4" required value="<?= $row['biaya_budget']; ?>" >
            </div>
            <div class="form-group">
              <label>Detail</label>
              <textarea name="detail" class="textarea"><?= $row['detail']; ?></textarea>
            </div>


            <div class="form-group">
              <label>Pilih Status</label>
              <select class="form-control col-sm-4" name="status" required="">
                <option value="">Pilih</option>
                <option value="MENUNGGU" <?= ($row['status'] == 'MENUNGGU') ? 'selected' : ''; ?>>MENUNGGU</option>
                <option value="SEDANG DIREVIEW" <?= ($row['status'] == 'SEDANG DIREVIEW') ? 'selected' : ''; ?>>SEDANG DIREVIEW</option>
                <option value="TIDAK DISETUJUI" <?= ($row['status'] == 'TIDAK DISETUJUI') ? 'selected' : ''; ?>>TIDAK DISETUJUI</option>
                <option value="DISETUJUI & DIPROSES" <?= ($row['status'] == 'DISETUJUI & DIPROSES') ? 'selected' : ''; ?>>DISETUJUI & DIPROSES</option>
                <option value="PENDING" <?= ($row['status'] == 'PENDING') ? 'selected' : ''; ?>>PENDING</option>
                <option value="BATAL" <?= ($row['status'] == 'BATAL') ? 'selected' : ''; ?>>BATAL</option>
              </select>
            </div> 

            <div class="form-group">
              <label>Penanggung Jawab</label>
              <select class="form-control col-sm-4" name="penanggung_jawab" required="" >
                <option value="">Pilih</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from karyawan") or die(mysqli_error($koneksi));
                  while($row1 = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row1['id'] ?>" <?= ($row['penanggung_jawab'] == $row1['id']) ? 'selected' : ''; ?>><?= $row1['nama'] ?></option>
              <?php } ?>
              </select>
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
          $detail = $_POST['detail'];
          $penanggung_jawab = $_POST['penanggung_jawab'];
          $pelanggan_id = $_POST['pelanggan_id'];
          $biaya_budget = $_POST['biaya_budget'];
          $status = $_POST['status'];
          $jasa_id = $_POST['jasa_id'];

          $datas = mysqli_query($koneksi, "update jasa set detail = '$detail',penanggung_jawab = '$penanggung_jawab',pelanggan_id = '$pelanggan_id',biaya_budget = '$biaya_budget' ,jasa_id = '$jasa_id',status = '$status' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('data berhasil diubah.');window.location='jasa-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

