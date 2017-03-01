<link rel="stylesheet" href='<?php echo base_url("assets/css/products.css");?>'  media="all" />
<link rel="stylesheet" href='<?php echo base_url("assets/css/animate.css");?>'  media="all" />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>

<div class="container">
<div style="float: right; cursor: pointer;">  
<div class="row" style="">
	<div class="col-md-6" > 
    </div>

	<div class="col-md-2" style="">       
	</div>

	<div class="col-md-2" style=""> 
       <img class="img-responsive" style='width:570px;height:20px;cursor:hand;' src='<?php echo base_url("assets/img/mpesa.png");?>' alt=" " />
	</div>

	<div class="col-md-2" >
  <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
</div>

</div>

    </div>

	<div class="row">
        <h2>Our pharmaceutical products</h2>
        <p>
            <h6>Refill your medication or order for our products.</h6><br>
        </p>
  		      <?php	

                $start = ($_GET['st'] ? $_GET['st'] : 0 );
                $offset = 10;
                $category = $_GET['ct'];
                $pg = ($_GET['pg'] ? $_GET['pg'] : 1);

		         $query = $this->db->query("
					SELECT 
					d.id,
					d.genericname,
					d.serialno,
					d.productid,
					dp.drugprice,
					dp.tax,
					IF(d.img IS NOT NULL,
					concat('https://tibamoja.co.ke/', d.img),
					'https://tibamoja.co.ke/assets/img/defaultdrug.png') as img
					FROM
					drugs d
					LEFT JOIN
					drugprices dp ON dp.drugid = d.id
					LIMIT ". $start." , ".$offset."
		         	"); 
		         $row = $query->result();
                  $j=0;
		         foreach ($row as $key => $product) {

							print('<div class="col-sm-3">');
							print('<article class="col-item">');
							print('<div class="photo">');
							print('<div class="options">');
							print('<button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Add to wish list">');
							print('<i class="fa fa-heart"></i>');
							print('</button>');
							print('<button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Rate">');
							print('<i class="fa fa-exchange"></i>');
							print('</button>');
							print('</div>');
							print('<div class="options-cart"> ');       			
							print('<button class="btn btn-default my-cart-btn" data-id='.$product->id.' data-name='.$product->genericname.' data-summary='.$product->genericname.' data-price='.$product->drugprice.' data-quantity="1" data-image='.$product->img.'>');
							print('<span class="fa fa-shopping-cart"></span>');
							print('</button>');
							print('</div>');
							print('<a href="#"> <img src='.$product->img.' class="img-responsive" alt="" /> </a>');
							print('</div>');
							print('<div class="info">');

							print('<div class="row">');
							print('<div class="price-details col-md-6">');
							print('<p class="details">');
							//print($product->genericname);
							print('</p>');
							print('<span style="font-size:8px;font-weight:200px;float:left;">'.$product->genericname.'</span>');
							print('<span style="font-size:14px;font-weight:200px;" class="price-new" >Kes '.$product->drugprice.'</span>');
							print('</div>');
							print('</div>');
							print('</div>');
							print('</article>');          
							print('</div>');

		         }?> 

		         <script>
                  var totalRecords = "<?php echo count($row); ?>";
                  var strt = "<?php echo $start; ?>";
                  var end = "<?php echo $end; ?>"; 
                  var pg = "<?php echo $pg; ?>";               
		         </script>

				<script src="<?php echo base_url('assets/plugins/pagination/jquery.twbsPagination.js')?>"></script>
				<script src="<?php echo base_url('assets/plugins/jcart/jquery.mycart.js')?>"></script>
				<script src='<?php echo base_url("assets/js/front/products.js");?>'></script>

				<script src='<?php echo base_url("assets/js/front/bootstrap-3.1.1.min.js");?>'></script>
				

	</div>

</div>










