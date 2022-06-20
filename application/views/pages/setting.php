<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">SETTING</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">setting</li>
		</ol>
	</div>
	<?=$this->session->flashdata('message');?>
	<!-- laporan transaksi -->
	<form action='<?= base_url('setting'); ?>' enctype="multipart/form-data" method="POST">
	<div class="form-group">
    <label for="inputName">Logo</label>
    <input type="file" name="file-logo" class="form-control">
  </div>
  <div class="form-group">
    <label for="inputName">Nama Intansi</label>
    <input type="text" value="<?= $setting->nama_intansi; ?>" class="form-control" id="inputName" name="nama_intansi" aria-describedby="nameHelp" placeholder="Masukan nama intansi">
  </div>
  <div class="form-group">
    <label for="InputEmail">Email</label>
    <input type="email" value="<?= $setting->email; ?>" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Masukan email">
  </div>
  <div class="form-group">
    <label for="inputTelp">No Telepon</label>
    <input type="tel" class="form-control" value="<?= $setting->no_hp; ?>" id="inputTelp" name="telpon" aria-describedby="telpHelp" placeholder="Masukan no telepon">
  </div>
	<div class="form-group">
		<label for="alamat">Alamat</label>
		<textarea name="alamat"  cols="6" rows="6" class="form-control">
			<?= $setting->alamat; ?>
		</textarea>
	</div>
  <div class="mt-3"></div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
	<!-- laporan transaksi -->
</div>