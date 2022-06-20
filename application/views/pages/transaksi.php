<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">TRANSAKSI</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Transaksi</li>
		</ol>
	</div>
	<!-- transaksi -->
	<div class="row">
		<card class="card card-body">
			<div class="button-group">
				<a target="__blank" class="btn btn-primary" href="<?= base_url('transaksi/add'); ?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;Transaksi</a>
				<a target="__blank"  class="btn btn-warning" href="<?= base_url('transaksi/cetak_ulang_struk'); ?>"><i class="fa fa-print"></i>&nbsp;&nbsp;Print ulang struk</a>
			</div>
			<div class="mt-3">
				<div class="table-responsive">
					<table style="width: 1900px" id="dataTransaksi" class="table table-bordered table-hover mb-4 mt-3">
						<thead>
							<tr>
								<th>ID TRANSAKSI</th>
								<th>Tanggal</th>
								<th>Nama</th>
								<th>Item</th>
								<th>Qty</th>
								<th>Bln Bayar</th>
								<th>Subtotal</th>
                                <th>Cash</th>
								<th>tunggakan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($DataTransaksi)) {
								foreach ($DataTransaksi as $transaksi) {
									?>
									<tr>
										<td><?= $transaksi->id_transaksi; ?></td>
										<td><?= tgl_indo($transaksi->tanggal_transaksi); ?></td>
										<td><?= $transaksi->nama; ?> ( <?= $transaksi->nisn; ?> )</td>
										<td>
                                            <?php
                                            $str = "[ ";
                                            $trans = $this->db->query("SELECT tbl_produk.nama_produk FROM tbl_trans INNER JOIN tbl_produk ON tbl_trans.kode_produk = tbl_produk.kode_produk WHERE tbl_trans.id_transaksi='".$transaksi->id_transaksi."'");
                                            foreach ($trans->result_array() as $tr) {
                                                $str .= "{$tr['nama_produk']},";
                                            }
                                            $str = trim($str,',');
                                            $str .= " ]";
                                            echo $str;
                                            ?>
                                        </td>
										<td><?= $transaksi->qty; ?></td>
										<td><?= $transaksi->bulan_bayar; ?></td>
										<td>
											<?php 
											if (!empty($transaksi->qty)) {
												echo"Rp. ".number_format((int)$transaksi->subtotal,0,'','.');
											} else {
												echo "-";
											}
											?>
										</td>
                                        <td>Rp. <?= number_format((int)$transaksi->total_bayar,0,'','.') ?></td>
										<td><?= $transaksi->kurang_bayar <= 0 ? '0' : 'Rp. '.number_format($transaksi->kurang_bayar,0,'','.');  ?> </td>
										<?php
										if ($transaksi->kurang_bayar > 0) {
											?>
											<td><a onclick="window.open('<?= base_url('transaksi/lunasi/'.$transaksi->id_transaksi) ?>', '_blank', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');return true;"  class="btn btn-sm btn-warning" href="#">Lunasi</a></td>
											<?php 
										}  else {
											?>
											<td><b class="text-success">LUNAS</b></td>
											<?php
										}
										?>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</card>
	</div>
</div>
<script>
        $(document).ready(function() {
            $('#dataTransaksi').DataTable(); // ID From dataTable 
        });
    </script>