<body>
	<style>
.page_head {
    min-height: 158px !important;
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
}
.nav.navbar-nav {
    background-color: #16A9EF;  
}
.navbar-nav > li > a {
    padding: 10px 12px 0;
}

</style>
<!-- header -->
<div class="banner page_head w3l">
	<div class="head_top">
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
</div>
<!-- //header -->
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
						<a class="navbar-brand link link--yaku" href="index.html"><span style="margin-right:25%;"></span>tibamoja</a>
					</h1> -->
					
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

<?php
session_start();
$response = $_SESSION['response']; 
$errMessage = $response[0];
if($errMessage["response"]){
   $pageResponse = $errMessage["message"].",<br>" .$errMessage["response"];
}else{ 
   $pageResponse = "<b>Error : </b>".$errMessage["message"];
}
?>
<div class="contact wthree all_pad">
	<div class="container">
		<h3 class="title">Payment Transaction Reponse<span></span></h3>
			<div class="login-page">
				<div class="col-md-6 profile-left1">
				   <h4 class="title"><?php echo  $pageResponse ; ?><span></span></h4>
				</div>
				<div class="col-md-6 profile-middle1">
					<div class="profile-img">
						<h2>Want to connect with social networks..</h2>
						<div class="footer-bottom">
							<a href="#"><span>Twitter</span></a>
							<a href="#"><span>Facebook</span></a>
							<a href="#"><span>Google+ </span></a>
							<a href="#"><span>Dribbble</span></a>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
</div>

<!-- //contact -->
<!-- footer -->
