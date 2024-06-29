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
            <h1>Halaman Pengadaan</h1>
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
          <form action="" method="post" role="form" enctype="multipart/form-data">

            <div class="form-group">
              <label>Tanggal Pengadaan</label>
              <input type="date" name="tgl_pengadaan" required="" class="form-control col-sm-2" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group">
              <label>Pilih Permintaan</label>
              <select class="form-control  col-sm-12" name="permintaan_id" required="" >
                <option value="">Pilih Permintaan</option>
                <?php
                  include('koneksi.php'); //memanggil file koneksi
                  $datas = mysqli_query($koneksi, "select permintaan.*, daftar_barang.nama,daftar_barang.satuan, pelanggan.nama as nama_pel from permintaan JOIN daftar_barang ON daftar_barang.id = permintaan.barang_id JOIN pelanggan ON pelanggan.id = permintaan.pelanggan_id where permintaan.id NOT IN (select permintaan_id from pengadaan) group by permintaan.id") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>" > Barang : <?= $row['nama'] ?> // Pelanggan : <?= $row['nama_pel'] ?> // Permintaan : <?= $row['jumlah_minta'] ?> <?= $row['satuan'] ?> // Total : Rp <?= rupiah($row['total_permintaan']);?> </option>
              <?php } ?>
              </select>
            </div>

            

            <div class="form-group">
              <label>Keterangan</label>
              
              <textarea name="ket" class="textarea"></textarea>
            </div>
            <div class="form-group">
              <label>Bukti ACC</label>
              <input type="file" name="foto" class="form-control col-sm-4" required="" >
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
          $status = 'SEDANG DIPROSES';
          $permintaan_id = $_POST['permintaan_id'];
          $ket = $_POST['ket'];
          $tgl_pengadaan = $_POST['tgl_pengadaan'];

           $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);

          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = NULL;
          }
          
          $foto = $nama_unik1;

          $datas = mysqli_query($koneksi, "insert into pengadaan (status,permintaan_id,tgl_pengadaan,ket,foto)values('$status','$permintaan_id','$tgl_pengadaan','$ket','$foto')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='pengadaan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>