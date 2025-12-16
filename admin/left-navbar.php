<?php require('../model/AdminUser.php'); ?>

<!-- Font Awesome -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<style>
  .dropdown-menu {
    min-width: 150px;
    text-align: center;
  }

  aside {
    position: fixed !important;
  }

  .dropdown-menu>a:hover {
    background: #dee3e3;
  }
  li{
    font-size: 11px;
  }

.navbar-badge {
  position: absolute;
  top: 5px;
  right: 2px;
  font-size: 11px;
  min-width: 18px;       /* 🔑 important */
  height: 18px;
  line-height: 18px;
  text-align: center;
  padding: 0 4px;
}

  /* span {
    color: white !important;
  } */
</style>

<nav class="main-header navbar navbar-expand navbar-dark bg-primary navbar-lg">

  <!-- LEFT -->
  <ul class="navbar-nav">
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- RIGHT -->
  <ul class="navbar-nav ml-auto align-items-center">

    <!-- NOTIF -->
    <li class="nav-item dropdown">
      <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true">
        <i class="fas fa-bell fa-lg"></i>

        <?php if ($jumlah_notif > 0): ?>
          <span class="badge badge-danger navbar-badge">
            <?= $jumlah_notif ?>
          </span>
        <?php endif; ?>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">Notifikasi</span>

        <?php if ($jumlah_notif > 0): ?>
          <?php foreach ($notifikasi as $n): ?>
            <a href="#" class="dropdown-item">
              <span class="float-right text-muted text-sm">
                <?= $n['nama_barang'] ." sisa ". $n['jumlah'] . " " .$n['satuan'] ?>
              </span>
            </a>
            <div class="dropdown-divider"></div>
          <?php endforeach; ?>
        <?php else: ?>
          <span class="dropdown-item text-muted">Tidak ada notifikasi</span>
        <?php endif; ?>
      </div>
    </li>

    <!-- PROFILE -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <div class="d-sm-inline-block user-panel">
          <img src="../dist/img/admin/<?php echo $admin['foto'] ?>"
               class="img-circle elevation-2" alt="User Image">
          <span class="dropdown-toggle">
            <b><?php echo $admin['nama'] ?></b>
          </span>
        </div>
      </a>

      <div class="dropdown-menu dropdown-menu-right">
        <a href="../login_admin/logout_admin.php" class="dropdown-item">
          Keluar
        </a>
      </div>
    </li>

  </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b> Inventori </b></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
        <?php if ($_SESSION['role_id'] == 1) { ?>
        <li class="nav-item">
          <a href="user.php" class="nav-link active" id="user">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Data Pengguna
            </p>
          </a>
        </li>
        <?php }?>
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="barang.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              
            <?php if ($_SESSION['role_id'] != 3) { ?>
              <li class="nav-item">
                <a href="jenisBarang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="satuanBarang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satuan Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="supplierBarang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Supplier</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="barangMasuk.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="barangKeluar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php }?>
          <?php if ($_SESSION['role_id'] == 1) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporanSupplier.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporanMasuk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporanGudang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Gudang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporanKeluar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  $(document).ready(function() {
    var active = $('.breadcrumb').attr('id');

    $(".nav-link").removeClass("active");

    // $(".nav-link").attr('id', active).addClass('active');
    var a = $(".nav-link#" + active).addClass('active');
  });
</script>



<?php
$alerts = $_SESSION['alerts'] ?? [];
?>

<!-- <script>
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",    
    showConfirmButton: false,   // button Tutup tidak diperlukan
    closeButton: true,          // → munculkan tombol X
    timer: 0,                   // tidak auto-close
    timerProgressBar: false
});

<?php foreach ($alerts as $a): ?>ss
Toast.fire({
    icon: "<?= $a['icon'] ?>",
    html: "<?= $a['message'] ?>"
}).then(() => {
    // Hapus session lewat AJAX ketika tombol tutup ditekan
    fetch('clear_alerts.php')
        .then(() => console.log("Session alert cleared"));
});
<?php endforeach; ?>
</script> -->