<link rel="stylesheet" href='<?php echo base_url("assets/css/products.css");?>'  media="all" />
<link rel="stylesheet" href='<?php echo base_url("assets/css/animate.css");?>'  media="all" />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>



 <style>
        h1 {
            font-size: 20px;
            color: #111;
        }

        .content {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }

        .tt-hint,
        .medsearch {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }

        .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
        form {
		    margin-bottom: -1%;
		    margin-left: -13%;
		    margin-top: -7%;
		}
    </style>
      <script>
        $(document).ready(function() {

            $('input.medsearch').typeahead({
                name: 'medsearch',
                remote: 'med-autofill?query=%QUERY'

            });




        $('input.medsearch').bind('typeahead:selected', function(obj, datum, name) {      
			       // alert(JSON.stringify(obj)); // object
			        // outputs, e.g., {"type":"typeahead:selected","timeStamp":1371822938628,"jQuery19105037956037711017":true,"isTrigger":true,"namespace":"","namespace_re":null,"target":{"jQuery19105037956037711017":46},"delegateTarget":{"jQuery19105037956037711017":46},"currentTarget":
			        //alert(JSON.stringify(datum)); // contains datum value, tokens and custom fields
			        // outputs, e.g., {"redirect_url":"http://localhost/test/topic/test_topic","image_url":"http://localhost/test/upload/images/t_FWnYhhqd.jpg","description":"A test description","value":"A test value","tokens":["A","test","value"]}
			        // in this case I created custom fields called 'redirect_url', 'image_url', 'description' 
			        //alert(JSON.stringify(name)); // contains dataset name
			        // outputs, e.g., "my_dataset"
                     //alert(datum.label);
            window.location = "data-relocate?id="+datum.label;

          });

        })
    </script>

     

<style>
article {
   /* height: 280px;*/
    width: 98%;
}
.col-item .photo img {
   /* height: 120px;*/
    height: 200px;
    margin: 0 auto;
    width: 70%;
}

.navbar-fixed-top, .navbar-fixed-bottom { 
    position: relative;
}

.col-sm-3 {
    height: 300px;  
}
.headingclass{
	background-color:#98CD23;
	color:white;
	padding-left: 2px;
}
.col-md-12.explore-left.wow.zoomIn.animated {
    margin-top: -20px;
    padding: 0;
}


@import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
.col-item
{
    border: 1px solid #E1E1E1;
    border-radius: 10px;
    background: #FFF;
}
.col-item:hover
{ 
  box-shadow: 0px 2px 5px -1px #000;
  -moz-box-shadow: 0px 2px 5px -1px #000;
  -webkit-box-shadow: 0px 2px 5px -1px #000;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 10px;   
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;   
  border-bottom:2px solid #52A1D5;        
}
.col-item .photo img
{
    margin: 0 auto;
   /* width: 100%;*/
    width: 80%;
    padding: 1px;
    border-radius: 10px 10px 0 0 ;
}

.col-item .info
{
    padding: 10px;
    border-radius: 0 0 5px 5px;
    margin-top: 1px;
}

.col-item .price
{
    /*width: 50%;*/
    float: left;
    margin-top: 5px;
}

.col-item .price h5
{
    line-height: 20px;
    margin: 0;
}

.price-text-color
{
    color: #219FD1;
}

.col-item .info .rating
{
    color: #777;
}

.col-item .rating
{
    /*width: 50%;*/
    float: left;
    font-size: 17px;
    text-align: right;
    line-height: 52px;
    margin-bottom: 10px;
    height: 52px;
}

.col-item .separator
{
    border-top: 1px solid #E1E1E1;
}

.clear-left
{
    clear: left;
}

.col-item .separator p
{
    line-height: 20px;
    margin-bottom: 0;
    margin-top: 10px;
    text-align: center;
}

.col-item .separator p i
{
    margin-right: 5px;
}
.col-item .btn-add
{
    width: 50%;
    float: left;
}

