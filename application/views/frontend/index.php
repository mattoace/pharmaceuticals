
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


	<div class="banner-info">
		<div class="container">	


<div class="row">
<div class="col-md-4 ">
			<div class="profile-left wow flipInY" style="float:left;width:100% !important;"  data-wow-duration="1.5s" data-wow-delay="0s">
				<!-- <form action="index.php/register" method="post" > -->
				<form action="user-signup" method="post" >
					<div class="login">
						<input type="text" name="name" id="name" placeholder="Name" required="">
						<input type="text" name="email" id="email" placeholder="Email" required="">
						<input type="password" name="pass" id="pass" placeholder="Password" required="">
						<input type="password" name="Retype Password" id="rpass" placeholder="Retype Password" required="">
					</div>
					<input type="submit" class="" id="submit" value="Signup" > 
				</form>
				<p>Already have an Account? <a href="<?php echo base_url("login");?>">login Here</a></p>
			</div>

</div>
<div class="col-md-8 ">

			<div class="profile-left wow flipInY col-sm-12" style="float:left;width:100% !important;" data-wow-duration="1.5s" data-wow-delay="0s"  >
					 <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
					 	            <?php  
				                    $queryimg = $this->db->query("SELECT * FROM bannerimages WHERE parent = '1071988'");
				                    $rowimg = $queryimg->result();
				                     foreach ($rowimg as $key => $img) {
				                       print('<div data-thumb="assets/img/m1.jpg" data-src='.base_url($img->img).'><div class="camera_caption fadeFromBottom">'. $img->description.'</div></div><br>');
				                     }
				                    ?>								         
	
						</div>
			</div>
	</div>
</div>


		</div>
	</div>
</div>
<!-- //header -->


