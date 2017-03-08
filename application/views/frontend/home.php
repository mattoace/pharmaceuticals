
<?php  
 if($_SERVER['HTTPS']){
  $protocol = 'https'; 
 }else{ $protocol = 'http'; }
 ?>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/jquery-ui-1.10.0.custom.min.css");?>'  />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/selectator/fm.selectator.jquery.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/home.css");?>'  />
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<!-- <link rel="stylesheet" href='<?php echo base_url("assets/plugins/jcart/jcart.css");?>'> 
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jcart/bootstrap.min.css");?>'>-->
<style>
.team-img ul li a {
    width: 100%;
}
.btn {
    padding: 0px;
}
table.dataTable tbody tr {   
    line-height: 10px !important;
}
.nav.nav-tabs {
    background-color: #16a9ef;
}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    background-color: #9acf29 !important;   
}
.btn-group {
    float: left;
    padding-bottom: 10px;
}


#rolling-nav {
  font:normal 12px 'Trebuchet MS',Trebuchet,Arial,Sans-Serif;
  color:white;
  float:left;
  /*text-transform:uppercase;*/
	/* outline:1px solid; */
  width:550px; /* Fixed width. Measure it manually */
	
  margin: -2% auto 0;
  padding-left: 1.4%;
}

#rolling-nav ul {
  height:30px;
  margin:0px 0px;
  padding:0px 0px;
  overflow:hidden;
}

#rolling-nav li {
  float:left;
  display:inline;
  list-style:none;
  margin:0px 0px;
  padding:0px 0px;
}

.col-md-12.team-grid.text-center {
    margin-top: -20px;
}

.glyphicon.glyphicon-shopping-cart.my-cart-icon { 
    top: -25px;
}

