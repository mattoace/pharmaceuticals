
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/jquery-ui-1.10.0.custom.min.css");?>'  />
<link rel="stylesheet" href='<?php echo base_url("assets/css/home.css");?>'  />
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<style>
.team-img ul li a {
    width: 100%;
}
.btn {
    padding: 5px;
}
.team-grids {
    margin-top: 5px;
}
table.dataTable tbody tr {
    font-size: 12px;
    line-height: 15px !important;
}
.ui-layout-center.ui-layout-pane.ui-layout-pane {
    background-color: #FCF8E3 !important;
}
.ui-layout-north.alert.alert-danger.alert-dismissable.ui-layout-pane.ui-layout-pane-north {
    background-color: #F2DEDE !important;
}
.input-sm {
    border-radius: 3px;
    font-size: 12px;
    height: 20px;
    line-height: 1.5;
    padding: 5px 10px;
    width: 80px !important;
}
.ui-layout-center.alert.alert-success.alert-dismissable.ui-layout-pane.ui-layout-pane-center {
    overflow-x: hidden !important;
}
.ui-layout-north.alert.alert-success.alert-danger.ui-layout-pane.ui-layout-pane-north {
    background-color: #F2DEDE !important;
}
</style>
<body>
<!-- header -->
<div class="banner page_head w3l">
	<div class="head_top">
		<div class="container">
			<div class="banner-right">
				<ul>
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+254 727 310 743</li>
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



	<div class="container">

			<div class="" id="layout" style="height:100vh;margin-top: 5px !important;">

			<div class="ui-layout-center">
             <!-- show the medicine details here -->




						<!-- team -->
										
								<div class="team-grids">
									<div class="col-md-4 team-grid text-center" id="drugdetails">
										<div class="team-img">
											 <!-- normal -->
							              <?php 
							                $query = $this->db->query('
										    SELECT 
											    d.id, d.genericname, dp.drugprice, i.img
											FROM
											    drugprices dp,
											    drugs d
											        LEFT JOIN
											    images i ON i.parent = d.id
											WHERE
											    dp.drugid = d.id AND d.id = "'.$_GET['id'].'"
											GROUP BY d.id

							                	'); 
							                $rows = $query->result();										             
							              ?>  

											<div class="ih-item circle effect1"><a href="#">
												<div class="spinner"> <img style="width:140px;height:140px;" src='<?php echo base_url($rows[0]->img);?>' alt="" class=""></div>												
												<div class="info">
												  <div class="info-back">
												  </div>
												</div></a></div>
											<!-- end normal -->
											<h4><?php echo $rows[0]->genericname; ?></h4>
											<p><b>KES <?php echo $rows[0]->drugprice; ?> /=</b></p>
											<script >var drugid = "<?php echo $_GET['id']; ?>";  </script>
									       
<!-- 
									        <button type="button" onClick = "orderDrug(drugid)" class="btn btn-danger">Order</button>  -->
									        <?php
												 $query = $this->db->query('SELECT d.id,s.storename,s.id as store,dp.drugprice FROM drugs d , drugprices dp , stores s WHERE dp.drugid = d.id AND s.id = dp.storeid AND d.genericname like (SELECT genericname FROM drugs WHERE id = '.$_GET['id'].')');
												         $i = 1;                                        
												                  foreach ($query->result() as $row)
												                      {?>
                                                                  <script > store = "<?php echo $row->store; ?>";  </script>
												                   <?php   print('<a href="#" class="list-group-item"><span style="font-size:9px;" id="'.$row->id.'_'.$row->store.'" class="badge badge-danger" onClick = "orderDrug(this)">Kes '.$row->drugprice.' /= | Add</span> <i class="ti ti-bell"></i> <span style="font-size:12px;"><b>'.$row->storename.'</b></span></a>'); ?>
												                   
												                   <?php   $i++;
												                      } 
									        ?>

 


										</div>
									</div>
									<div class="col-md-8 alert alert-warning alert-dismissable">
										
										<div class="row" class="team-img">
											<h3 class="title" style="
		    font-size: 20px;
		    text-align: left;		
		">Dosage<span style="width: 100%;background-color:#16A9EF;"></span></h3>

		<?php 
		$query = $this->db->query('
		SELECT 
		ds.id, ds.dosename, ds.minimumdose, ds.maximumdose , ds.dose
		FROM
		dose ds		
		WHERE
		ds.drugid = "'.$_GET['id'].'"
		'); 
		$rows = $query->result();										             
		?>  
		   <div id="dosedetails">
				<b>Dose name : </b><?php  echo $rows[0]->dosename;   ?>  <br>
				<b>Dose  : </b><?php  echo $rows[0]->dose;   ?>  <br>
				<b>Minimum dose : </b><?php  echo $rows[0]->minimumdose;   ?>  <br>
				<b>Maximum dose : </b><?php  echo $rows[0]->maximumdose;   ?>  <br>
			</div>
		</div>
		<div class="row">
		<br>								
	<h3 class="title" style="
		    font-size: 20px;
		    text-align: left;		
		">Transactions<span style="width: 100%;background-color:#16A9EF;"></span></h3>

<!-- 		<div class="ui-layout-north alert alert-success alert-danger" style="background:#F2DEDE !important;float:right;height:25px;">
			<button type="button" onClick = "sendOrder(this)" class="btn btn-warning" style="font-size:12px; margin-top: -50%;"><b>Order</b></button>
		</div> -->

										        <table id="persontable" class="display" cellspacing="0" width="100%">
										            <thead>
										                <tr>
										                    <th>Id</th>
						                                    <th>No</th>
						                                    <th>Price</th>
										                    <th>Description</th>
										                    <th>Date</th>
										                    <th>Transaction</th>
										                    <th>Status</th>					            
										                </tr>
										            </thead>
										            <tbody>
										            </tbody>
										 
										            <tfoot>
										                <tr>
										         
										                </tr>
										            </tfoot>
										        </table>	
												<div class="ui-layout-north alert alert-success alert-danger" style="background:#F2DEDE !important;float:right;height:25px;">
													<button id="orderbutton" name="orderbutton" type="button" onClick = "sendOrder(this)" class="btn btn-warning" style="font-size:12px; margin-top: -50%;"><b>Order</b></button>
												</div>
										</div>
									</div>				
									<div class="clearfix"></div>
								</div>					
				


				

			</div>

			<div class="ui-layout-north alert alert-success alert-danger" style="background:#F2DEDE !important;">

            <div style="float :left;width:85%;position:relative;">
			<span style=" font-size: 18px; font-weight: 900;">	User Panel : </span> Refill medication


			<?php 
			$query = $this->db->query('
			SELECT 
			sum(dp.drugprice) as totals
			FROM drugprices dp , patientrefill pr
			WHERE dp.drugid = pr.drugid
			AND pr.patientid = "'.$_COOKIE['userlogin'].'"
			AND pr.comments = "Pending"
			'); 
			$rows = $query->result();										             
			?>  

			</div>
			<div style="float:right;width:15%;position:relative;">
             <span style=" font-size: 18px; font-weight: 900;">Totals</span>
              <span style="float:right;margin-top:4px;">KES <?php  echo $rows[0]->totals; ?> /=</span>
			</div>

			</div>

			<div class="ui-layout-south">Transactions</div>
			<div class="ui-layout-east" id="inneright">
				<div class="ui-layout-north alert alert-danger alert-dismissable" style="background:#F2DEDE !important;">		
               
                     Quick search drug               


				</div>
				<div class="ui-layout-center alert alert-success alert-dismissable" style="background:#F2DEDE !important;">

					<table id="searchdrug" class="cdataTable" cellspacing="0" width="100%">
			            <thead>
			                <tr>
			                    <th>Id</th>                           
			                    <th>Description</th>		                   				            
			                </tr>
			            </thead>
			            <tbody>
			            </tbody>
			 
			            <tfoot>
			                <tr>
			         
			                </tr>
			            </tfoot>
			        </table>	

					</div>
				</div>


	<!-- 		<div class="ui-layout-west" id="innerleft">
				<div class="ui-layout-north">Prescribed drugs</div>
				<div class="ui-layout-center">Grid view</div>
			</div> -->


			</div>

	</div>









<!-- Fade & scale -->

<div id="dialogpopup" class="well" style="visibility:hidden;">
   <div id ="popupheading" class="alert alert-success alert-danger" > <h4>Prescription details</h4> </div>


      <div class="col-md-6">
            <!-- general form elements -->
          <div class="box box-primary"> 
            <!-- form start -->
            <form role="form">
              <div class="box-body">

                    <div class="form-group">
                      <label for="startdate">Start date</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>                                                     
                             <input type="text" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask id="startdate">
                             <input type="hidden" class="form-control" id="seldetails" placeholder="1">
                        </div>
                    </div>
              </div>      
            </form>
          </div>

          </div> 

           <div class="col-md-6"> 

            <div class="form-group">
                      <label for="enddate">End date</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>                                                     
                             <input type="text" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask id="enddate">
                        </div>
                    </div>


          </div>         
          <div class="col-md-6"></div>       
          <div class="col-md-6"><button type="button" id="executeOrder" onClick="executeOrder()" class="btn btn-block btn-danger enabled">Save</button></div> 

</div>







<script>
    $(document).ready(function () { //http://layout.jquery-dev.com/documentation.cfm#Properties_Methods
        $('#layout').layout({ applyDefaultStyles: true });
       //var myLayoutLeft = $('#innerleft').layout({ applyDefaultStyles: true });
       var myLayoutRight = $('#inneright').layout({ applyDefaultStyles: true });

     
    });
</script>
<script src='<?php echo base_url("assets/plugins/jquery-popup-overlay-gh-pages/jquery.popupoverlay.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.date.extensions.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.extensions.js");?>'></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script> 
<script src='<?php echo base_url("assets/js/front/prescription.js");?>'></script>