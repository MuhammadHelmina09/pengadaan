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
  <style>@page { size: A4  landscape}
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
     $tahun = $_GET['tahun'];

              include('koneksi.php'); //memanggil file koneksi
     ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25- Email : pantiasuhan@gmail.com -->
  <section class="sheet padding-10mm" style="height: auto;font-size: 10px;">
    <img src="assets/gambar/logo.png" style="width: 50px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-center" style="margin-bottom: -10px;">CV ABC</h1>
    <p class="text-center" style="margin-bottom: 0px;">JALAN ABC</p>
    <br>
    <div style="width: 100%;height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
    <h4 class="text-center">Laporan Grafik Transaksi Pertahun <?= $tahun; ?></h4>
    <hr>
     
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="chLine"></canvas>
                </div>
            </div>
            <p>Ket :</p>
            <ul>
              <li>Biru : Permintaan & Pengadaan Barang</li>
              <li>Hijau : Jasa</li>
            </ul>
        </div>
     </div>     
</div>
   <!-- 
        <table class="" style="width: 200px;font-size: 11px;float:right;margin-top: 20px;">
                    <tr>
                      <th colspan="2">KOTA A, <?= date('Y-m-d'); ?></th>
                    </tr>
                    <tr style="height: 100px;">
                      <td style="width: 50%">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Mengetahui,
                      </td>
                    </tr>
                </table> -->
  </section>
  <script src="assets/plugins/jquery/jquery.min.js"></script><script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/chart.js"></script>
  <?php
     $data = mysqli_query($koneksi, "select (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '01') as jan,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '02') as feb,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '03') as mar,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '04') as apr,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '05') as mei,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '06') as jun,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '07') as jul,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '08') as agt,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '09') as sep,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '10') as okt,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '11') as nop,
      (select sum(permintaan.jumlah_minta) from permintaan where YEAR(permintaan.tgl_permintaan) = '$tahun' AND MONTH(permintaan.tgl_permintaan) = '12') as des limit 1") or die(mysqli_error($koneksi));
     $data_r = mysqli_fetch_assoc($data);
     if(is_null($data_r['jan'])) {
       $jan = 0;
     } else {
      $jan = $data_r['jan'];
     }
     if(is_null($data_r['feb'])) {
       $feb = 0;
     } else {
      $feb = $data_r['feb'];
     }
     if(is_null($data_r['mar'])) {
       $mar = 0;
     } else {
      $mar = $data_r['mar'];
     }
     if(is_null($data_r['apr'])) {
       $apr = 0;
     } else {
      $apr = $data_r['apr'];
     }
     if(is_null($data_r['mei'])) {
       $mei = 0;
     } else {
      $mei = $data_r['mei'];
     }
     if(is_null($data_r['jun'])) {
       $jun = 0;
     } else {
      $jun = $data_r['jun'];
     }
     if(is_null($data_r['jul'])) {
       $jul = 0;
     } else {
      $jul = $data_r['jul'];
     }
     if(is_null($data_r['agt'])) {
       $agt = 0;
     } else {
      $agt = $data_r['agt'];
     }
     if(is_null($data_r['sep'])) {
       $sep = 0;
     } else {
      $sep = $data_r['sep'];
     }
     if(is_null($data_r['okt'])) {
       $okt = 0;
     } else {
      $okt = $data_r['okt'];
     }
     if(is_null($data_r['nop'])) {
       $nop = 0;
     } else {
      $nop = $data_r['nop'];
     }
     if(is_null($data_r['des'])) {
       $des = 0;
     } else {
      $des = $data_r['des'];
     }
      ?>

      <?php
     $data2 = mysqli_query($koneksi, "select (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '01') as jan1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '02') as feb1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '03') as mar1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '04') as apr1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '05') as mei1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '06') as jun1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '07') as jul1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '08') as agt1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '09') as sep1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '10') as okt1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '11') as nop1,
      (select count(*) from jasa where YEAR(jasa.tanggal) = '$tahun' AND MONTH(jasa.tanggal) = '12') as des1 limit 1") or die(mysqli_error($koneksi));
     $data_r2 = mysqli_fetch_assoc($data2);
     if(is_null($data_r2['jan1'])) {
       $jan1 = 0;
     } else {
      $jan1 = $data_r2['jan1'];
     }
     if(is_null($data_r2['feb1'])) {
       $feb1 = 0;
     } else {
      $feb1 = $data_r2['feb1'];
     }
     if(is_null($data_r2['mar1'])) {
       $mar1 = 0;
     } else {
      $mar1 = $data_r2['mar1'];
     }
     if(is_null($data_r2['apr1'])) {
       $apr1 = 0;
     } else {
      $apr1 = $data_r2['apr1'];
     }
     if(is_null($data_r2['mei1'])) {
       $mei1 = 0;
     } else {
      $mei1 = $data_r2['mei1'];
     }
     if(is_null($data_r2['jun1'])) {
       $jun1 = 0;
     } else {
      $jun1 = $data_r2['jun1'];
     }
     if(is_null($data_r2['jul1'])) {
       $jul1 = 0;
     } else {
      $jul1 = $data_r2['jul1'];
     }
     if(is_null($data_r2['agt1'])) {
       $agt1 = 0;
     } else {
      $agt1 = $data_r2['agt1'];
     }
     if(is_null($data_r2['sep1'])) {
       $sep1 = 0;
     } else {
      $sep1 = $data_r2['sep1'];
     }
     if(is_null($data_r2['okt1'])) {
       $okt1 = 0;
     } else {
      $okt1 = $data_r2['okt1'];
     }
     if(is_null($data_r2['nop1'])) {
       $nop1 = 0;
     } else {
      $nop1 = $data_r2['nop1'];
     }
     if(is_null($data_r2['des1'])) {
       $des1 = 0;
     } else {
      $des1 = $data_r2['des1'];
     }
      ?>
  </section>
<script type="text/javascript">

// chart colors
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
var chartData = {
  labels: ["Jan", "Feb", "Mar", "Apr","Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des"],
  datasets: [{
    data: [<?= $jan; ?>, <?= $feb; ?>, <?= $mar; ?>, <?= $apr; ?>, <?= $mei; ?>, <?= $jun; ?>, <?= $jul; ?>, <?= $agt; ?>, <?= $sep; ?>, <?= $okt; ?>, <?= $nop; ?>, <?= $des; ?>,],
    backgroundColor: 'transparent',
    borderColor: colors[0],
    borderWidth: 4,
    pointBackgroundColor: colors[0]
  },
  {
    data: [<?= $jan1; ?>, <?= $feb1; ?>, <?= $mar1; ?>, <?= $apr1; ?>, <?= $mei1; ?>, <?= $jun1; ?>, <?= $jul1; ?>, <?= $agt1; ?>, <?= $sep1; ?>, <?= $okt1; ?>, <?= $nop1; ?>, <?= $des1; ?>,],
    backgroundColor: colors[3],
    borderColor: colors[1],
    borderWidth: 4,
    pointBackgroundColor: colors[1]
  }]
};

if (chLine) {
  new Chart(chLine, {
  type: 'line',
  data: chartData,
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    }
  }
  });
}
/*window.print();
window.onfocus=function(){ window.close();}*/
</script>
</body>
</html>
