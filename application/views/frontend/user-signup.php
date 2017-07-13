
<?php  
 if($_SERVER['HTTPS']){
  $protocol = 'https'; 
 }else{ $protocol = 'http'; }
 ?>
<body>
		<link rel="stylesheet" href='<?php echo base_url("assets/plugins/camera/css/camera.css");?>' />
		<link rel="stylesheet" href='<?php echo base_url("assets/css/products.css");?>'  media="all" />
		<link rel="stylesheet" href='<?php echo base_url("assets/css/animate.css");?>'  media="all" />
		<link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>
		<link href='<?php echo base_url("assets/plugins/profileuploader/css/fileinput.css");?>' media="all" rel="stylesheet" type="text/css" />
	   <style>
		body {
			margin: 0;
			padding: 0;
		}
		a {
			color: #09f;
		}
		a:hover {
			text-decoration: none;
		}
		#back_to_camera {
			clear: both;
			display: block;
			height: 80px;
			line-height: 40px;
			padding: 20px;
		}
		.fluid_container {
			margin: 0 auto;
			max-width: 1000px;
			width: 90%;
		}
		.profile-left {
		    margin: 1em 0 0;
		}



		.header {
   
		    padding: 0px 0;
		}


.navbar-nav {

    margin-top: 0 !important;
  
}
nav {
    height: 30px;
}
.header.w3ls {
    height: 30px;
    margin-top: 0.8%;
}

.nav.navbar-nav {
    background-color: #16A9EF;   
}
.navbar-nav > li > a {
    padding: 5px 12px 5px;
}


.dataframe{
  width:100%;
  height:1200px;
  border:2px;
}

/*  ************************************************************************************************************** nav menu*/




.page_head {
    min-height: 158px !important;
}
.navbar {
    background: #16A9EF;
}

.navbar-nav>li>.dropdown-menu {
    padding: inherit;   
}

.navbar-nav {
/*    font: 15px arial, sans-serif;
    font-weight: bold;
    text-transform: uppercase;    */   
}
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus {
    color: black;
    background-color: #16A9EF;
}

.navbar-default .navbar-nav>li>a {
    color: #ffffff;   
}

.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {
    color: #ffffff;   
    background-color: #98CD23;
}

.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{
    color: #ffffff;   
/*    background-color: #98CD23;*/
background-color: #1484C7;
}

.dropdown-submenu-2>li>a {
    color: #ffffff;   
    background-color: #1484c7;  
}

.dropdown-submenu-2>li>a:hover, .dropdown-submenu-2>li>a:focus {
    color: #ffffff;   
    background-color: #98CD23;  
}

.dropdown-menu {
    background-color: #1484c7;
}


.dropdown-menu>li>a{
    color: #ffffff;   
   /* background-color: #98CD23; */  
    border-bottom: 2px rgba(0,0,0,0.5) solid;
    text-transform: capitalize;    
    padding: 4px 20px;
   
    border-top: 0px;
}    

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
    color: #ffffff;   
    background-color: #98CD23;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
    padding: inherit;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block; 
    
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
.navbar-fixed-top {
    border-width: 0 0 1px;
    top: 70% !important;
}

.navbar-fixed-top, .navbar-fixed-bottom { 
    position: relative;
}





.profile-left form input[type="text"], .profile-left form input[type="password"], .profile-left1 form input[type="text"], .profile-left1 form input[type="password"] {
    margin-bottom: 0;
    width: 90% !important;
}




	</style>
