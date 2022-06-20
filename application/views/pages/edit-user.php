 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">EDIT USER</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">user</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit user</li>
		</ol>
	</div>
          <style>
            .card-sess{
              width: 90%;
              border: 1px solid #dfdfdf;
              box-shadow: 1px 1px 1px 1px #dfdfdf;
            }
            .input-title{
              border: 1px solid #dfdfdf;
              height: 75px;
              background-color: #dfdfdf;
            }
            .title{
              width: 85%;
              color: #4d4d4d;
              margin-top: 10px;
            }
            form{
              width: 85%; 
            }
            input, select{
              width: 70%;
              height: 40px;
              box-shadow: 1px 1px 1px 1px #dfdfdf;
              margin-right: 30px;
              margin-top: 15px;
            }
            select{
              border: 2px solid #ccc;
              padding-left: 12px;
            }
            input[type=text], input[type=password]{
              padding: 12px 20px;
              border: 2px solid #ccc;
              box-sizing: border-box;
              -webkit-transition: 0.5s;
              transition: 0.5s;
              outline: none;
            }
            input[type=text]:focus, input[type=password]:focus{
              border: 2px solid rgb(146, 146, 146);
            }
            .card-table{
              border: 1px solid #dfdfdf;
              box-shadow: 1px 1px 1px 1px #dfdfdf;
            }
            .button-add, .button-cancel{
              outline: none;
              border: none;
              padding: 7px;
              width: 165px;
              color: #fff;
              font-size: 14px;
            }
            .button-cancel{
              width: 80px;
              outline: none;
              border: none;
            }
            .button-add:hover{
              opacity: .8;
            }
            .btn-control{
              margin-right: 30px;
            }
            .table{
              border-collapse: collapse;
              padding-top: 10px;
              margin: 0 auto;
            }
          </style>
          <?= $this->session->flashdata('message'); ?>
<div class="card-sess d-flex flex-column h-100 rounded mx-auto">
  <div class="input-title d-flex align-items-center w-100">
    <div class="title mx-auto">
    <h3>EDIT DATA USER</h3>
    </div>
  </div>
  <hr>
  <div class="card-form">
  <form action="" method="POST" class="d-flex flex-column justify-content-center h-100 mx-auto">
   
    <label for="username" class="id d-flex align-items-center justify-content-between ">
      <span>Username :</span> <input class="username rounded" value='<?= $dataUser->username; ?>' type="text" name="username" id="username" placeholder="exp. ahidyete">
    </label>
    <label for="password" class="id d-flex align-items-center justify-content-between ">
      <span>Password :</span><input class="password rounded" type="text" name="password" id="password" placeholder="exp. yo ndak tau kok tanya saya">
    </label>
    <label for="accesspermission" class="accesspermission d-flex align-items-center justify-content-between ">
      <span>Hak Akses :</span> 
      <select name="accesspermission" id="accesspermission" class="rounded">
        <option value="">-</option>
        <option <?= $dataUser->akses == 1 ? "selected" : ''; ?> value="1">Admin</option>
        <option <?= $dataUser->akses == 2 ? "selected" : ''; ?> value="2">Petugas</option>
        <option <?= $dataUser->akses == 3 ? "selected" : ''; ?> value="3">Kepsek</option>
      </select>
    </label>
    <label for="" class="btn-control d-flex justify-content-end">
    <button type="submit" name='submit' class="button-add btn-primary mt-4"><i class="fa fa-file-export"></i> Simpan perubahan</button>
    <button type="button" onclick='window.history.back()' class="button-cancel btn-danger mt-4 ml-2"><i class="fa fa-ban"></i> Batal</button>
    </label>
    <hr>
  </form>
  </div>
</div>
<hr style="visibility: hidden;">
</div>
        <!---Container Fluid-->