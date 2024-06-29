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
            <h1>Halaman Edit Pelanggan</h1>
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

          $id = $_GET['id']; //mengambil id pelanggan yang ingin diubah

          //menampilkan pelanggan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from pelanggan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <input type="hidden" name="verif_awal" required="" value="<?= $row['verifikasi']; ?>">
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4"  value="<?= $row['nik']; ?>" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4"  value="<?= $row['nama']; ?>" >
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" required="" class="form-control col-sm-4"  value="<?= $row['email']; ?>" >
            </div>
             <div class="form-group">
              <label>Jenkel</label>
              <select class="form-control  col-sm-4" name="jenkel" required="">
                <option value="">Pilih</option>
                <option value="Pria" <?= ($row['jenkel'] == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                <option value="Wanita" <?= ($row['jenkel'] == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
              </select>
            </div> 
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="hp" required="" class="form-control col-sm-4" value="<?= $row['hp']; ?>"  >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" value="<?= $row['alamat']; ?>" >
            </div>
            <!-- <div class="form-group">
              <label>Foto</label><br>
              <img src="assets/gambar/<?= $row['foto'];?>" width="100" class="mb-3">
              <input type="file" name="foto" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div> -->
            <div class="form-group">
              <label>Verifikasi</label>
              <select class="form-control  col-sm-4" name="verifikasi" required="">
                <option value="">Pilih</option>
                <option value="sudah_verifikasi" <?= ($row['verifikasi'] == 'sudah_verifikasi') ? 'selected' : ''; ?>>Data Valid.</option>
                <option value="waiting" <?= ($row['verifikasi'] == 'waiting') ? 'selected' : ''; ?>>Waiting</option>
                <option value="data_tidak_valid" <?= ($row['verifikasi'] == 'data_tidak_valid') ? 'selected' : ''; ?>>Data Tidak Valid</option>

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

        //jika klik tombol submit maka akan melakukan perubahan
        if (isset($_POST['submit'])) {

          $email = $_POST['email'];
          $verifikasi = $_POST['verifikasi'];
          $id = $_POST['id'];
          $nik = $_POST['nik'];
          $jenkel = $_POST['jenkel'];
          $nama = $_POST['nama'];
          $hp = $_POST['hp'];
          $alamat = $_POST['alamat'];
         /* $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);
          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = $row['foto'];
          }
          $foto = $nama_unik1;*/

          mysqli_query($koneksi, "update pelanggan set verifikasi='$verifikasi',nik='$nik',nama='$nama',hp='$hp',email='$email',alamat='$alamat' ,jenkel='$jenkel' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
         echo "<script>alert('data berhasil diupdate.');window.location='pelanggan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

