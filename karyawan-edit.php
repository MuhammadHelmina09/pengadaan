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
            <h1>Halaman Edit Karyawan</h1>
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

          $id = $_GET['id']; //mengambil id karyawan yang ingin diubah

          //menampilkan karyawan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from karyawan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control"  value="<?= $row['nik']; ?>" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control"  value="<?= $row['nama']; ?>" >
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control  col-sm-4" name="jenkel" required="">
                <option value="">Pilih</option>
                <option value="L" <?= ($row['jenkel'] == 'L') ? 'selected' : ''; ?>>Laki - Laki</option>
                <option value="P" <?= ($row['jenkel'] == 'P') ? 'selected' : ''; ?>>Wanita</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control  col-sm-4" name="jabatan" required="">
                <option value="">Pilih</option>
                <option value="Pimpinan" <?= ($row['jabatan'] == 'Pimpinan') ? 'selected' : ''; ?>>Pimpinan</option>
                <option value="Marketing" <?= ($row['jabatan'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                <option value="Admin" <?= ($row['jabatan'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="Helper" <?= ($row['jabatan'] == 'Helper') ? 'selected' : ''; ?>>Helper</option>
              </select>
            </div>
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="no_hp" required="" class="form-control" value="<?= $row['no_hp']; ?>"  >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" value="<?= $row['alamat']; ?>" >
            </div>
            <div class="form-group">
              <label>Status Aktif</label>
              <select class="form-control  col-sm-4" name="status_aktif" required="">
                <option value="">Pilih</option>
                <option value="aktif" <?= ($row['status_aktif'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="nonaktif" <?= ($row['status_aktif'] == 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
              </select>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" value="<?= $row['username']; ?>" readonly>
            </div>

            <div class="form-group">
              <label>Password </label>
              <input type="password" name="password" class="form-control" value="<?= $row['password']; ?>" required >
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
          $id = $_POST['id'];
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $jenkel = $_POST['jenkel'];
          $jabatan = $_POST['jabatan'];
          $no_hp = $_POST['no_hp'];
          $alamat = $_POST['alamat'];
          $password = $_POST['password'];
          $status_aktif = $_POST['status_aktif'];

          mysqli_query($koneksi, "update karyawan set nik='$nik',nama='$nama',jenkel='$jenkel',jabatan='$jabatan',no_hp='$no_hp',alamat='$alamat',status_aktif='$status_aktif',password='$password' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
          echo "<script>alert('data berhasil diupdate.');window.location='karyawan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

