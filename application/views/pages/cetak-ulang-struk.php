<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Cetak ulang struk</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('transaksi'); ?>">Transaksi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Cetak Ulang Struk</li>
		</ol>
	</div>
	<div class="card card-body">
		<form method="GET" action="<?= base_url('transaksi/output') ?>">
			<p class="err"></p>
			<div class="form-group">
				<label for="nisn">nisn</label>
				<select class="form-control" name="siswa" id="siswa">
					<option value="">--pilih siswa--</option>
					<?php
					if (!empty($siswa)) {
						foreach ($siswa as $value) {
					?>
							<option value="<?= $value->nisn; ?>"><?= $value->nisn . " ($value->nama)" ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="transaksi">tanggal transaksi</label>
				<select class='form-control' id="taggal-transaksi"name="transaksi">
					<option value="">--Tanggal--</option>
				</select>
			</div>
			<div id="detail-transaksi">

			</div>
			<button style="display: none;" id="btn" class="btn btn-primary mt-4">Submit</button>
		</form>
	</div>
</div>
<script>
	$(window).ready(function() {
		function error(mess,display = true){
			if (display == true) {
				$(".err").html(`<p class='alert alert-danger'>${mess}</p>`);
			} else{
				$(".err").html("");
			}
		}	
		$('#siswa').on("change", function(e) {
			let nisn = e.target.value;
			$.ajax({
				url:"<?= base_url('transaksi/getDataajax/') ?>"+nisn,
				type:"POST",
				success:function(data){
					if (data == 0) {
						$("#btn").css("display",'none');
						$("#taggal-transaksi").html(`<option value=''>--pilih tanggal--</option>`);
						error("Transaksi dengan nisn "+nisn+" tidak di temukan");
					} else {
						$("#taggal-transaksi").html(`<option value=''>--pilih tanggal--</option>${data}`);
						$("#btn").css("display",'block');
					}
				}
			});
		})
		/**
		 * TODO
		 * Membuat preview data transaksi
		 */
		// $("#taggal-transaksi").on("change",function(p) {
		// 	if (p.target.value != '') {
		// 		alert('alloh');
		// 	}
		// })
	})
</script>