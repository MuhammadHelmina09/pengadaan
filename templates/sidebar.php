  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #b23119 !important;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center" style="border-color: transparent;">
      <span class="brand-text font-weight-light" style="font-size: 14px;">CV ABC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex " >
        <div class="info">
          <a href="#" class="d-block text-white">Selamat datang <?= $_SESSION['nama']; ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link text-white">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
<?php if($_SESSION['level'] == 'admin') { ?>
           <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview " style="display: none;">
              <li class="nav-item">
                <a href="karyawan-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>Data Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pelanggan-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="supplier-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>Data Supplier</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="pelayanan-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>Kategori Pelayanan Jasa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stok-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>Daftar Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="barang-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="user-index.php" class="nav-link text-white">
                   <i class="far fa-folder nav-icon"></i>
                  <p>User</p>
                </a>
              </li> -->
            </ul>
          </li> 
        <?php } ?>
          
        <!--   <li class="nav-item">
            <a href="perbaikan-index.php" class="nav-link text-white">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Inventaris
              </p>
            </a>
          </li> -->
        

  <?php if(($_SESSION['level'] == 'admin') || ($_SESSION['level'] == 'pelanggan')) { ?>
          <li class="nav-item">
            <a href="jasa-index.php" class="nav-link text-white">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Transaksi Jasa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="permintaan-index.php" class="nav-link text-white">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Transaksi Permintaan
              </p>
            </a>
          </li>
            <?php } ?>
             <?php if($_SESSION['level'] == 'admin') { ?>
          <li class="nav-item">
            <a href="pengadaan-index.php" class="nav-link text-white">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Transaksi Pengadaan
              </p>
            </a>
          </li>
               <?php } ?>
            
             <?php if($_SESSION['level'] == 'admin') { ?>
          <li class="nav-item">
            <a href="laporan-index.php" class="nav-link text-white">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
        <?php } ?>

       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>