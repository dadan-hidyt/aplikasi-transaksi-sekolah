<style>
	.select-right{
		width: 35%;
	}
	.select-left{
		width: 35%;
	}
</style>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">LAPORAN</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Laporan</li>
		</ol>
	</div>
	<!-- laporan transaksi -->
	<div class="card">
		<div class="card-body">
			<form action="<?= base_url('laporanTransaksi/cetak') ?>">
				<div class="input-group d-flex justify-content-between w-100 p-4">
					<input type="date" class="form-control" name="start">
					<input type="date" class="form-control" name="end">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>

		</div>
	</div>
	<!-- laporan transaksi -->
</div>