<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> -->
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="www.coreict.co.ke" target="_blank"></a></li>
            </ul>
            <ul class="nav navbar-nav">

		      <?php	

		         $query = $this->db->query('SELECT * FROM category WHERE parent IS NULL AND categoryname <>"User profile" ORDER BY sort'); 
		         $row = $query->result();
                  $j=0;
		         foreach ($row as $key => $main) {
		         	if($j == 0){ 
		         		//print('<li class="active"><a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $main->categoryname).'","'.$main->id.'")  >'.$main->categoryname.'</a></li>');
		         	} else{ 
		         		print('<li>'); 

                         $querychild1 = $this->db->query('SELECT * FROM category WHERE parent = "'.$main->id.'"'); 
		                 $row1 = $querychild1->result();
		                 if($row1[0]->id>0){
		                  $toggledropdown = "dropdown";
		                  $classtoggledropdown = "dropdown-toggle";
		                  $caret = "caret";
		                 } else{ 
		                 $toggledropdown = ""; 
		                 $classtoggledropdown = "dropdown";
		                 $caret = "";

                         $clickhandler = 'onClick=loadCategory("'.str_replace(" ", "", $main->categoryname).'","'.$main->id.'")'; 

		               }

		         		print('<a href="javascript:void(0);"  '.$clickhandler.' class="'.$classtoggledropdown.'" data-toggle="'. $toggledropdown.'">'.$main->categoryname.'<b class="'.$caret.'"></b></a>'); 

		         		
		         	
		         	     print('<ul class="dropdown-menu multi-level">');
		         	     foreach ($row1 as $key => $child1) {

		         	     	    $querychild2 = $this->db->query('SELECT * FROM category WHERE parent = "'.$child1->id.'"'); 
		                        $row2 = $querychild2->result();

	                           if(count($row2) >0){ //has kids

									print('<li class="dropdown-submenu">');
									print('<a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child1->categoryname).'","'.$child1->id.'") class="dropdown-toggle" data-toggle="dropdown">'.$child1->categoryname.'</a>');
									print('<ul class="dropdown-menu">');
									foreach ($row2 as $key => $child2) {

									   $querychild3 = $this->db->query('SELECT * FROM category WHERE parent = "'.$child2->id.'"'); 
		                               $row3 = $querychild3->result();
		                               if(count($row3) >0){ 

												print('<li class="dropdown-submenu">');
												print('<a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child2->categoryname).'","'.$child2->id.'") class="dropdown-toggle" data-toggle="dropdown">'.$child2->categoryname.'</a>');
												print('<ul class="dropdown-menu">');

													foreach ($row3 as $key => $child3) {

														   $querychild4 = $this->db->query('SELECT * FROM category WHERE parent = "'.$child3->id.'"'); 
							                               $row4 = $querychild4->result();
							                               if(count($row4) >0){

							                               		print('<li class="dropdown-submenu">');
																print('<a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child3->categoryname).'","'.$child3->id.'") class="dropdown-toggle" data-toggle="dropdown">'.$child3->categoryname.'</a>');
																print('<ul class="dropdown-menu">');
																	foreach ($row4 as $key => $child4) {
																      print('<li><a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child4->categoryname).'","'.$child4->id.'") >'.$child4->categoryname.'</a></li>');
																   }
																print('</ul>');

							                               }else{
							                               	print('<li><a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child3->categoryname).'","'.$child3->id.'") >'.$child3->categoryname.'</a></li>');
							                               } 
                                                         
													}

											    print('</ul>');


		                               }else{
		                               	  print('<li><a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child2->categoryname).'","'.$child2->id.'") >'.$child2->categoryname.'</a></li>');
		                               }

								     }
									print('</ul>');


	                           }else{
	                           	   print('<li><a href="javascript:void(0);" onClick=loadCategory("'.str_replace(" ", "", $child1->categoryname).'","'.$child1->id.'")>'.$child1->categoryname.'</a></li>');
	                           }   		         	       

		         	       }
		         	     print('</ul>'); 
                       // print('</li>'); 

		         	}                  
		         	

		         	$j++;
		         }
		      

		       ?> 





            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>



<!-- make -->
<div class="make wthree all_pad" style="padding:0px;">
	<div class="container">

    <iframe style="height:0px; !important;" class="dataframe" id="dataframe" src=""  scrolling="auto" ></iframe>



		<h2 class="title">Redifining health care<span></span></h2>
		<div class="make-grids">
			<div class="col-md-8 make-grid-one wow bounceInUp" data-wow-duration="1.5s" data-wow-delay="0s">
				<div class="make-left">
					<div class="item item-type-double">
						<div class="item-hover">
							<div class="item-info">
								<div class="date">Commitment to Patients</div>			
								<div class="line"></div>			
								<div class="headline">
									 Bring pharmaceutical products to patients for unmet medical needs.We bring our years of drug development expertise.
								</div>
								<div class="line"></div>
							</div>
							<div class="mask"></div>
						</div>
						<div class="item-img"><img class="img-responsive" src='<?php echo base_url("assets/img/m1.jpg");?>' alt=" " /></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 make-grid-two wow bounceInUp" data-wow-duration="1.5s" data-wow-delay="0.1s">
				<div class="make-left">
					<div class="item item-type-double">
						<div class="item-hover">
							<div class="item-info">
								<div class="date">Quality Service</div>			
								<div class="line"></div>			
								<div class="headline">We have always been very professional and the customer service is excellent. The prices are excellent as well</div>
								<div class="line"></div>
							</div>
							<div class="mask"></div>
						</div>
						<div class="item-img"><img class="img-responsive" src='<?php echo base_url("assets/img/m2.jpg");?>' alt=" " /></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 make-grid-two make-top wow bounceInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
				<div class="make-left">
					<div class="item item-type-double">
						<div class="item-hover">
							<div class="item-info">
								<div class="date">Pharmacy Services</div>			
								<div class="line"></div>			
								<div class="headline">From helping you manage your medications online to offering in-store immunizations, we've simplified the way you care for your family's health.</div>
								<div class="line"></div>
							</div>
							<div class="mask"></div>
						</div>
						<div class="item-img"><img class="img-responsive" src='<?php echo base_url("assets/img/m3.jpg");?>' alt=" " /></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 make-grid-two make-top wow bounceInUp" data-wow-duration="1.5s" data-wow-delay="0.3s">
				<div class="make-left">
					<div class="item item-type-double">
						<div class="item-hover">
							<div class="item-info">
								<div class="date">Prescription Refills & Transfers</div>			
								<div class="line"></div>			
								<div class="headline">It’s easy to refill or transfer your prescriptions online to have them filled at your nearest Rite Aid pharmacy.</div>
								<div class="line"></div>
							</div>
							<div class="mask"></div>
						</div>
						<div class="item-img"><img class="img-responsive" src='<?php echo base_url("assets/img/m4.jpg");?>' alt=" " /></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 make-grid-two make-top wow bounceInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
				<div class="make-left">
					<div class="item item-type-double">
						<div class="item-hover">
							<div class="item-info">
								<div class="date">Flu Shots and Immunizations</div>			
								<div class="line"></div>			
								<div class="headline">Shield yourself from the flu with a flu shot</div>
								<div class="line"></div>
							</div>
							<div class="mask"></div>
						</div>
						<div class="item-img"><img class="img-responsive" src='<?php echo base_url("assets/img/m5.jpg");?>' alt=" " /></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //make -->
<!-- explore -->
<div class="explore agile all_pad ">



	<div class="container" style="margin-top:-5%;">
		<h3 class="title" style="background-color: #16A9EF;">Search to find your Pharmacy , Clinic or Health Center<span></span></h3>
		<div class="explore-grids">		
			<div class="col-md-12 explore-right wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.1s" style="margin-top: -4.8%; padding:0px;">			
				<div class="flex-slider">
					
				<!-- 	<div class="explore-left wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.1s" id="searchholdmeds" style="padding:0px;background-color:transparent !important;">
					</div> -->

				
			
				<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
				<style>
			        .tt-hint,
			        .pharmsearch{
			            border: 2px solid #CCCCCC;
			            border-radius: 8px 8px 8px 8px;
			           /* font-size: 24px;*/
			            height: 35px;
			            line-height: 30px;
			            outline: medium none;
			            padding: 8px 12px;
			            width: 400px;
			            margin-bottom: -7%;
			            margin-top: 2%;
			        }

			        .tt-dropdown-menu {
			            width: 400px;
			            margin-top: 5px;
			            padding: 8px 12px;
			            background-color: #fff;
			            border: 1px solid #ccc;
			            border: 1px solid rgba(0, 0, 0, 0.2);
			            border-radius: 8px 8px 8px 8px;
			            /*font-size: 18px;*/
			            color: #111;
			            background-color: #F1F1F1;
			        }

				</style>
			    <script>
			       $(document).ready(function() {

			            $('input.pharmsearch').typeahead({
			                name: 'pharmsearch',
			                remote: 'pharm-autofill?query=%QUERY'

			            });

			        $('input.pharmsearch').bind('typeahead:selected', function(obj, datum, name) {  
			            	 postVars = {"id":datum.value}
						     $.post("pharm-sfetch",postVars,function(data){
						     $("#pharmholdmeds").html(data.response);  


							/*$("#pharmholdmeds").flexisel({
														visibleItems: 1,
													    itemsToScroll: 1,
													    animationSpeed:0,
													    infinite: false,
													    navigationTargetSelector: null,
													    autoPlay: {
													      enable: false,
													      interval: 5000,
													      pauseOnHover: true
													    },
													    responsiveBreakpoints: { 
													      portrait: { 
													        changePoint:480,
													        visibleItems: 1,
													        itemsToScroll: 1
													      }, 
													        landscape: { 
													        changePoint:640,
													        visibleItems: 2,
													        itemsToScroll: 2
													      },
													        tablet: { 
													        changePoint:768,
													        visibleItems: 3,
													        itemsToScroll: 3
													      }
													    }
													});*/

						     },"json"); 	
			         });

			        })
			    </script>
	            <div class="content">
			         <form style="margin-top:-4%">
			           <input type="text" name="pharmsearch" size="30" class="pharmsearch" placeholder="Search....">
			         </form> 
		         </div>
		          <hr>
		          <style>
		          .nbs-flexisel-container {
						    height: 320px !important;
						    margin-top: -1%;
						}
						.nbs-flexisel-nav-right {
						    background-color: #16a9ef;
						}
						.nbs-flexisel-nav-left {
						    background-color: #16a9ef;
						}
						
		          </style> 
		          <div class="row">
		          		<div class="col-md-12" > 
							<div class="explore-left wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.1s" id="pharmholdmeds" style="padding:0px;background-color:transparent !important;left:0px !important;">							
							</div>
				        </div>
				  </div>

					<script type="text/javascript">
									$(window).load(function() {
										$("#pharmholdmeds").flexisel({
											visibleItems: 3,
											animationSpeed: 3000,
											autoPlay: false,
											autoPlaySpeed: 10000,    		
											pauseOnHover: true,
											enableResponsiveBreakpoints: true,
											responsiveBreakpoints: { 
												portrait: { 
													changePoint:568,
													visibleItems: 1
												}, 
												landscape: { 
													changePoint:667,
													visibleItems: 2
												},
												tablet: { 
													changePoint:991,
													visibleItems: 1
												}
											}
										});
										
									});
					</script>	
					<script src='<?php echo base_url("assets/js/front/jquery.flexisel.js");?>'></script>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //explore -->
<!-- differencials -->
<div class="different agileits all_pad">
	<div class="container">
		<h3 class="title">The Simplest way to find you medication professionally<span></span></h3>
		<div class="diff-grids">
			<div class="col-md-4 diff-grid diff-one bor-bot wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0.1s">
				<div class="port-1 effect-3">
                	<div class="image-box">
                    	<img class="img-responsive" src='<?php echo base_url("assets/img/p4.jpg");?>' alt="Image-3">
                    </div>
                    <div class="text-desc">
                    	<h4>Pharmacy</h4>
                        <p>Get convenient prescription refill reminders, tools for managing your medications, and more with a free My Pharmacy online account.</p>
                    </div>
                </div>
			</div>
			<div class="col-md-4 diff-grid bor-bot bar-two wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0.2s">
				<div class="hi-icon-wrap hi-icon-effect-4 hi-icon-effect-4b">
					<div class="abt-icon">
						<a href="#" class="hi-icon icon1"></a>
						<h4>Prescription Refills & Transfers</h4>
						<p>Managing your medications is simple, from start to finish. Just follow a few steps to transfer or refill your prescription online</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 diff-grid diff-one bor-bot  wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0.3s">
				<div class="port-1 effect-3">
                	<div class="image-box">
                    	<img class="img-responsive" src='<?php echo base_url("assets/img/blackfamily.jpg");?>' alt="Image-3">
                    </div>
                    <div class="text-desc">
                    	<h4>Live Chat with a Pharmacist</h4>
                        <p>We’re committed to offering you, our customers, personalized service, whenever and wherever you need it.</p>
                    </div>
                </div>
			</div>
			<div class="col-md-4 diff-grid diff-one bor-top bar-two wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0.4s">
				<div class="hi-icon-wrap hi-icon-effect-4 hi-icon-effect-4b">
					<div class="abt-icon">
						<a href="#" class="hi-icon icon2"></a>
						<h4>Health Information </h4>
						<p>We’re committed to helping you take control of your family’s health. That’s why we offer a range of educational and money-saving wellness resources and programs—both in stores and online.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 diff-grid bor-top wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0.5s">
				<div class="port-1 effect-3">
                	<div class="image-box">
                    	<img class="img-responsive" src='<?php echo base_url("assets/img/p1.jpg");?>' alt="Image-3">
                    </div>
                    <div class="text-desc">
                    	<h4>Vitamins and suppliments</h4>
                        <p>Find out which vitamins and supplements benefit your body the most</p>
                    </div>
                </div>
			</div>
			<div class="col-md-4 diff-grid diff-one bor-top bar-two wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0.6s">
				<div class="hi-icon-wrap hi-icon-effect-4 hi-icon-effect-4b">
					<div class="abt-icon">
						<a href="#" class="hi-icon icon3"></a>
						<h4>Diabetes</h4>
						<p>Find out which vitamins and supplements benefit your body the most</p>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<script src="<?php  echo $protocol; ?>://maps.googleapis.com/maps/api/js?key=AIzaSyCvLjXCDMebLLpmMPylPUTM3b4h7cpGnyo"></script> 
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jquery_lat_long/css/jquery-gmaps-latlon-picker.css");?>'>                        
<script src='<?php echo base_url("assets/plugins/jquery_lat_long/js/jquery-gmaps-latlon-picker.js");?>'></script>

     <div id="dialogpopupmap" class="well" style="visibility:hidden;width: 100%;">   

          <div id="popupmap" class="row" style="">

		    <div class="col-md-12">
                <fieldset class="gllpLatlonPicker" >
                   <!-- <input type="text" class="gllpSearchField">
                     <input type="button" class="gllpSearchButton" value="search"> -->
                    <div class="gllpMap" style="width:100% !important;height:490px !important;margin-top: -5% !important;">Google Maps</div>
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
