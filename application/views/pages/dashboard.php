<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>
  <?php if (!empty($this->session->flashdata('welcome_message'))): ?>
   <p class="alert alert-success"> <?= $this->session->flashdata('welcome_message'); ?></p>
 <?php endif ?>
 <div class="row mb-3">
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a href="<?= base_url('siswa'); ?>">siswa</a>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= (int) $countSiswa; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Earnings (Annual) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a href="<?= base_url("product"); ?>">Produk</a>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= (int) $productCount; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-cubes fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a href="<?= base_url("transaksi") ?>">Transaksi</a></div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= (int) $countTransaction; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Uang</div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. <?= number_format($totalUangTransaksi,0,'','.'); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
        <a href="login.html" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
</div>
</div>
</div>