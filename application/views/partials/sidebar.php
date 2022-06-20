 <!-- Sidebar -->
 <?php

$CI = &get_instance();
$model = $CI->load->model("UserModel");
$sessionId = $this->session->userdata("user_id");
$userData = $CI->UserModel->getDataUsersBySession($sessionId);
?>
 <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('dashboard');?>">
    <div class="sidebar-brand-icon">
      <i class="fa fa-2x fa-users"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Dashboard</div>
  </a>
  <div class="sidebar-heading mt-5" >
    Features
  </div>
  <li class="nav-item active">
    <a class="nav-link" href="<?=base_url('dashboard');?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>
    <?php if ($this->session->userdata("akses") !== "kepsek"): ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
        aria-controls="collapsePage">
        <i class="fas fa-fw fa-cubes"></i>
        <span>Data Master</span>
      </a>
      <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?=base_url("product");?>">Data Produk</a>
          <a class="collapse-item" href="<?=base_url("siswa");?>">Data Siswa</a>
          <?php
//jika hak aksesnya admin bisa tambah user
if ($this->session->userdata("akses") === "admin") {
    echo "<a class=\"collapse-item\" href=\"" . base_url('user') . "\">Data User</a>";
}
?>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url("transaksi");?>">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Transaksi</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url('laporan-transaksi')?>">
        <i class="fas fa-fw fa-file-pdf"></i>
        <span>Laporan</span>
      </a>
    </li>
    <?php
if ($this->session->userdata("akses") === "admin") {
    ?>
     <li class="nav-item">
      <a class="nav-link" href="<?=base_url("setting");?>">
        <i class="fas fa-fw fa-cog"></i>
        <span>Setting</span>
      </a>
    </li>
    <?php
}
?>

  <hr class="sidebar-divider">
  <li class="nav-item">
    <a onclick="return confirm('apakah anda yakin?');" class="nav-link" href="<?=base_url('dashboard/logout')?>">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Sign out</span>
    </a>
  </li>
<?php endif;?>
<?php if ($this->session->userdata("akses") === "kepsek"): ?>
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url('laporan-transaksi')?>">
        <i class="fas fa-fw fa-file-pdf"></i>
        <span>Laporan</span>
      </a>
    </li>
    <?php endif;?>
</ul>
<!-- Sidebar -->
<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <!-- TopBar -->
    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
      <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img class="img-profile rounded-circle" src="<?=base_url('assets/img/man.png');?>" style="max-width: 60px">
          <span class="ml-2 d-none d-lg-inline text-white small"><?=$userData->username;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a onclick="return confirm('apakah anda yakin?')" class="dropdown-item" href="<?=base_url('dashboard/logout');?>">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
        <!-- Topbar -->