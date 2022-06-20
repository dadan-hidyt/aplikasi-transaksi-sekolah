<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">EDIT SISWA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('siswa'); ?>">siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import excel</li>
        </ol>
    </div>

    <style>
        .card-sess {
            width: 90%;
            border: 1px solid #dfdfdf;
            box-shadow: 1px 1px 1px 1px #dfdfdf;
        }

        .input-title {
            border: 1px solid #dfdfdf;
            height: 75px;
            background-color: #dfdfdf;
        }

        .title {
            width: 85%;
            color: #4d4d4d;
            margin-top: 10px;
        }

        form {
            width: 85%;
        }

        input,
        select {
            width: 70%;
            height: 40px;
            box-shadow: 1px 1px 1px 1px #dfdfdf;
            margin-right: 30px;
            margin-top: 15px;
        }

        select {
            border: 2px solid #ccc;
            padding-left: 12px;
        }

        input[type=text],
        input[type=password] {
            padding: 12px 20px;
            border: 2px solid #ccc;
            box-sizing: border-box;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            outline: none;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            border: 2px solid rgb(146, 146, 146);
        }

        .card-table {
            border: 1px solid #dfdfdf;
            box-shadow: 1px 1px 1px 1px #dfdfdf;
        }

        .button-add,
        .button-cancel {
            outline: none;
            border: none;
            width: 40px;
            height: 40px;
            color: #fff;

            font-size: 16px;
        }

        .button-add:hover {
            opacity: .8;
        }

        .btn-control {
            margin-right: 30px;
        }

        .table {
            border-collapse: collapse;
            padding-top: 10px;
            margin: 0 auto;
        }
    </style>
      <?= $this->session->flashdata('message'); ?>
    <div class="card-sess d-flex flex-column h-100 rounded mx-auto">
        <div class="input-title d-flex align-items-center w-100">
            <div class="title mx-auto">
                <h3>TAMBAH DATA USER</h3>
            </div>
        </div>
        <hr>
        <div class="card-form">
          

            <form enctype="multipart/form-data" action="<?= base_url('siswa/importExcel'); ?>" method="POST" class="d-flex flex-column justify-content-center h-100 mx-auto">
                <label for="username" class="id d-flex align-items-center justify-content-between ">
                    <span>File (xlsx) :</span> <input required class="username rounded" type="file" name="files" id="username">
                </label>
                        
                <label for="" class="btn-control d-flex justify-content-end">
                    <button type="submit" name="submit" class="button-add btn-sm btn-primary mt-4"><i class="fa fa-upload"></i></button>
                    <button type="submit" onclick='window.history.back()' class="button-cancel btn-sm btn-danger mt-4 ml-2"><i class="fa fa-arrow-left"></i> </button>
                </label>
                <hr>
            </form>
        </div>
    </div>

</div>