.col-item .btn-add
{
    border-right: 1px solid #E1E1E1;
    
}

.col-item .btn-details
{
    width: 50%;
    float: left;
    padding-left: 10px;
}
.controls
{
    margin-top: 20px;
}
[data-slide="prev"]
{
    margin-right: 10px;
}

/*
Hover the image
*/
.post-img-content
{
    height: 196px;
    position: relative;
}
.post-img-content img
{
    position: absolute;
    padding: 1px;
    border-radius: 10px 10px 0 0 ;
}
.post-title{
    display: table-cell;
    vertical-align: bottom;
    z-index: 2;
    position: relative;
}
.post-title b{
    background-color: rgba(51, 51, 51, 0.58);
    display: inline-block;
    margin-bottom: 5px;
    margin-left: 2px;
    color: #FFF;
    padding: 10px 15px;
    margin-top: 10px;
    font-size: 12px;
}
.post-title b:first-child{
    font-size: 14px;
}
.round-tag{
    width: 60px;
    height: 60px;
    border-radius: 50% 50% 50% 0;
    border: 4px solid #FFF;
    background: #37A12B;
    position: absolute;
    bottom: 0px;
    padding: 15px 6px;
    font-size: 17px;
    color: #FFF;
    font-weight: bold;
}

.col-item .rating {   
    font-size: 7px; 
}
.glyphicon {
  /*  font-size: 24px; */
     top: -1px !important; 
}

</style>

<div class="container">
<div style="float: right; cursor: pointer;">  
<div class="row" style="">
	<div class="col-md-6" > &nbsp;
    </div>

	<div class="col-md-2" style="">       
	</div>

	<div class="col-md-2" style=""> 
       <img class="img-responsive" onCLick="invoiceEntryPopup()" style='cursor:pointer;' src='<?php echo base_url("assets/img/mpesa.png");?>' alt=" " /><br>
	</div>
	<div class="col-md-2" >
  <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
</div>

