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
          <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
          <form action="" method="post" role="form">

            <div class="form-group">
              <label>Tanggal Permintaan</label>
              <input type="date" name="tgl_permintaan" required="" class="form-control col-sm-2" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control  col-sm-4" name="barang_id" required="" id="barang">
                <option value="">Pilih Barang</option>
                <?php
                  include('koneksi.php'); //memanggil file koneksi
                  $datas = mysqli_query($koneksi, "select * from daftar_barang") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>" data-harga_jual="<?= $row['harga_jual'] ?>"><?= $row['nama'] ?></option>
              <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Harga Jual /satuan</label>
              <input type="text" id="harga_jual" name="harga_jual"  class="form-control col-sm-4 uang" readonly="">
            </div>
              <?php   if($_SESSION['level'] == 'admin') { ?>
            <div class="form-group">
              <label>Pelanggan</label>
              <select class="form-control col-sm-4" name="pelanggan_id" required="">
                <option value="">Pilih Pelanggan</option>
                <?php

                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
              <?php } ?>
              </select>
            </div>
              <?php  } else { ?>
                <?php  $pelanggan_id = $_SESSION['user_id']; ?>
                <input type="hidden"  name="pelanggan_id" value="<?= $pelanggan_id; ?>" >

           <?php } ?>
           <!-- 
            <div class="form-group">
              <label>Pilih Marketing</label>
              <select class="form-control  col-sm-4" name="sales_id" required="">
                <option value="">Pilih</option>
                <?php
                 
                  $datas = mysqli_query($koneksi, "select * from karyawan where jabatan ='marketing'") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
              <?php } ?>
              </select>
            </div> -->
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" name="jumlah_minta" onkeyup="hitung()" required="" class="form-control col-sm-4" id="jumlah_minta">
            </div>
            <div class="form-group">
              <label>Total Permintaan</label>
              <input type="text" name="total_permintaan" readonly="" class="form-control col-sm-4" id="total_permintaan">
            </div>
            <div class="form-group">
              <label>Keterangan / Merk / Detail</label>
              
              <textarea name="ket" required class="textarea"></textarea>
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
          $barang_id = $_POST['barang_id'];
          $tgl_permintaan = $_POST['tgl_permintaan'];
          $jumlah_minta = $_POST['jumlah_minta'];
          $total_permintaan = str_replace(".", "", $_POST['total_permintaan']);
          $pelanggan_id = $_POST['pelanggan_id'];
          $ket = $_POST['ket'];

          $datas = mysqli_query($koneksi, "insert into permintaan (barang_id,pelanggan_id,tgl_permintaan,jumlah_minta,ket,total_permintaan)values('$barang_id','$pelanggan_id','$tgl_permintaan','$jumlah_minta','$ket','$total_permintaan')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='permintaan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>
<!-- <script type="text/javascript" src="assets/dist/js/jquery.mask.min.js"></script> -->
<script type="text/javascript">
  /*$(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});

            })*/
  $(function () {
    $('#barang').change(function () {
        
        var harga_jual = $('#barang option:selected').attr('data-harga_jual').toString();
      
   
          var number_string = harga_jual.toString(),
          sisa  = number_string.length % 3,
          rupiah  = number_string.substr(0, sisa),
          ribuan  = number_string.substr(sisa).match(/\d{3}/g);
            
        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
        $('#harga_jual').val(rupiah);

        hitung();
       /* var jumlah_minta = $("#jumlah_minta").val();
        var total = jumlah_minta * harga_jual;*/
        
    });
});

/*  $('input[name=harga_jual], input[name=jumlah_minta]').keyup(function() {
 
      //alert(harga_jual);
        //$('span.jumlah_minta', divParent).text();
});*/

  function hitung(){
    var harga_jual = $('input[name=harga_jual]').val();
    harga_jual = harga_jual.replace(/\./g, "");
    var jumlah_minta = $('input[name=jumlah_minta]').val();
    if (harga_jual >= 0 && jumlah_minta >= 0)
      var total = harga_jual*jumlah_minta;
      var number_string = total.toString(),
      sisa  = number_string.length % 3,
      rupiah  = number_string.substr(0, sisa),
      ribuan  = number_string.substr(sisa).match(/\d{3}/g);
        
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

        $("#total_permintaan").val( rupiah );
  }
</script>