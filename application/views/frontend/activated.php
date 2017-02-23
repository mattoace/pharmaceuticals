<body>
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
					<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@coreict.co.ke">info@coreict.co.ke</a></li>
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
					<h1>
					<a class="navbar-brand link link--yaku" href="index.html"><span style="margin-right:25%;"></span>&nbsp;&nbsp;&nbsp;&nbsp;</a>
					</h1>
					
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-1">
						<ul class="nav navbar-nav ">
							<li><a class="hvr-overline-from-center active" href="/">Home</a></li>
							<li><a class="hvr-overline-from-center" href="<?php echo base_url("index.php/about");?>">About</a></li>									
							<li><a class="hvr-overline-from-center" href="<?php echo base_url("index.php/service");?>">Services</a></li>
							<li><a class="hvr-overline-from-center" href="<?php echo base_url("index.php/alogin");?>">Portal</a></li>									
							<li><a class="hvr-overline-from-center" href="<?php echo base_url("index.php/contact");?>">Contact</a></li>
						</ul>
					</nav>
				</div><!-- /navbar-collapse -->
		</nav>
	</div>
</div>


<div style="padding:0%;margin:5%;">
<span style="font-size:22px;font-weight:900;">User has been successfully activated!<span>
			<form action="login" method="post">	
				<input type="submit" class="submit" style="width:100px" value="Login" >
			</form>
</div>