<!-- header -->
<div class="banner w3l">
	<div class="head_top wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
		<div class="container">


			<div class="banner-left" style="background-color: white;">				
				<img class="img-responsive" style='width:370px;height:80px;' src='<?php echo base_url("assets/img/logo_v2.png");?>' alt=" " />
			</div>

			<div class="banner-right">				
				<ul>
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+254 727310743</li>
					<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@coreict.co.ke">info@tibamoja.co.ke</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<!-- navigation -->
	<div class="header w3ls">
		<div class="container">
			<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header logo">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<!-- 	<h1>
							<a class="navbar-brand link link--yaku" href="index.html"><span style="margin-right:25%;"></span>&nbsp;&nbsp;&nbsp;&nbsp;</a>
						</h1>  --> 
						
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<nav class="cl-effect-1">
							<ul class="nav navbar-nav ">
								<li><a class="hvr-overline-from-center active" href="/">Home</a></li>
								<li><a class="hvr-overline-from-center" href="<?php echo base_url("about");?>">About</a></li>									
								<li><a class="hvr-overline-from-center" href="<?php echo base_url("service");?>">Services</a></li>
								<li><a class="hvr-overline-from-center" href="<?php echo base_url("alogin");?>">Portal</a></li>									
								<li><a class="hvr-overline-from-center" href="<?php echo base_url("contact");?>">Contact</a></li>
							</ul>
						</nav>
					</div><!-- /navbar-collapse -->
			</nav>
		</div>
	</div>
	<!-- //navigation -->
<style>
.profile-left form input[type="text"], .profile-left form input[type="password"], .profile-left1 form input[type="text"], .profile-left1 form input[type="password"] {   
    margin-bottom: 0px;   
    width: 40%;
}

</style>

	<div class="banner-info">
		<div class="container">			
<h3>Fill in additional details</h3>
			<div class="profile-left wow flipInY " style="float:left;width:100%;margin-bottom: 5%;"  data-wow-duration="1.5s" data-wow-delay="0s">
		<form action="register" method="post" enctype="multipart/form-data"> 
		<!-- some CSS styling changes and overrides -->
		<style>

		.cInput{
		  position: relative;
		  top: 50%;
		  transform: translateY(50%);
		}

		.cInput h1 {
		  text-align: center;
		  margin: 0px;
		}

		.cInput p {
		  text-align: center;
		}

		.csubmit {
		  border: none;
		  background: none;
		  position: absolute;
		  top: 2px;
		  right: 0px;
		}

		.formdiv{
		  display: inline-block;
		  width: 100%;
		  position: relative;
		}
		.csubmit {
		  position: absolute;
		  right: 0; top: 50%;
		  transform: translateY(-50%);
		}
		.ctext {
		  width: 100% !important;
		  box-sizing: border-box;
		  padding-left: 8px;
		  padding-right: 8px;
		 
		}

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
				<!-- <form class="text-center" action="register" method="post" enctype="multipart/form-data"> -->
				    <div class="kv-avatar center-block" style="width:200px">
				        <input id="avatar-2" name="avatar-2" type="file" class="file-loading">
				    </div>
				    <!-- include other inputs if needed and include a form submit (save) button -->
				<!-- </form> --> 
				<!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
				 
				<!-- the fileinput plugin initialization -->


      </div>

					<div class="login">

						 <div class="row"> 
						    <div class="col-md-6"> 
						    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $_POST['name'] ?>" required="">
                            </div>
                            <div class="col-md-6"> 
						    <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $_POST['email'] ?>" required="">
						    </div>
						</div>

						 <div class="row"> 
						    <div class="col-md-6"> 
                              <input type="password" name="pass" id="pass" placeholder="Password" value="<?php echo $_POST['pass'] ?>" required="">
						    </div>
						    <div class="col-md-6"> 
	                            <input type="text" name="dateofbirth" id="dateofbirth" placeholder="Date of birth" required="">
						   </div>
						</div>



						<div class="row"> 
						<div class="col-md-6"> 
	                         <input type="text" name="telephone" id="telephone" placeholder="Telephone" value="+254" required="">
						</div>
						<div class="col-md-6"> 
                            <input type="text" name="nationalid" id="nationalid" placeholder="National Id / Passport / Birth Certificate" required="">
						</div>
						</div>


						<div class="row"> 
						<div class="col-md-6"> 

						<select style="width:90%; border-color: #16a9ef;margin-bottom: -4%;margin-top: 4%;" name="gender" id="gender">
							  <option value="1">Male</option>
							  <option value="2">Female</option>						
						</select>
						</div>
						<div class="col-md-6"> 
                           <input type="text" name="town" id="town" placeholder="Town" required="">
						</div>
						</div>


						<div class="row"> 
						<div class="col-md-6">

						   <div class"cInput" style="width:100%;">						
						    <div class="formdiv">
						      <input type="text" name="homelatlong" onCLick="loadUserMap(-1.2858073892018242,36.82326772883607,1)" id="homelatlong" placeholder="Home Address" required="" class="ctext" style="cursor:pointer;" readonly>
						      <img class="csubmit" id="gethomeaddress" onCLick="loadUserMap(-1.2858073892018242,36.82326772883607,1)"  style='cursor:pointer;max-height: 30px;float:right;' src='<?php echo base_url("assets/img/search.jpg");?>' alt=" " />						    
						    </div>						
						</div> 

						</div>

						<div class="col-md-6"> 

						<div class"cInput" style="width:100%;">						
						    <div class="formdiv">
						      <input type="text" name="worklatlong" id="worklatlong" onCLick="loadUserMap(-1.2858073892018242,36.82326772883607,2)" placeholder="Work Address" required="" class="ctext" style="cursor:pointer;" readonly>
						      <img class="csubmit" id="getworkaddress" onCLick="loadUserMap(-1.2858073892018242,36.82326772883607,2)"  style='cursor:pointer;max-height: 30px;float:right;' src='<?php echo base_url("assets/img/search.jpg");?>' alt=" " />						    
						    </div>						
						</div>
						

						</div>
						</div>


						<div class="row"> 
						<div class="col-md-6"> 
                              <input type="text" name="homeaddress" id="homeaddress" placeholder="Addition location details" value="">
						</div>
						<div class="col-md-6">
						</div>
						</div>

					</div><br>
					<input type="submit" class="" id="submit" value="Register" > 
				</form>
		
			</div>
		</div>
	</div>
