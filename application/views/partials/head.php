<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url(); ?>assets/img/logo/logo.png" rel="icon">
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/ruang-admin.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- datatable -->
    <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>    
    <title><?= isset($title) ? $title : ""; ?></title>
</head>

<body <?= isset($bodyClass) ? "class='" . $bodyClass . "'" : ""; ?> <?= isset($bodyId) ? "id='" . $bodyId . "'" : ""; ?>>
    <div id="wrapper">