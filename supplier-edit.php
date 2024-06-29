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
            <h1>Halaman Edit Supplier</h1>
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

          $id = $_GET['id']; //mengambil id supplier yang ingin diubah

          //menampilkan supplier berdasarkan id
          $data   = mysqli_query($koneksi, "select * from supplier where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama_supplier" required="" value="<?= $row['nama_supplier']; ?>" class="form-control" autofocus="">
            </div>
            <div class="form-group">
              <label>Hp</label>
              <input type="text" name="no_hp" required="" value="<?= $row['no_hp']; ?>" class="form-control" >
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" required="" value="<?= $row['email']; ?>" class="form-control" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" value="<?= $row['alamat']; ?>" class="form-control" >
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
          $nama_supplier = $_POST['nama_supplier'];
          $no_hp = $_POST['no_hp'];
          $email = $_POST['email'];
          $alamat = $_POST['alamat'];

          mysqli_query($koneksi, "update supplier set nama_supplier='$nama_supplier',no_hp='$no_hp',email='$email',alamat='$alamat' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
          echo "<script>alert('data berhasil diupdate.');window.location='supplier-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

