<body>
<link rel="stylesheet" href='<?php echo base_url("assets/css/products.css");?>'  media="all" />
<link rel="stylesheet" href='<?php echo base_url("assets/css/animate.css");?>'  media="all" />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>


<!-- https://www.codeofaninja.com/2013/06/simple-php-pagination-script.html -->

<style>
article {
   /* height: 280px;*/
    width: 98%;
}
.col-item .photo img {
    height: 120px;
    margin: 0 auto;
    width: 70%;
}

.navbar-fixed-top, .navbar-fixed-bottom { 
    position: relative;
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

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="www.coreict.co.ke" target="_blank"></a></li>
            </ul>
            <ul class="nav navbar-nav">

		      <?php	

		         $query = $this->db->query('SELECT * FROM category WHERE parent IS NULL'); 
		         $row = $query->result();
                  $j=0;
		         foreach ($row as $key => $main) {
		         	if($j == 0){ 
		         		print('<li class="active"><a href="#">'.$main->categoryname.'</a></li>');
		         	} else{ 
		         		print('<li>'); 

		         		print('<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$main->categoryname.'<b class="caret"></b></a>'); 

		         		 $querychild1 = $this->db->query('SELECT * FROM category WHERE parent = "'.$main->id.'"'); 
		                 $row1 = $querychild1->result();
		         	
		         	     print('<ul class="dropdown-menu multi-level">');
		         	     foreach ($row1 as $key => $child1) {

		         	     	    $querychild2 = $this->db->query('SELECT * FROM category WHERE parent = "'.$child1->id.'"'); 
		                        $row2 = $querychild2->result();

	                           if(count($row2) >0){ //has kids

									print('<li class="dropdown-submenu">');
									print('<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$child1->categoryname.'</a>');
									print('<ul class="dropdown-menu">');
									foreach ($row2 as $key => $child2) {

									   $querychild3 = $this->db->query('SELECT * FROM category WHERE parent = "'.$child2->id.'"'); 
		                               $row3 = $querychild3->result();
		                               if(count($row3) >0){ 

												print('<li class="dropdown-submenu">');
												print('<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$child2->categoryname.'</a>');
												print('<ul class="dropdown-menu">');

													foreach ($row3 as $key => $child3) {

														   $querychild4 = $this->db->query('SELECT * FROM category WHERE parent = "'.$child3->id.'"'); 
							                               $row4 = $querychild4->result();
							                               if(count($row4) >0){

							                               		print('<li class="dropdown-submenu">');
																print('<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$child3->categoryname.'</a>');
																print('<ul class="dropdown-menu">');
																	foreach ($row4 as $key => $child4) {
																      print('<li><a href="#">'.$child4->categoryname.'</a></li>');
																   }
																print('</ul>');

							                               }else{
							                               	print('<li><a href="#">'.$child3->categoryname.'</a></li>');
							                               } 
                                                         
													}

											    print('</ul>');


		                               }else{
		                               	  print('<li><a href="#">'.$child2->categoryname.'</a></li>');
		                               }

								     }
									print('</ul>');


	                           }else{
	                           	   print('<li><a href="#">'.$child1->categoryname.'</a></li>');
	                           }   		         	       

		         	       }
		         	     print('</ul>'); 
                        print('</li>'); 

		         	}                  
		         	

		         	$j++;
		         }
		      

		       ?> 





            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


	</div>
</div>
<!-- //navigation -->
<!-- contact -->
<div class="contact wthree all_pad">

<iframe class="dataframe" id="dataframe" src="data-products?pg=1&st=1" scrolling="no">


</iframe>

<div class="container">



    <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination"></ul>
    </nav>


<div class="row" style="background-color:#98CD23;">
	<div class="col-md-2" style="
		bottom: 6% !important;
		position: relative;		
		cursor:hand;
	"> 
       <img class="img-responsive" style='width:370px;height:80px;cursor:hand;' src='<?php echo base_url("assets/img/payments_buttons.png");?>' alt=" " />
	</div>

	<div class="col-md-2" style="
		bottom: 6% !important;
		position: relative;		
		cursor:hand;
	"> 
       <img class="img-responsive" style='width:370px;height:80px;cursor:hand;' src='<?php echo base_url("assets/img/mpesa.png");?>' alt=" " />
	</div>

</div>









</div>
</div>

<script src="<?php echo base_url('assets/plugins/pagination/jquery.twbsPagination.js')?>"></script>
<script src='<?php echo base_url("assets/js/front/products.js");?>'></script>

