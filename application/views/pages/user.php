 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">USER</h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </div>
          <style>
            .card-sess{
              width: 90%;
              border: 1px solid #dfdfdf;
              box-shadow: 1px 1px 1px 1px #dfdfdf;
            }
            .card-table{
              border: 1px solid #dfdfdf;
            }
            .card-title{
              border: 1px solid #dfdfdf;
              height: 75px;
              background-color: #dfdfdf;
            }
            .title{
              width: 90%;
              color: #4d4d4d;
              margin-top: 10px;
            }
            .button-page{
              width: 90%;
            }
            .button-add{
              outline: none;
              border: none;
              padding: 7px;
              width: 80px;
              color: #fff;
            }
            .button-add:hover{
              opacity: .8;
            }
            .table{
              border-collapse: collapse;
              padding-top: 10px;
              margin: 0 auto;
            }
            .btn_edit, .btn_del{
              outline: none;
              border: none;
              font-size: 16px;
            }
          </style>

<!-- card wrapper -->
<?= $this->session->flashdata('message'); ?>

<div class="card-sess rounded mx-auto">
<!-- card title -->
<div class="card-title d-flex align-items-center">
  <div class="title mx-auto">
  <h3>DATA USER</h3>
  </div>
</div>
<!-- add button -->
<div class="button-page d-flex align-items-center justify-content-between mx-auto">
<div class="wrap-btn">
  <a href="<?= base_url('user/add'); ?>" class="button-add btn btn-primary rounded mt-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;User</a>
</div>
</div>
<!-- table -->
<div class="card-table rounded-bottom w-100 h-100 mt-4 p-4 0mx-auto">
<table id='tabelUser' class="table w-100 border-top border-dark mt-4 mb-4">
  <thead>
    <tr>
      <th scope="col" class="text-center">#</th>
      <th scope="col">Username</th>
      <th scope="col">Hak Akses</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php 
    if(!empty($DataUser)){
        $akses = array(
            1 => 'admin',
            2 => 'petugas',
            3 => 'kepsek'
        );
        $i = 0; 
        foreach($DataUser as $value){ 
            $i++;
            ?>
    <tr>
      <th scope="row" class="text-center"><?= $i ?></th>
      <td><?= $value->username; ?></td>
      <td><?= isset($akses[$value->akses]) ? $akses[$value->akses] : "unknown"; ?></td>
      <td class="text-center">
      <a  href="<?= base_url("user/update/".$value->id); ?>" class="btn_del btn-sm btn-primary"><i class="fa fa-pen"></i></a> |
          <a onclick="return confirm('Apakah anda yakin?');" href="<?= base_url("user/delete/".$value->id); ?>" class="btn_del btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
    </tr>
             <?php
        }
    }
    ?>

    
    <!-- <tr>
      <th scope="row" class="text-center">1</th>
      <td>USR-01</td>
      <td>ahidyete</td>
      <td>yo ndak tau kok tanya saya</td>
      <td>Admin</td>
      <td class="action d-flex justify-content-between w-75 mx-auto"><a href="blank - edit data.html" class="btn_edit d-flex justify-content-center align-items-center btn-warning"><i class="fa fa-pen"></i></a>|<a href="#" class="btn_del d-flex justify-content-center align-items-center btn-danger"><i class="fa fa-trash"></i></a></td>
    </tr>
    <tr>
      <th scope="row" class="text-center">1</th>
      <td>USR-01</td>
      <td>ahidyete</td>
      <td>yo ndak tau kok tanya saya</td>
      <td>Petugas</td>
      <td class="action d-flex justify-content-between w-75 mx-auto"><a href="blank - edit data.html" class="btn_edit d-flex justify-content-center align-items-center btn-warning"><i class="fa fa-pen"></i></a>|<a href="#" class="btn_del d-flex justify-content-center align-items-center btn-danger"><i class="fa fa-trash"></i></a></td>
    </tr>
    <tr>
      <th scope="row" class="text-center">1</th>
      <td>USR-01</td>
      <td>ahidyete</td>
      <td>yo ndak tau kok tanya saya</td>
      <td>Tukang Cilok Online</td>
      <td class="action d-flex justify-content-between w-75 mx-auto"><a href="blank - edit data.html" class="btn_edit d-flex justify-content-center align-items-center btn-warning"><i class="fa fa-pen"></i></a>|<a href="#" class="btn_del d-flex justify-content-center align-items-center btn-danger"><i class="fa fa-trash"></i></a></td>
    </tr> -->
  </tbody>
</table>
</div>
</div>
<hr style="visibility: hidden;">
          <!-- Modal Logout -->

</div>
<script>
  	$(document).ready(function() {
            $('#tabelUser').DataTable(); // ID From dataTable 
        });
</script>        <!---Container Fluid-->

<?php
// var_dump($DataUser);
?>