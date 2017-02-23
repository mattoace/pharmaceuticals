
<body>
<!-- header -->
<div class="banner w3l">
	<div class="head_top wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
		<div class="container">
			<div class="banner-right">
				<ul>
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+254 727310743</li>
					<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@coreict.co.ke">info@coreict.co.ke</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="banner-info">
		<div class="container">
			<div class="profile-left wow flipInY" data-wow-duration="1.5s" data-wow-delay="0s">
				<form action="index.php/register" method="post" >
					<div class="login">
						<input type="text" name="name" id="name" placeholder="Name" required="">
						<input type="text" name="email" id="email" placeholder="Email" required="">
						<input type="password" name="pass" id="pass" placeholder="Password" required="">
						<input type="password" name="Retype Password" id="rpass" placeholder="Retype Password" required="">
					</div>
					<input type="submit" class="" id="submit" value="Signup" > <!-- onClick="signUp(this)" --> 
				</form>
				<p>Already have an Account? <a href="<?php echo base_url("login");?>">login Here</a></p>
			</div>
		</div>
	</div>
</div>
<!-- //header -->
<!-- navigation -->
<div class="header w3ls wow bounceInUp" data-wow-duration="1s" data-wow-delay="0s">
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
									<a class="navbar-brand link link--yaku" href="index.html"><span style="margin-right:25%;"></span>tibamoja</a>
								</h1>
								
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
<!-- make -->
<div class="make wthree all_pad">
	<div class="container">
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
	<div class="container">
		<h3 class="title">Search for medicine<span></span></h3>
		<div class="explore-grids">
			<div class="col-md-4 explore-left wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.1s">
				<div class="main">
					<form action="#" method="post">
						<h4>Find medication</h4>
							<div class="section-top">
								<select onchange="change_country(this.value)" class="frm-field required">
									<option value="null">Filter by keywords</option>
									<option value="null">Medication by product id</option>
									<option value="null">Pharmacy/Store location</option>         
									<option value="AX">Category</option>								
									<option value="AX">Price</option>
								</select>
							</div>
						<div class="section-single">
							<div class="section_room">
								<select  onchange="change_country(this.value)" class="frm-field required">
									<option value="null">Any Type</option>
								<!-- 	<option value="null">Single</option>         
									<option value="AX">Duplex</option>
									<option value="AX">Retail</option>
									<option value="AX">Multi Family</option> -->
								</select>
							</div>	
				<!-- 			<div class="section_room">
								<select  onchange="change_country(this.value)" class="frm-field required">
									<option value="null">Any Location</option>
									<option value="null">Australia</option>         
									<option value="AX">Sweden</option>
									<option value="AX">Netherlands</option>
									<option value="AX">Bangkok</option>
								</select>
							</div> -->
							<div class="clearfix"></div>
						</div>
<!-- 						<div class="bath">
							<h4>Bed rooms</h4>
								<input type="number" class="text_box" value="3" min="1">
						</div>
						<div class="bath">
							<h4>Bath rooms</h4>
								<input type="number" class="text_box" value="4" min="1">	
						</div> -->
						<div class="clearfix"></div>
						<div class="range-slider">
							<h4>Price range</h4>
							<div id="slider-range"></div>
							<!--<script type="text/javascript" src="js/jquery-ui.js"></script>-->
							<script src='<?php echo base_url("assets/js/front/jquery-ui.js");?>'></script>			
								<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
								<script type='text/javascript'>//<![CDATA[ 
												$(window).load(function(){
												 $( "#slider-range" ).slider({
															range: true,
															min: 0,
															max: 900,
															values: [ 50, 600 ],
															slide: function( event, ui ) {  $( "#amount" ).val( "kes" + ui.values[ 0 ] + " - kes" + ui.values[ 1 ] );
															}
												 });
												$( "#amount" ).val( "kes" + $( "#slider-range" ).slider( "values", 0 ) + " - kes" + $( "#slider-range" ).slider( "values", 1 ) );

												});//]]>  

								</script>
						</div>
						<input type="submit" value="Find medication">
					</form>
				</div>
			</div>
			<div class="col-md-8 explore-right wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.1s">
				<!-- <h4>Our Clients</h4> -->
				<div class="flex-slider">
<!-- 					<ul id="flexiselDemo1">			
						<li>
							<div class="laptop">
										<div class="team-right">
											<p>Service is great and the prices are fantastic</p>
										</div>
							</div>
							<div class="team-pic">
											<div class="team-pic-left">
												<h5>Customer 1</h5>
												<p>Seller</p>
											</div>
											<div class="team-pic-right">
												<img src='<?php echo base_url("assets/img/team1.jpg");?>' alt=" "/>
											</div>
											<div class="clearfix"></div>
							</div>
						</li>
						<li>
							<div class="laptop">
										<div class="team-right">
											<p>professional and the customer service is excellent</p>
										
										</div>
							</div>
							<div class="team-pic">
											<div class="team-pic-left">
												<h5>Customer 2</h5>
												<p>Agent</p>
											</div>
											<div class="team-pic-right">
												<img src='<?php echo base_url("assets/img/team2.jpg");?>' alt=" "/>
											</div>
											<div class="clearfix"></div>
							</div>
						</li>
					</ul> -->
					<script type="text/javascript">
									$(window).load(function() {
										$("#flexiselDemo1").flexisel({
											visibleItems: 2,
											animationSpeed: 1000,
											autoPlay: true,
											autoPlaySpeed: 3000,    		
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
				<!--	<script type="text/javascript" src="js/jquery.flexisel.js"></script> -->
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
                    	<img class="img-responsive" src='<?php echo base_url("assets/img/p2.jpg");?>' alt="Image-3">
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

<script src="<?php echo base_url('assets/js/front/signup.js')?>"></script> 
