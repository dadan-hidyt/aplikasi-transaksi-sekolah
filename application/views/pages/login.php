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
    <title><?= isset($title) ? $title : ""; ?></title>
</head>
<body>
<style>
    .login-form{
        border: 1px solid #D5d5d5;
        border-radius: 2px;
    }
    #wrapper{
      width:100% !important;
    }
</style>
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-4 col-md-4">
       
        <div class="card my-5">
          <div class="card-body p-0">
            
            <div class="row">
              <div class="col-lg-12">
                  
                <div class="p-4">
                <?php 
                  $error = $this->session->flashdata("login_error");
                  if($error !== NULL) {
                      echo "<p class='alert alert-danger'>$error</p>";
                  }
                  ?>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome back admin</h1>
                  </div>
                  <form class="user" action="<?= base_url("login/post_login"); ?>" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp"
                        placeholder="input username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="input password">
                    </div>
                    <div class="form-group">
                     <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                  </form>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
