<!-- differencials -->
<!-- footer -->
<div class="newsletter wow fadeInUp animated" data-wow-delay=".5s">
	<div class="container">
		<h3 class="title">Subscribe To Our Newsletter!<span></span></h3>
		<p>Receive new product information.</p>
		<div class="sub">
			<form action="#" method="post">
				<input type="text" name="Name" placeholder="Name" required="">
				<input type="email" name="Email" placeholder="Email" required="">
				<input type="submit" value="Subscribe" >
			</form>
		</div>
	</div>
</div>
<!-- map -->
<div class="map">
<!-- 	<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2482.432383990807!2d0.028213999961443994!3d51.52362882484525!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1423469959819" style="border:0"></iframe> -->

<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCvLjXCDMebLLpmMPylPUTM3b4h7cpGnyo&q=Nairobi+Kenya,Kilimani+Nairobi" style="border:0"></iframe>

</div>
<!-- //map -->
<div class="footer w3agile wow bounceInDown" data-wow-duration="1.5s" data-wow-delay="0s">
	<div class="container">
		<!-- <div class="foo-arr text-center"><img src='<?php echo base_url("assets/img/arrows.png");?>' alt=" "/></div> -->
		<div class="col-md-4 footer-left">
			<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><p>nairobi,<span>kenya</span></p>
		</div>
		<div class="col-md-4 footer-left">
			<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><p><a href="mailto:example@mail.com">pharm-portal@coreict.co.ke</a><span><a href="mailto:example@mail.com">info@coreict.co.ke</a></span></p>
		</div>
		<div class="col-md-4 footer-left">
			<i class="glyphicon glyphicon-earphone" aria-hidden="true"></i><p>+254 727 310 743<span></span></p>
		</div>
		<div class="clearfix"></div>
		<div class="copyrights w3">
			<div class="copy-left">
				<p><a href="www.coreict.co.ke"> © 2017 Core Ict Consultancy. All rights reserved </a></p>
			</div>
			<div class="copy-right agileinfo">
				<ul class="fb_icons">
					<li class="hvr-rectangle-out"><a class="fb" href="#"></a></li>
					<li class="hvr-rectangle-out"><a class="twit" href="#"></a></li>
					<li class="hvr-rectangle-out"><a class="goog" href="#"></a></li>
					<li class="hvr-rectangle-out"><a class="pin" href="#"></a></li>
					<li class="hvr-rectangle-out"><a class="drib" href="#"></a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //footer -->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
<!-- <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script> -->
<script src='<?php echo base_url("assets/js/front/bootstrap-3.1.1.min.js");?>'></script>
</body>
</html>