#rolling-nav a,
#rolling-nav a:before {
/*  display:block;*/
  margin:0px 0px;
  padding:0px 30px;
  line-height:30px;
  color:white;
  text-decoration:none;
  background-color:#900;
  background-image:-webkit-linear-gradient(top, #900 0%, #ff5733 50%, #ff5733 50%, #ff5733 100%);   /*background-image:-webkit-linear-gradient(top, #900 0%, #6A0808 50%, #620303 50%, #6A0808 100%);*/
  background-image:-moz-linear-gradient(top, #900 0%, #ff5733 50%, #ff5733 50%, #ff5733 100%);
  background-image:-ms-linear-gradient(top, #900 0%, #ff5733 50%, #ff5733 50%, #ff5733 100%);
  background-image:-o-linear-gradient(top, #900 0%, #ff5733 50%, #ff5733 50%, #ff5733 100%);
  background-image:linear-gradient(top, #900 0%, #ff5733 50%, #ff5733 50%, #ff5733 100%);
  -webkit-box-shadow:inset 0px 1px 0px rgba(255,255,255,0.1);
  -moz-box-shadow:inset 0px 1px 0px rgba(255,255,255,0.1);
  box-shadow:inset 0px 1px 0px rgba(255,255,255,0.1);
  position:relative;
  -webkit-transition:all 0.3s ease-in-out;
  -moz-transition:all 0.3s ease-in-out;
  -ms-transition:all 0.3s ease-in-out;
  -o-transition:all 0.3s ease-in-out;
  transition:all 0.3s ease-in-out;
}

#rolling-nav a:before {
  content:attr(data-clone);
  position:absolute;
  top:100%;
	right:0px;
  left:0px;
/*  display:block;*/
  background-color:white;
  background-image:-webkit-linear-gradient(top, #ddd, white);
  background-image:-moz-linear-gradient(top, #ddd, white);
  background-image:-ms-linear-gradient(top, #ddd, white);
  background-image:-o-linear-gradient(top, #ddd, white);
  background-image:linear-gradient(top, #ddd, white);
  border-top:2px solid rgba(0,0,0,0.2);
  color:#333;
}

#rolling-nav a:hover {
  margin-top:-50px;
  margin-bottom:1px;
}
.gllpSearchField {
    visibility: hidden;
}
.gllpSearchButton {
	visibility: hidden;
}

  .badge-notify{
    background:red;
    position:relative;
    top: -20px;
    right: 10px;
  }
  .my-cart-icon-affix {
    position: fixed;
    z-index: 999;
  }
  .classcustomeinputs{
  	background-color: #dff0d8;
    font-size: 10px;
    height: 23px;
  }
    .classcustomespan{
  	background-color: #ff5733;
    color: white;
    font-size: 10px;
    height: 23px;
    width:40%;
  }
  input:read-only {
    background-color: #dff0d8;
}
.col-md-12.text-center > img { 
    float: left;
}

.mylabels{
    color: green;
    font-size: 12px;
}

.page_head {
    min-height: 158px !important;
}






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
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+254 727 310 743</li>
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
									<a class="navbar-brand link link--yaku" href="index.html"><span style="margin-right:25%;"></span>&nbsp;&nbsp;&nbsp;&nbsp;</a>
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

<style>
.team-grid {
    width: auto !important;
}
.team-grids {
    margin-top: 0px;
}

div.bhoechie-tab-container { 
    width: 100% !important;  
}

.nav.nav-tabs {
   /* background-image: -moz-linear-gradient(center top , #900 0%, #ff5733 50%, #ff5733 50%, #ff5733 100%);*/
}
</style>
      <?php
         $userid = $_COOKIE['userlogin'];
         $userid = $_COOKIE['userlogin'];
         $query = $this->db->query('SELECT * FROM users u, persons p WHERE u.personid = p.id AND u.id = "'.$userid.'"'); 
         $row = $query->result();
       ?> 
<!-- team -->
<div class="team agile all_pad">
	<div class="container">
		<h3 class="title" style="
		    font-size: 20px;
		    text-align: left;
		    margin-top: -6%; color:black;
		">Self-service<span style="width: 100%;"><h6>Welcome <?php echo $row[0]->firstname ." " . $row[0]->secondname; ?></h6></span></h3>	      
		<div style="float: right; cursor: pointer;">
        <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
        </div>	
									            <nav id="rolling-nav">
												    <ul>
												        <li><a href="#" onClick = "uploadlist()"  data-clone="Refill Selected Product">Refill Selected Product</a></li>
												        <li><a href="<?php echo base_url("prescription");?>?id=0" data-clone="View My Transactions">View My Transactions</a></li>
												        <li><a href="userprofile" data-clone="My Profile">My Profile</a></li>												  
												    </ul>
												</nav>


		<div class="team-grids">
			<div class="col-md-12 team-grid text-center">
			<div class="team-img">

			<div class="container">
			<div class="row">
		        <div class="col-lg-5 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">    <!-- <div class="col-lg-5 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container"> -->
		            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu" style="width:10%;">
		              <div class="list-group">
		                <a href="#" class="list-group-item active text-center">
		                  <h4 class="glyphicon glyphicon-planeee"> <img style="border-radius:60%; width:80px;" class="img-responsive" src='<?php echo base_url("assets/img/m1.jpg");?>' alt=" " /></h4><br/><b>Pharmacy</b>
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-roads"><img style="border-radius:60%; width:80px;" class="img-responsive" src='<?php echo base_url("assets/img/m2.jpg");?>' alt=" " /></h4><br/><b>Find a clinic</b>
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-homes"><img style="border-radius:60%; width:80px;" class="img-responsive" src='<?php echo base_url("assets/img/m3.jpg");?>' alt=" " /></h4><br/><b>Refill by scan</b>
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-cutlery3"><img style="border-radius:60%; width:80px;" class="img-responsive" src='<?php echo base_url("assets/img/m4.jpg");?>' alt=" " /></h4><br/><b>My Prescriptions</b>
		                 </a>
<!-- 		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-credit-card"></h4><br/>Credit Card
		                </a>  -->
		              </div>
		            </div>

		            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab" style="width:90%;">
		                <!-- flight section -->
		                <div class="bhoechie-tab-content  active">



                              <table id="persontable" class="display" cellspacing="0" width="100%" >
										            <thead>
										                <tr>
										                    <th>Id</th>
						                                    <th></th>
						                                    <th></th>
										                    <th>Drug description</th>
										                    <th></th>
										                    <th>Tax</th>
										                    <th>Trade Price</th>					            
										                </tr>
										            </thead>
										            <tbody>
										            </tbody>
										 
										            <tfoot>
										                <tr>
										         
										                </tr>
										            </tfoot>
										        </table>	

		                  <!--  <center>

 							
							<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#refill" id="refill-tab" role="tab" data-toggle="tab" aria-controls="refill" aria-expanded="true">Refill drug</a></li>
									<li role="presentation"><a href="#scan" role="tab" id="scan-tab" data-toggle="tab" aria-controls="scan">Scan barcode/QR</a></li>
							        <li role="presentation"><a href="#transfer" role="tab" id="transfer-tab" data-toggle="tab" aria-controls="transfer">Transfer prescription</a></li>					
							</ul>
									<div id="myTabContent" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="refill" aria-labelledby="refill-tab" style="background-color: #deefd7;">



										

										</div>

										<div role="tabpanel" class="tab-pane fade" id="scan" aria-labelledby="scan-tab">







													<div class="col-md-12 ">
													<span style="text-align:left;font-size:12px;font-weight:900em">
														Type in the Product Id/ Serial No. of the medication, alternatively use a barcode scanner connected to your usb port to scan barcode of the medication.
													</span>
															  <div class="">
															    <div class="input-group">
															      <input type="text" class="form-control" id="scanfield2" placeholder="Enter Product id/ Serial No....">
															      <span class="input-group-btn">
															        <button class="btn btn-default" onClick="doScanProductId2(this)" type="button">Go!</button>
															      </span>
															    </div>
															  </div>

														</div>

																			<div class="col-md-12" id="scanbody2">

						</div>




										</div>

									    <div role="tabpanel" class="tab-pane fade" id="transfer" aria-labelledby="transfer-tab">
										Transfer prescription
										</div>

							</div>



							</div>							  

							    



		                    </center>-->
		                </div>

						<script src="<?php  echo $protocol; ?>://maps.googleapis.com/maps/api/js?key=AIzaSyCvLjXCDMebLLpmMPylPUTM3b4h7cpGnyo"></script> 
						<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jquery_lat_long/css/jquery-gmaps-latlon-picker.css");?>'>                        
						<script src='<?php echo base_url("assets/plugins/jquery_lat_long/js/jquery-gmaps-latlon-picker.js");?>'></script>

		                <!-- train section -->
		                <div class="bhoechie-tab-content ">

							<h3 class="title" style="
								    font-size: 20px;
								    text-align: left;
								    margin-top: 0%;
								">Clinic search<h6>find a clinic near you</h6></h3>
		    
									<div class="row">

											<div class="col-md-12">
										        <select id="select1" name="select1" style="width:100%;" onchange="selectChanged(this)">
											              <?php //http://opensource.faroemedia.com/selectator/
											               $query = $this->db->query('SELECT * FROM clinics'); 
											                    $i = 1;                                        
											                  foreach ($query->result() as $row)
											                      {
											                      print('<option value="'.$row->id.'" data-right="'.$i.'"  data-left=" <img src='.base_url("assets/img/clinic.png").' >"  >'.$row->clinicname.'</option>'); 
											                      $i++;
											                      }

											              ?>      
											            </select>
											            <input value="activate selectator" id="activate_selectator1" type="button" style="visibility:hidden;">
										   </div>
										   <div class="col-md-12">
					                            <fieldset class="gllpLatlonPicker" >
					                                <input type="text" class="gllpSearchField">
					                                <input type="button" class="gllpSearchButton" value="search">
					                                <div class="gllpMap" style="width:100% !important;height:490px !important;margin-top: -5% !important;">Google Maps</div>
					                                <input type="hidden" id="mylatitude" class="gllpLatitude" value="-2.34455"/>
					                                <input type="hidden" id="mylongitude" class="gllpLongitude" value="39.3456"/>
					                                <input type="hidden" class="gllpZoom" value="10"/>
					                             </fieldset>
									       </div>

									</div>

		                </div>
		    
		                <!-- hotel search -->
		               <div class="bhoechie-tab-content ">
                       <div class="row">
								<div class="col-md-12 ">

															<span style="text-align:left;font-size:12px;font-weight:900em">
																Type in the Product Id/ Serial No. of the medication, alternatively use a barcode scanner connected to your usb port to scan barcode of the medication.
															</span>
									  <div class="">
									    <div class="input-group">
									      <input type="text" class="form-control" id="scanfield" placeholder="Enter Product id/ Serial No....">
									      <span class="input-group-btn">
									        <button class="btn btn-default" onClick="doScanProductId(this)" type="button">Go!</button>
									      </span>
									    </div><!-- /input-group -->
									  </div>
								


								</div>
								<div class="col-md-12" id="scanbody">

								</div>
						</div>	               


		                </div>


		                <div class="bhoechie-tab-content" style="background-color:#DFF0D8;">

                        <!-- display the patients prescriptions here -->

                        <div class="col-md-12" id="prescription_body" >						
		                         <h4 style="float:left;text-align:left;margin-top:0%;">  <!-- float:left;text-align:left;font-size:12px;font-weight:900em -->
									These are the medications that you have been subscribed to : 
								</h4><br><hr style="
										  border: 0; 
										  height: 1px; 
										  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
										  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
										  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
										  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
										">

								 


							      <?php							   
							         $query = $this->db->query('
							         	 SELECT 
									                        concat(s.id,"_",p.id) as id,
									                        t.storeid,IF(d.img IS NOT NULL ,concat("'.$protocol.'://pharm-portal.coreict.co.ke/",d.img),"'.$protocol.'://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img,
									                        d.genericname,
									                        dp.drugprice,
									                        dp.tax,
									                        s.storename,pr.price,pr.qty,
									                        s.address,pr.refilldate,pr.startdate,pr.enddate,
									                        s.telephone,
									                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id as user,
									                        ds.dosename,ds.minimumdose,ds.maximumdose,ds.dose
									                    FROM
									                        stores s,
									                        patientrefill pr,
									                        transactions t,
									        users u ,
									        persons p,
									                        drugs d
									                            LEFT JOIN
									                        drugprices dp ON d.id = dp.drugid
									                        	LEFT JOIN dose ds ON ds.drugid = d.id
									                    WHERE
									                        pr.id = t.orderid 
									                           AND s.id = t.storeid
									                            AND pr.drugid = d.id  
									        AND u.personid = p.id 
									        AND u.id = pr.patientid                 
									                            AND pr.description = "Invoice sent" 
							         	  AND u.id = "'.$userid.'"'

							         	); 
							         $row = $query->result();
							      foreach ($row  as $key => $prescribeditems) {
							      	# code...
							     
							       ?> 

								  <div class="row">
								  	<div class="col-md-4" id="medication" >	

                                        <div class="col-md-12 text-center">
									      <img src="<?php  echo $prescribeditems->img; ?>" width="150px" height="150px">
									      <br>
									      <?php  echo $prescribeditems->genericname; ?><strong><?php  echo $prescribeditems->price; ?></strong>
									      <br>									     
									      <a href="#" class="btn btn-info">Cancel Medication</a>
									    </div>

								        </div>		

							  	       <div class="col-md-4" id="dosagedetails" >	

							  	     	<div class="row" >
							  	     	 <div class="col-md-12" id="dosage" >
											<style>

											.text-center {
											    text-align: left;
											}
											.form-group {
											    margin-bottom: 0px;
											}
											</style>
								
					                                <form role="form" id="dosageform" name="dosageform">
					                                    <div class="box-body">
					                                      <div class="form-group">
					                                        <label for="dosename" class="mylabels">Dose name / Description</label>
					                                        <input type="text"  class="form-control classcustomeinputs"   id="dosename" name="dosename" placeholder="<?php  echo $prescribeditems->dosename; ?>" value="<?php  echo $prescribeditems->dosename; ?>">
					                                      </div>

					                                      <div class="form-group">
					                                        <label for="dose" class="mylabels">Dosage</label>
					                                        <input type="text"   class="form-control classcustomeinputs" id="dose" name="<?php  echo $prescribeditems->dose; ?>"  placeholder="<?php  echo $prescribeditems->dose; ?>">
					                                      </div> 

					                                      <div class="form-group">
					                                        <label for="minimumdose" class="mylabels">Min dose</label>
					                                        <input type="text" class="form-control classcustomeinputs" id="<?php  echo $prescribeditems->minimum; ?>" name="minimumdose"  placeholder="<?php  echo $prescribeditems->minimum; ?>">
					                                      </div> 

					                                      <div class="form-group">
					                                        <label for="maximumdose" class="mylabels">Max dose</label>
					                                        <input type="text" class="form-control classcustomeinputs" id="maximumdose" name="<?php  echo $prescribeditems->maximum; ?>" placeholder="<?php  echo $prescribeditems->maximum; ?>">
					                                      </div> 

					                                    </div>
					                                    <!-- /.box-body -->
					                                  </form>


							  	     	 </div>		


							  	     	</div>
								      </div>	


						               <div class="col-md-4" id="prescription" >
						               	<h5 style="margin-bottom:6px;" class="mylabels">My Prescription</h5>
										<div class="input-group">
											<span class="input-group-addon classcustomespan" id="basic-addon2">Refill date</span>
											<input type="text" class="form-control classcustomeinputs" placeholder="<?php  echo $prescribeditems->refilldate; ?>" value ="<?php  echo $prescribeditems->refilldate; ?>" aria-describedby="basic-addon2">											  
									    </div>

									    <div class="input-group">
											<span class="input-group-addon classcustomespan" id="basic-addon2">Start date</span>
											<input type="text" class="form-control classcustomeinputs" placeholder="<?php  echo $prescribeditems->startdate; ?>" value ="<?php  echo $prescribeditems->startdate; ?>"  aria-describedby="basic-addon2">											  
									    </div>

									    <div class="input-group">
											<span class="input-group-addon classcustomespan" id="basic-addon2">End date</span>
											<input type="text" class="form-control classcustomeinputs" placeholder="<?php  echo $prescribeditems->enddate; ?>" value ="<?php  echo $prescribeditems->enddate; ?>"  aria-describedby="basic-addon2">											  
									    </div>



							  	     </div>
								  </div>												
										<hr style="
										  border: 0; 
										  height: 1px; 
										  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
										  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
										  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
										  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
										">
								   <?php
								    }
							       ?>	











						  </div>	
		                </div>
		
		            </div>
		        </div>
		  </div>
		 </div>	
		</div>
	</div>



	<!-- 		<div class="col-md-4 team-grid text-center">
			<div class="team-img">Instructions on use

		      </div>
			</div> -->

			<div class="clearfix"></div>
		</div>
	</div>
</div>

<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/selectator/fm.selectator.jquery.js')?>"></script> 
<script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.ui.widget.js')?>"></script>


<script src="<?php echo base_url('assets/plugins/jcart/jquery.mycart.js')?>"></script> 

<script src='<?php echo base_url("assets/js/front/home.js");?>'></script>