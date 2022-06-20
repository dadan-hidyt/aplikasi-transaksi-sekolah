<!-- css -->
<style>
  .tabhead {
    width: 90%;
    border: 1px solid #dfdfdf;
    box-shadow: 1px 1px 1px 1px #dfdfdf;
  }

  .tabtitle {
    height: 75px;
    border: 1px solid #dfdfdf;
    background-color: #dfdfdf
  }

  .title {
    width: 96%;
    margin-top: 10px;
  }
</style>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">PRODUK</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Produk</li>
    </ol>
  </div>
  <div class="tabhead mx-auto rounded">
    <div class="tabtitle d-flex align-items-center w-100">
      <h3 class="title mx-auto">DATA PRODUK</h3>
    </div>
    <div class="tables">
      <div class="mt-3"></div>
      <a href="<?= base_url('product/add'); ?>" class="btn btn-primary ml-4"><i class="fa fa-plus"></i>&nbsp;&nbsp;Produk</a>
      <div class="mb-3"></div>
      <!-- Simple Tables -->
      <div class="card">
        <?php if (!empty($this->session->flashdata('suksess_tambah_data'))) : ?>
          <?= $this->session->flashdata('suksess_tambah_data'); ?>
        <?php endif ?>
        <?php if (!empty($this->session->flashdata("update_success"))) : ?>
          <p class="alert alert-success"><?= $this->session->flashdata("update_success"); ?></p>
        <?php endif ?>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Total: <?= count($productData); ?></h6>
        </div>
        <div class="table-responsive p-4">
          <table id="tableProduct" class="table align-items-center table-flush mt-3 mb-3">
            <thead class="thead-light">
              <tr>
                <th>Kode</th>
                <th>Produk item</th>
                <th>Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($productData) > 0) : ?>
                <?php foreach ($productData as $items) : ?>
                  <tr>
                    <td><?= $items->kode_produk; ?></td>
                    <td><?= $items->nama_produk; ?></td>
                    <td>Rp. <?= number_format($items->harga_produk, 2, ",", ".") ?></td>
                    <td><a href="<?= base_url('product/edit_product/' . $items->kode_produk); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </a>&nbsp;<a onclick="return confirm('Apakah anda yaking ingin menghapus data ini?');" href="<?= base_url('product/delete/' . $items->kode_produk); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td rowspan="5">Tidak ada data</td>
                </tr>
              <?php endif; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->

</div>
<!---Container Fluid-->
<script>
  $(document).ready(function() {
    $('#tableProduct').DataTable();
  });
</script>