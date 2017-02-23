<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pharmacy System | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css");?>'>
  <!-- Font Awesome -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>
  <!-- Ionicons -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/ionicons.min.css");?>'>
  <!-- Theme style -->
  <link rel="stylesheet" href='<?php echo base_url("assets/css/AdminLTE.min.css");?>'>
  <!-- iCheck -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/iCheck/square/blue.css");?>'>

  <link href='<?php echo base_url("assets/plugins/profileuploader/css/fileinput.css");?>' media="all" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  body{overflow-x:hidden;}
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>Pharmacy </b>System</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new pharmacy admin</p>

    <form action="padmregister" method="post" id="padmregister" name="padmregister" enctype="multipart/form-data">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="storename" name="storename" placeholder="Pharmacy / Store Name">
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="telephone" class="form-control" id="telephone" name="telephone" placeholder="Telephone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

		<!-- some CSS styling changes and overrides -->
		<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		    margin: 0;
		    padding: 0;
		    border: none;
		    box-shadow: none;
		    text-align: center;
		}
		.kv-avatar .file-input {
		    display: table-cell;
		    max-width: 220px;
		}
		</style>
      <div class="form-group has-feedback">
				<!-- the avatar markup -->
				<div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
			<!-- 	<form class="text-center" action="/avatar_upload.php" method="post" enctype="multipart/form-data"> -->
				    <div class="kv-avatar center-block" style="width:200px">
				        <input id="avatar-2" name="avatar-2" type="file" class="file-loading">
				    </div>
				    <!-- include other inputs if needed and include a form submit (save) button -->
				<!-- </form> -->
				<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
				 
				<!-- the fileinput plugin initialization -->


      </div>


      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" onClick ='$("#padmregister").submit();'>Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="alogin" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src='<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js");?>'></script>
<!-- Bootstrap 3.3.6 -->
<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
<!-- iCheck -->
<script src='<?php echo base_url("assets/plugins/iCheck/icheck.min.js");?>'></script>

<script src='<?php echo base_url("assets/plugins/profileuploader/js/fileinput.js");?>'></script>
<!--<script src='<?php echo base_url("assets/plugins/profileuploader/js/fileinput_locale_fr.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/profileuploader/js/fileinput_locale_es.js");?>'></script>-->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

//the fileinput plugin initialization 

var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
'onclick="alert(\'Call your custom code here.\')">' +
'<i class="glyphicon glyphicon-tag"></i>' +
'</button>'; 
$("#avatar-2").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    showBrowse: false,
    browseOnZoneClick: true,
    removeLabel: '',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="../assets/plugins/profileuploader/img/avatar.jpg" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});
</script>

</body>
</html>