</div>

    </div>

	<div class="row">
        <h2 class="headingclass" >tibamoja products</h2>
        <p>
            <h6>Refill your medication or order for our products.</h6><br>
        </p>
  		      <?php	

                $start = ($_GET['st'] ? $_GET['st'] : 0 );
                $offset = 10;               
                $category = ($_GET['ct'] ? $_GET['ct'] : 0);
                $pg = ($_GET['pg'] ? $_GET['pg'] : 1);


				if($category > 0){

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
							'https://tibamoja.co.ke/assets/img/defaultdrug.png') as img,

		         		    IF(cat.img IS NOT NULL,
							concat('https://tibamoja.co.ke/', cat.img),
							'https://tibamoja.co.ke/assets/img/catslider1.jpg') as catimg

							FROM
							 drugtocategory dtc , drugs d
							
							LEFT JOIN
							drugprices dp ON dp.drugid = d.id

							LEFT JOIN
                            category cat ON cat.id = '".$category."'

                            WHERE dtc.drugid = d.id AND dtc.categoryid = '".$category."'

							LIMIT ". $start." , ".$offset."
				         	"); 


					}else{						
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
							'https://tibamoja.co.ke/assets/img/defaultdrug.png') as img,

				            IF(cat.img IS NOT NULL,
							concat('https://tibamoja.co.ke/', cat.img),
							'https://tibamoja.co.ke/assets/img/catslider1.jpg') as catimg

							FROM
							drugs d
							LEFT JOIN
							drugprices dp ON dp.drugid = d.id

							LEFT JOIN drugtocategory dtc ON dtc.drugid = d.id AND dtc.categoryid = '".$category."' 

							LEFT JOIN
                            category cat ON cat.id = dtc.categoryid 

							LIMIT ". $start." , ".$offset."
				         	"); 

					}



		/*var_dump(

"
							SELECT 
							d.id,
							d.genericname,
							d.serialno,
							d.productid,
							dp.drugprice,
							dp.tax,
							IF(d.img IS NOT NULL,
							concat('https://tibamoja.co.ke/', d.img),
							'https://tibamoja.co.ke/assets/img/defaultdrug.png') as img,

				            IF(cat.img IS NOT NULL,
							concat('https://tibamoja.co.ke/', cat.img),
							'https://tibamoja.co.ke/assets/img/sliderimg2.png') as catimg

							FROM
							drugs d
							LEFT JOIN
							drugprices dp ON dp.drugid = d.id

							LEFT JOIN drugtocategory dtc ON dtc.drugid = d.id AND dtc.categoryid = '".$category."' 

							LEFT JOIN
                            category cat ON cat.id = dtc.categoryid 

							LIMIT ". $start." , ".$offset."
				         	"



						); exit();*/

                 //http://bootsnipp.com/snippets/KGmRQ

		         $row = $query->result();

		         print('<div class="content">');
		         print('<form>'); 
		         print('<input type="text" name="medsearch" size="30" class="medsearch" placeholder="Search....">');
		         print('</form>'); 
		         print('</div>');
		         print('<hr>'); 

                 print('<div class="col-md-12 explore-left wow zoomIn" style="background-color:transparent;" data-wow-duration="1.5s" data-wow-delay="0.1s"><img style="width:100%;height:300px;margin-top: 2%;margin-bottom: 1%;" src='.$row[0]->catimg.' class="img-responsive" alt="" /></div>'); //.$row[0]->catimg.

                  $j=0;
		         foreach ($row as $key => $product) {

							print('<div class="col-sm-3">');
							print('<article class="col-item">');
							print('<div class="photo">');
							print('<div class="options">');
							print('<button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Add to wish list">');
							print('<i class="fa fa-heart"></i>');
							print('</button>');
							print('<button class="btn btn-default" type="button" onCLick="rate()" data-toggle="tooltip" data-placement="top" title="Rate">');
							print('<i class="fa fa-exchange"></i>');
							print('</button>');
							print('</div>');
							print('<div class="options-cart"> ');       			
							print('<button class="btn btn-default my-cart-btn" data-id='.$product->id.' data-name="'.$product->genericname.'" data-summary="'.$product->genericname.'" data-price="'.$product->drugprice.'" data-quantity="1" data-image="'.$product->img.'">');
							print('<span class="fa fa-shopping-cart"></span>');
							print('</button>');
							print('</div>');
							print('<a href="#"> <img src="'.$product->img.'" class="img-responsive" alt="" /> </a>');
							print('</div>');
							print('<div class="info">');

							print('<div class="row">');
							print('<div class="price-details col-md-6">');
							print('<p class="details">');
							//print($product->genericname);
						

							print('<div class="info">');
							/*print('<div class="row">');

							print('<div class="price col-md-8">');
							print('<span style="font-size:8px;font-weight:200px;float:left;">'.$product->genericname.'</span>');
							print(' <h5 style="font-size:12px;font-weight:200px;float:left;"  class="price-text-color">Kes '.$product->drugprice.'</h5>');
							print('</div>');

							print('<div class="rating hidden-sm col-md-4">');
							print(' <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">');
							print(' </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">');
							print('</i><i class="fa fa-star"></i>');
							print('</div>');

							print('</div>');*/

                            print('<div class="separator clear-left">');

                            print('<div class="row">');

                            print('<div class="row" style="margin-bottom:-10%;">');
                            print('<div class="price col-md-8">');
                            print('<span style="font-size:8px;font-weight:200px;float:left;">'.$product->genericname.'</span>');
                            print('</div>');
                            print('<div class="price col-md-4">');
                            print(' <h5 style="font-size:12px;font-weight:200px;float:left;"  class="price-text-color">Kes '.$product->drugprice.'</h5>');
                            print('</div>');
                            print('</div>');

                            print('<div class="price col-md-8" style="margin-top:0px; margin-left: -7%;">');

                            print('<p class="btn-add">');							
                            print('<button class="btn btn-default my-cart-btn" style="padding:0px !important; width: 100px;" data-id='.$product->id.' data-name="'.$product->genericname.'" data-summary="'.$product->genericname.'" data-price='.$product->drugprice.' data-quantity="1" data-image="'.$product->img.'"><span style="font-size:14px;font-weight:200px;"><i class="fa fa-shopping-cart"></i><a   href="#" class="hidden-sm"> <span style="font-size:10px;margin-bottom: -6%;padding-right: 20%;">Add to Cart</span></span></button>      </a></p>');
                            print('</div>');
                            print('<div class="price col-md-4" style="margin-top:0px;">');

                            print('<div style="font-size: 8px; margin-top: 14%;margin-left: 50%;">');
                            print(' <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">');
                            print(' </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">');
                            print('</i><i class="fa fa-star"></i>');
                            print('</div>');

                            print('</div>');

                            print('</div>');	

                            print(' </div>');
							print(' <div class="clearfix">');
							print(' </div>');
							print(' </div>');
							print('</p>');

							//print('<span style="font-size:8px;font-weight:200px;float:left;">'.$product->genericname.'</span>');
							//print('<span style="font-size:14px;font-weight:200px;" class="price-new" >Kes '.$product->drugprice.'</span>');
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




                <div id="dialogpopupinvoice"   style="visibility:hidden;text-align:middle !important; width: 14%; position: fixed !important; top: 10% !important;"  class="well" >
                   <div id =""  > <h5><b>Please enter your invoice number</b></h5> </div>
                      <div class="col-md-12" > 
                            <!-- general form elements -->
                          <div style="margin-left:10%;margin-top:5%;"> 
                           
                                <form action=""  method="post" target="_top" onsubmit="return postInvoice(this)">
                                <input type="input" name="invoiceno" id="invoiceno"   value=''>
                                <input type="hidden" name="hosted_button_id" value="">
                                <input type="image" src="https://tibamoja.co.ke/assets/img/credit/mpesa.png" border="0" name="submit" alt="Lipa na MPESA"  

                                    style="

                                    height: 30px;
                                    margin-top: 2%;
                                    width: 60%;
                                    "
                                >
                                <img alt="" border="0" src="https://tibamoja.co.ke/assets/img/credit/mpesa.png" width="1" height="1">
                                </form>
                           
                          </div>
                          </div>                      
          

                </div>



                <div id="dialogpopuprate" class="well" style="visibility:hidden;background-color: #a8cee2;text-align:center !important;">
                   <div id ="" > <h5><b>Give a rating</b></h5> </div>

                      <div class="col-md-12">
                            <!-- general form elements -->
                          <div style="margin-left:10%;margin-top:5%;"> 
                           
                                    <input type="radio" name="rate" value="1"> 1 &nbsp;&nbsp;
                                    <input type="radio" name="rate" value="2"> 2 &nbsp;&nbsp;
                                    <input type="radio" name="rate" value="3"> 3 &nbsp;&nbsp;
                                    <input type="radio" name="rate" value="4"> 4 &nbsp;&nbsp;
                                    <input type="radio" name="rate" value="5"> 5
                           
                          </div>
                          </div>
                       
                          <div class="col-md-4"></div> 
                          <div class="col-md-4">  </div> 
                          <div class="col-md-4"><button type="button" id="saveRating" onClick="saveRating()" class="btn btn-block btn-danger enabled">Save</button> </div> 

                </div>


				<script src="<?php echo base_url('assets/plugins/pagination/jquery.twbsPagination.js')?>"></script>
				<script src="<?php echo base_url('assets/plugins/jcart/jquery.mycart.js')?>"></script>
                <script src='<?php echo base_url("assets/plugins/jquery-popup-overlay-gh-pages/jquery.popupoverlay.js");?>'></script>
				<script src='<?php echo base_url("assets/js/front/data.js");?>'></script>
				<script src='<?php echo base_url("assets/js/front/bootstrap-3.1.1.min.js");?>'></script>
				

	</div>

</div>










