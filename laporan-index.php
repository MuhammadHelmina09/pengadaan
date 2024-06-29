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
            <h1>Halaman Laporan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <tr>
              <th>Nama TTD</th>
              <th>
                <?php   
                include('koneksi.php');
                  $data_ttd   = mysqli_query($koneksi, "select * from pengaturan where id = '1'");
                   $row_ttd  = mysqli_fetch_assoc($data_ttd);
                   ?>
                   <form action="" method="post" role="form">
                    <div class="input-group">
                  <input type="text" name="ttd" class="form-control form-control-sm col-4" value="<?= $row_ttd['ttd']; ?>"  >
                  <button type="submit" class="btn btn-primary btn-sm" name="submit" value="simpan">Update</button>
                </div>
          </form>
          <?php
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = '1';
          
          $ttd = $_POST['ttd'];

          $datas = mysqli_query($koneksi, "update pengaturan set ttd = '$ttd' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>window.location='laporan-index.php';</script>";
        }
        ?>
              </th>
            </tr>
            <tr class="bg-asd">
              <th>Nama Laporan</th>
              <th>Button Cetak</th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Pelanggan - Jenis Kelamin</th>
              <th> <form method="get" action="laporan-pelanggan-jenkel.php" class="form-inline">
                   <!--   <select class="form-control  col-sm-4" name="jenkel" required="">
                <option value="">Pilih</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
              </select> -->
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Barang & Jasa Perbulan</th>
              <th> <form method="get" action="laporan-barang_jasa.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required="">
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Pengadaan Perbulan</th>
              <th> <form method="get" action="laporan-pengadaan_perbulan.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required="">
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Pengadaan Perminggu</th>
              <th> <form method="get" action="laporan-pengadaan_perminggu.php" class="form-inline">
                    <input type="week" class="form-control form-control-sm" name="tgl" required="">
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Pengadaan Perhari</th>
              <th> <form method="get" action="laporan-pengadaan_perhari.php" class="form-inline">
                    <input type="date" class="form-control form-control-sm" name="tgl" required="">
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Permintaan Perbulan</th>
              <th> <form method="get" action="laporan-permintaan.php" class="form-inline">
                    <input type="month" class="form-control form-control-sm" name="bulan" required="">
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan History Transaksi Pelanggan</th>
              <th> <form method="get" action="laporan-pelanggan.php" class="form-inline">
                   <select class="form-control col-sm-4" name="pelanggan_id" required="">
                <option value="">Pilih Pelanggan</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
              <?php } ?>
              </select>
                    <button type="submit" class="btn bg-warning btn-sm" name="submit" >Cetak!</button>
                </form>
              </th>
            </tr>

            <tr>
              <th style="vertical-align: middle;">Laporan Grafik Transaksi Pertahun</th>
              <th><form method="get" action="laporan-grafik_transaksi.php" class="form-inline">
                  <select class="form-control form-control-sm" name="tahun" required="">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select>
                   
                    <button type="submit" class="btn btn-warning btn-sm" name="submit" >Cetak!</button>
                </form></th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">Laporan Grafik Realisasi Pengadaan Pertahun</th>
              <th><form method="get" action="laporan-realisasi.php" class="form-inline">
                  <select class="form-control form-control-sm" name="tahun" required="">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select>
                   
                    <button type="submit" class="btn btn-warning btn-sm" name="submit" >Cetak!</button>
                </form></th>
            </tr>
          </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('templates/footer.php');
  ?>
