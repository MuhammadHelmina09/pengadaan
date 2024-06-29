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
    @page { size: A4 landscape}
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
<body class="A4 landscape">
     <?php

              include('koneksi.php'); //memanggil file koneksi
               $id = $_GET['pelanggan_id']; //mengambil id pelanggan yang ingin diubah

          //menampilkan pelanggan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from pelanggan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
     ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25- -->
  <section class="sheet padding-10mm" style="height: auto;font-size: 10px;">
    <img src="assets/gambar/logo.png" style="width: 50px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-center" style="margin-bottom: -10px;">CV ABC</h1>
    <p class="text-center" style="margin-bottom: 0px;">JALAN ABC</p>
    <br>
    <div style="width: 100%;height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
      <h4 class="text-center">LAPORAN HISTORY PELANGGAN : <?= $row['nama']; ?></h4>
        <hr>
        
        <table class="table table-bordered" id="example2">
          <thead>
            <tr>
              <th colspan="4">Data Pelanggan</th>
            </tr>
            <tr>
              <th>Nik : <?= $row['nik']; ?></th>
              <th>Nama : <?= $row['nama']; ?></th>
              <th>No Hp : <?= $row['hp']; ?></th>
              <th>Alamat : <?= $row['alamat']; ?></th>
            </tr>
          </thead>
        </table>
        <hr>
         <table class="table table-bordered"  id="example2">
          <thead>
            <tr colspan="6">
              <th>History Permintaan</th>
            </tr>
            <tr style="white-space: nowrap !important;">
              <th>No</th>
              <th>Tgl Permintaan</th>
              <th>Barang</th>
              <th>Jumlah Minta</th>
              <th>Total</th>
              <th>Ket.</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $datas = mysqli_query($koneksi, "select permintaan.*, daftar_barang.nama,daftar_barang.satuan, pelanggan.nama as nama_pel from permintaan JOIN daftar_barang ON daftar_barang.id = permintaan.barang_id JOIN pelanggan ON pelanggan.id = permintaan.pelanggan_id where pelanggan.id = '$id' group by permintaan.id") or die(mysqli_error($koneksi));
              $no = 1;//untuk pengurutan nomor
              //melakukan perulangan
              $sum = 0;
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr style="white-space: nowrap !important;">
            <td><?= $no; ?></td>
            <td><?=  format_tanggal($row['tgl_permintaan']); ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['jumlah_minta']; ?> <?= $row['satuan']; ?></td>
            <td>Rp <?= rupiah($row['total_permintaan']); ?></td>
            <td><?= $row['ket']; ?></td>
          </tr>

            <?php $no++; $sum += $row['total_permintaan']; } ?>
          <tr>
            <td colspan="4"></td>
            <th>Rp <?= rupiah($sum); ?></th>
            <td></td>
          </tr>
          </tbody>
        </table>
         <table class="table table-bordered"  id="example2">
          <thead>
            <tr>
              <th colspan="5">History Jasa</th>
            </tr>
            <tr  style="white-space: nowrap !important;">
              <th>No</th>
              <th>Jenis Jasa</th>
              <th>Tanggal</th>
              <th>Biaya</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
               $datas = mysqli_query($koneksi, "select jasa.*,pelayanan.nama_pelayanan, karyawan.nama as nama_pj, pelanggan.nama from jasa  left join karyawan on karyawan.id = jasa.penanggung_jawab join pelanggan on pelanggan.id = jasa.pelanggan_id join pelayanan on pelayanan.id = jasa.jasa_id where pelanggan.id = '$id' group by jasa.id") or die(mysqli_error($koneksi));
            
               $sum2 = 0;
              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr style="white-space: nowrap !important;">
            <td><?= $no; ?></td>
            <td><?= $row['nama_pelayanan']; ?></td>

            <td><?= format_tanggal($row['tanggal']); ?></td>
            <td>Rp <?= $row['biaya_budget']; ?></td>
            <td><?= $row['status']; ?></td>
          </tr>


            <?php $no++; $sum2+= $row['biaya_budget']; } ?>
            <tr>
            <td colspan="3"></td>
            <th>Rp <?= rupiah($sum2); ?></th>
            <td></td>
          </tr>
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
                        <span style="text-decoration: underline;">
                          <?php $data_ttd   = mysqli_query($koneksi, "select * from pengaturan where id = '1'");
                   $row_ttd  = mysqli_fetch_assoc($data_ttd);
                   ?>
                   <?= $row_ttd['ttd']; ?>

                        </span>
                        <br>
                      </td>
                    </tr>
                </table>
  </section>

</body>
</html>
