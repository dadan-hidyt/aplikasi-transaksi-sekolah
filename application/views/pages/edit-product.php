<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-0">
		<h1 class="h3 mb-0 text-gray-800">Edit produk</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('product'); ?>">produk</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit produk</li>
		</ol>
	</div>
	<!-- halaman edit product -->
	<?php 
	//jika data yang di kirim dari controller NULL
	//redirect ke halaman produk
	if (is_null($data_product)) {
		redirect("product");
		exit;
	}
	?>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12">
			<div class="mt-4 mb-4">
				<div class="card">
					<div class="card-body">
						<?php if (!empty($this->session->flashdata('update_error'))): ?>
							<p class="alert alert-danger"><?= $this->session->flashdata('update_error'); ?></p>
						<?php endif ?>
						<form method="POST" action="">
							<div class="form-group">
								<label for="">Product name</label>
								<input type="text" name="product_name" value="<?= $data_product->nama_produk; ?>" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Product Price</label>
								<input type="number" name="product_price" value="<?= $data_product->harga_produk; ?>" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-primary" name="edit"><i class="fa fa-pen"></i></button>	
							</form>
							<button type="button" onclick="window.history.back()" class="btn btn-danger"><i class="fa fa-arrow-left"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>