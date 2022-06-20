<style>
	.card-wrap{
		width: 90%;
		border: 1px solid #dfdfdf;
		box-shadow: 1px 1px 1px 1px #dfdfdf !important;
	}
</style>
<div class="container-fluid container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-0">
		<h1 class="h3 mb-0 text-gray-800">TAMBAH PRODUK</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('product'); ?>">Product</a></li>
			<li class="breadcrumb-item active" aria-current="page">Add new product</li>
		</ol>
	</div>
	<?= $this->session->flashdata('error_tambah_data'); ?>
	<!-- card -->
	<div class="card-wrap rounded mt-4 mx-auto">
	<div class="card card-body">
		<form action="" method="POST">
			<div class="form-group">
				<label for="product_name">Nama Product</label>
				<input type="text" name="nama_produk" placeholder="inputkan nama produk" class="form-control">
			</div>
			<div class="form-group">
				<label for="product_name">Harga Product</label>
				<input type="text" name="harga_produk" placeholder="inputkan harga produk" class="form-control">
			</div>
			<div class="form-group">
				<button name="add_product" class="btn btn-primary"><i class="fa fa-plus"></i></button>
			</form>
			<button type="button"  onclick="window.history.back()" class="btn btn-warning"><i class="fa fa-arrow-left"></i> </button>
		</div>
	</div>
	</div>
</div>