<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">  
  <title>LAPORAN</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="assets/dist/css/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="assets/dist/css/paper.css">
  <link rel="stylesheet" href="assets/dist/css/bs.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "" if you need -->
  <style>
body {
  background-color: #999;
}
    @page { size: A4 }
* {
  font-family: "Arial";
}
.text-center {
  text-align: center;
}
h1 {
  font-size: 20px;
}
h3 {
  font-size: 14px;
  font-weight: normal;
  margin-top: -8px;
}
h4 {
  margin-top: 20px;
  text-transform: uppercase;
  margin-bottom: -10px;
}
td {
  padding: 5px !important;
  text-align: center;
  vertical-align: middle !important;
 /* border-color: #fff !important;
  padding: 5px !important;*/
  /*text-transform: capitalize;*/
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 ">
     <?php
    if(isset($_GET['bulan'])) {
                    $bul = date("m", strtotime($_GET['bulan']));
                    $tah = date("Y", strtotime($_GET['bulan']));
                }
     ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25- -->
  <section class="sheet padding-10mm" style="height: auto;font-size: 10px;">
    <img src="assets/gambar/logo.png" style="width: 50px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-center" style="margin-bottom: -10px;">CV ABC</h1>
    <p class="text-center" style="margin-bottom: 0px;">JALAN ABC</p>
    <br>
    <div style="width: 100%;height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
      <h4 class="text-center">LAPORAN Barang & Jasa PERIODE : <?= date("M", strtotime($_GET['bulan']));  ?> <?= date("y", strtotime($_GET['bulan']));  ?></h4>
        <hr>
        <table class="table table-bordered" id="example2">
          <thead>
            <tr>
              <th colspan="6">Pengadaan Barang</th>
            </tr>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Satuan</th>
              <th>Harga Jual</th>
              <th>Total Permintaan</th>
              <th>Total Terjual</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select daftar_barang.*, (select count(*) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tah' AND MONTH(permintaan.tgl_permintaan) = '$bul' AND permintaan.barang_id = daftar_barang.id) as total_permintaan,(select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tah' AND MONTH(permintaan.tgl_permintaan) = '$bul' AND permintaan.barang_id = daftar_barang.id) as total_terjual from daftar_barang where (select count(*) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tah' AND MONTH(permintaan.tgl_permintaan) = '$bul' AND permintaan.barang_id = daftar_barang.id) > 0") or die(mysqli_error($koneksi));
              if ($datas->num_rows > 0)  { 
              $no = 1;//untuk pengurutan nomor
              $sum_harga_jual = 0;
              $sum_total_jual = 0;
              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr >
            <td ><?= $no; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['satuan']; ?></td>
            <td>Rp <?= rupiah($row['harga_jual']); ?></td>
            <td><?= $row['total_permintaan']; ?> Pelanggan</td>
            <td><?= $row['total_terjual']; ?> <?= $row['satuan']; ?></td>
          </tr>
          <?php 
            $total = $row['harga_jual'] * $row['total_terjual'];
          ?>

            <?php $no++; $sum_harga_jual+= $row['harga_jual']; $sum_total_jual+= $total; } ?>
            <tr>
              <td colspan="3"></td>    
              <td style="text-align:right;">Total Terjual</td>
              <th colspan="2" style="text-align:left;">Rp <?= rupiah($sum_total_jual); ?></th>
          
            </tr>
               <?php } else { ?>
            <tr>
              <td colspan="6">Tidak ada data.</td>
            </tr>
           <?php }  ?>
          </tbody>
        </table>
        
        <hr>

        <table class="table table-bordered" id="example2">
          <thead>

            <tr>
              <th colspan="3">Jasa</th>
            </tr>
            <tr>
              <th>No</th>
              <th>Nama Pelayanan</th>
              <th>Total Pengguna Jasa</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $datas = mysqli_query($koneksi, "select pelayanan.*, (select count(*) from jasa where YEAR(jasa.tanggal) = '$tah' AND MONTH(jasa.tanggal) = '$bul' AND pelayanan.id = jasa.jasa_id) as total_jasa from pelayanan where (select count(*) from jasa where YEAR(jasa.tanggal) = '$tah' AND MONTH(jasa.tanggal) = '$bul' AND pelayanan.id = jasa.jasa_id) > 0") or die(mysqli_error($koneksi));

              $no = 1;//untuk pengurutan nomor
          if ($datas->num_rows > 0)  { 
              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  
            <?php ?>
          <tr>
            <td ><?= $no; ?></td>
            <td><?= $row['nama_pelayanan']; ?></td>
            <td><?= $row['total_jasa']; ?> Pelanggan</td>
          </tr>
         

            <?php $no++; } ?>
              <?php } else { ?>
            <tr>
              <td colspan="3">Tidak ada data.</td>
            </tr>
           <?php }  ?>
          </tbody>
        </table>

<table style="width: 200px;font-size: 11px;float:right;margin-top: 60px;">
                    <tr>
                      <th colspan="2">KOTA A, <?= format_tanggal(date('Y-m-d')); ?></th>
                    </tr>
                    <tr style="height: 100px;">
                      <td style="width: 50%">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span style="text-decoration: underline;"><?php $data_ttd   = mysqli_query($koneksi, "select * from pengaturan where id = '1'");
                   $row_ttd  = mysqli_fetch_assoc($data_ttd);
                   ?>
                   <?= $row_ttd['ttd']; ?></span>
                        <br>
                      </td>
                    </tr>
                </table>
  </section>

</body>
</html>
