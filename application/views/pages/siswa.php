<style>
	.card-wrap {
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
<div class="container" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">SISWA</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Siswa</li>
		</ol>
	</div>
	<div class="card-wrap rounded mx-auto ">
		<div class="tables">
			<div class="tabtitle d-flex align-items-center">
				<h3 class="title ml-3">TAMBAH SISWA</h3>
			</div>
			<div class="mt-3"></div>
			<a href="<?= base_url('siswa/add'); ?>" class="btn btn-primary ml-4"><i class="fa fa-plus"></i>&nbsp;&nbsp;Siswa</a>
			<a href="<?= base_url('siswa/importExcel'); ?>" class="btn btn-danger ml-4"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Import excel</a>
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
					<h6 class="m-0 font-weight-bold text-primary">Total: <?= count($DataSiswa); ?></h6>
				</div>
				<div class="table-responsive p-4">
					<table id="tabelSiswa" class="table align-items-center table-flush">
						<thead class="thead-light">
							<tr>
								<th>#</th>
								<th>Nisn</th>
								<th>Nama</th>
								<th>Tahun Masuk</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (count($DataSiswa) > 0) : $i = 0; ?>
								<?php foreach ($DataSiswa as $siswa) : $i++; ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?= strip_tags($siswa->nisn); ?></td>
										<td><?= strip_tags($siswa->nama); ?></td>
										<td><?= strip_tags($siswa->tahun_masuk); ?></td>
										<td class="text-center"><a href="<?= base_url('siswa/edit_siswa/' . $siswa->id_siswa); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </a>&nbsp;<a onclick="return confirm('Apakah anda yaking ingin menghapus data ini?');" href="<?= base_url('siswa/delete/' . $siswa->id_siswa); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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
				<div class="card-footer"></div>
			</div>
		</div>
	</div>
	<hr style="visibility: hidden">
	<!--Row-->
</div>
<script>
	$(document).ready(function() {
		$('#tabelSiswa').DataTable(); // ID From dataTable 
	});
</script>
<!---Container Fluid-->