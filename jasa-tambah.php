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
            <h1>Halaman Tambah Jasa</h1>
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
          <form action="" method="post" role="form">

           
            <div class="form-group">
              <label>Tanggal Permintaan Jasa</label>
              <input type="date" name="tanggal" class="form-control col-4" value="<?= date('Y-m-d'); ?>" >
            </div>
            <?php  include('koneksi.php');?>
             <?php if($_SESSION['level'] == 'admin') { ?> 
            <div class="form-group">
              <label>Pilih Pelanggan</label>
              <select class="form-control col-sm-4" name="pelanggan_id" required="">
                <option value="">Pilih</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
              <?php } ?>
              </select>
            </div> 
            <?php } else { ?>
              <input type="hidden" name="pelanggan_id" value="<?= $_SESSION['user_id']; ?>">
            <?php } ?>
            <div class="form-group">
              <label>Pilih Jasa</label>
              <select class="form-control col-sm-4" name="jasa_id" required="">
                <option value="">Pilih Jasa</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from pelayanan") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama_pelayanan'] ?></option>
              <?php } ?>
              </select>
            </div>  
            <div class="form-group">
              <label>Biaya Budget</label>
              <input type="number" min="0" name="biaya_budget" class="form-control col-4" required >
            </div>
            <div class="form-group">
              <label>Detail</label>
              <textarea name="detail" class="textarea"></textarea>
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
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $jasa_id = $_POST['jasa_id'];
          $pelanggan_id = $_POST['pelanggan_id'];
          $detail = $_POST['detail'];
          $biaya_budget = $_POST['biaya_budget'];
          $tanggal = $_POST['tanggal'];
          $status = 'MENUNGGU';

          $datas = mysqli_query($koneksi, "insert into jasa (jasa_id,pelanggan_id,detail,biaya_budget,tanggal,status)values('$jasa_id','$pelanggan_id','$detail','$biaya_budget','$tanggal','$status')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='jasa-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

