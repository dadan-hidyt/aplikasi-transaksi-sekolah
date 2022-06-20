<style>
	.card-wrap{
		width: 90%;
		border: 1px solid #dfdfdf;
    	box-shadow: 1px 1px 1px 1px #dfdfdf;
	}
</style>
<div class="container" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">TAMBAH SISWA</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('siswa'); ?>">Siswa</a></li>
			<li class="breadcrumb-item active" aria-current="page">Tambah siswa</li>
		</ol>
	</div>
	<!-- halaman tambah siswa -->
	<div class="card-wrap mx-auto rounded">
		<div class="card card-body">
			<?= $this->session->flashdata('error_tambah_data'); ?>
			<form method="POST" action="">
				<div class="form-group">
					<label for="nama_siswa">Nama siswa</label>
					<input type="text" name="nama_siswa" class="form-control">
				</div>
				<div class="form-group">
					<label>Nisn</label>
					<input type="number" id="nisn" name="nisn" class="form-control">
				</div>
				<div class="form-group">
					<label>Tahun Masuk</label>
					<select name="tahun_masuk" name="tahun_masuk" class="form-control">
						<?php
						date_default_timezone_set("asia/jakarta");
						$start = date("Y", strtotime("-5 years"));
						for ($i = $start; $i < (int) date("Y"); $i++) {
							echo "<option value='".$i."'>".$i."</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<button name="add_data_siswa" class="btn btn-primary"><i class="fa fa-plus"></i></button>
					<button name="back" type="button"  onclick="window.history.back()"class="btn btn-danger"><i class="fa fa-arrow-left"></i> </i></button>
				</div>
			</form>
		</div>
	</div>
</div>