</div>
<!-- //header -->

<script src='<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/iCheck/icheck.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/profileuploader/js/fileinput.js");?>'></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
var addressType = null;
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });

$(document).bind("location_changed", function(event, object) {	
	updateUserLatLng($(this),object);
});

function updateUserLatLng(object,obj) { 
    var lat = $(object).find('.gllpLatitude').val(); 
    var lng = $(object).find('.gllpLongitude').val();
    var latLng = lat + ',' + lng;
    if(addressType == 1){
     $("#homelatlong").val(latLng);
    }else{
     $("#worklatlong").val(latLng);
    }
  
}


  });

var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
'onclick="">' + //alert(\'Call your custom code here.\')
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
  $( "#dateofbirth" ).datepicker();
</script>


<script src="<?php  echo $protocol; ?>://maps.googleapis.com/maps/api/js?key=AIzaSyCvLjXCDMebLLpmMPylPUTM3b4h7cpGnyo"></script> 
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jquery_lat_long/css/jquery-gmaps-latlon-picker.css");?>'>                        
<script src='<?php echo base_url("assets/plugins/jquery_lat_long/js/jquery-gmaps-latlon-picker.js");?>'></script>

     <div id="dialogpopupmap" class="well" style="visibility:hidden;width: 100%;padding:0px;">   

          <div id="popupmap" class="row" style="">

		    <div class="col-md-12">
                <fieldset class="gllpLatlonPicker" >
                    <input type="text" class="gllpSearchField">
                     <input type="button" class="gllpSearchButton" value="search"> 
                    <div class="gllpMap" style="width:100% !important;height:490px !important;margin-top: 0% !important;">Google Maps</div>
                    <input type="hidden" id="mylatitude" class="gllpLatitude" value="-2.34455"/>
                    <input type="hidden" id="mylongitude" class="gllpLongitude" value="39.3456"/>
                    <input type="hidden" class="gllpZoom" value="20"/>
                 </fieldset>
	       </div>


              </div>
        </div>

<script src='<?php echo base_url("assets/plugins/jquery-popup-overlay-gh-pages/jquery.popupoverlay.js");?>'></script>
<script src="<?php echo base_url('assets/js/front/signup.js')?>"></script>
<script src='<?php echo base_url("assets/js/front/index.js");?>'></script> 
