<style>
	.card-wrap{
		width: 90%;
		border: 1px solid #dfdfdf;
		box-shadow: 1px 1px 1px 1px #dfdfdf;
	}
</style>

<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">EDIT SISWA</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('siswa'); ?>">siswa</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit siswa</li>
		</ol>
	</div>
	<div class="card-wrap mx-auto rounded">
		<div class="card card-body">
			<?= $this->session->flashdata('error_tambah_data'); ?>
			<form action="" method="POST">
				<div class="form-group">
					<label for="nama_siswa">Nama Siswa</label>
					<input type="text" name="nama" class="form-control" value="<?= $DataSiswa->nama; ?>">
				</div>
				<div class="form-group">
					<label for="nisn">Nisn</label>
					<input type="number" name="nisn" class="form-control" value="<?= $DataSiswa->nisn; ?>">
				</div>
				<div class="form-group">
					<label>Tahun Masuk</label>
					<select name="tahun_masuk" name="tahun_masuk" class="form-control">
						<?php
						date_default_timezone_set("asia/jakarta");
						$start = date("Y", strtotime("-5 years"));
						for ($i = (int) $start; $i < (int) date("Y"); $i++) {
							if ($i === (int) $DataSiswa->tahun_masuk) {
								echo "<option selected value='".$i."'>".$i."</option>";
							} else {
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<button name="edit_siswa" class="btn btn-primary"><i class="fa fa-file"></i> Simpan perubahan</button>
				</form>
				<button type="button" onclick="window.history.back()" class="btn btn-warning"><i class="fa fa-arrow-left"></i></button>
			</div>
		</div>
	</div>
</div>
