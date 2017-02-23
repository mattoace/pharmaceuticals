<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Pharmacy System | Log in</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css");?>'>
<!-- Font Awesome -->
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>
  <!-- Ionicons -->
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/ionicons.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/AdminLTE.min.css");?>'>
 <!-- iCheck -->
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/iCheck/square/blue.css");?>'>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  body{overflow:hidden;}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="alogin"><b>Pharmacy </b>System</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"> <img class="profile-user-img img-responsive img-circle" id="personimageholder" src='<?php echo base_url("assets/img/login_03.gif");?>' alt="">  Sign in to start your session</p>

                <?php

                if($_GET['auth'] == 1)
                             print('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                                Access denied : Incorrect username or password! </div> ');

                ?>

    <form action="alogincheck" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="username" name="username" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  <!--   <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="aregister" class="text-center">Register a new membership ( pharmacy / store admin ) </a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src='<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js");?>'></script>
<!-- Bootstrap 3.3.6 -->
<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
<!-- iCheck -->
<script src='<?php echo base_url("assets/plugins/iCheck/icheck.min.js");?>'></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
