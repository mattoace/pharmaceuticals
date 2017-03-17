	$(document).ready(function() {
	    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
	        e.preventDefault();
	        $(this).siblings('a.active').removeClass("active");
	        $(this).addClass("active");
	        var index = $(this).index();
	        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
	        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	    });
	});

	jQuery(document).ready(function($) {


		$(function () {

		      table = $('#persontable').DataTable({ 
				 
				        "processing": true, 
				        "serverSide": true, 
				        "order": [], 
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "medc-fetch?id=1", 
				            "type": "POST"
				        },
				        		select: {
							style:    'os',
							selector: 'td:first-child'
						},
				 
				        //Set column definition initialisation properties.
				        "columnDefs": [
				        { 
				            "targets": [ 0 ], 
				            "orderable": false, 
				        },
				        { 
				            "targets": [ 1 ], 
				            "width": "5%" 
				        },
			      
				         {
				                "targets": [ 0 ],
				                "visible": false
				         },
				         {
				                "targets": [ 5 ],
				                "className": "dt-right"
				         }, {
				                "targets": [ 6 ],
				                "className": "dt-right"
				         },
				         {
				                "targets": [ 3 ],
				                "className": "dt-left"
				         },{
							"targets" : 2 ,
							"data": "img",
							"width": "10%",
							"render" : function ( url, type, full) {
							return '<img style=" border-radius: 20%;" height="20%" width="100%" src="'+full[2]+'"/>';
							}
                          },
                          {
							"targets" : 4 ,
							"data": "img",
							"width": "5%",
							"render" : function ( url, type, full) {
							//return '<div class="col-md-3 text-center"><img src="images/img_4.png" width="150px" height="150px"><br>product 4 - <strong>$40</strong><br><button class="btn btn-danger my-cart-btn" data-id="4" data-name="product 4" data-summary="summary 4" data-price="40" data-quantity="1" data-image="images/img_4.png">Add to Cart</button><a href="#" class="btn btn-info">Details</a> </div>';
							

	

							 return '<button class="btn btn-danger my-cart-btn" data-id="'+full[0]+'" data-name="'+full[3]+'" data-summary="'+full[3]+'" data-price="'+full[6]+'" data-quantity="1" data-image="'+full[2]+'">add to cart</button>';
							}
                          }

				        ],
				         "drawCallback": function(settings, json) {
					   

					   			 var goToCartIcon = function($addTocartBtn){
							      var $cartIcon = $(".my-cart-icon");
							      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
							      $addTocartBtn.prepend($image);
							      var position = $cartIcon.position();
							      $image.animate({
							        top: position.top,
							        left: position.left
							      }, 500 , "linear", function() {
							        $image.remove();
							      });
							    }

							    $('.my-cart-btn').myCart({
							      classCartIcon: 'my-cart-icon',
							      classCartBadge: 'my-cart-badge',
							      classProductQuantity: 'my-product-quantity',
							      classProductRemove: 'my-product-remove',
							      classCheckoutCart: 'my-cart-checkout',
							      affixCartIcon: true,
							      showCheckoutModal: true,
							      clickOnAddToCart: function($addTocart){
							        goToCartIcon($addTocart);
							      },
							      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
							        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
							      },
							      checkoutCart: function(products, totalPrice, totalQuantity) {
							        console.log("checking out", products, totalPrice, totalQuantity);
							      },
							      getDiscountPrice: function(products, totalPrice, totalQuantity) {
							        console.log("calculating discount", products, totalPrice, totalQuantity);
							        return totalPrice * 0.5;
							      }
							    });
					 


					  }
				 
				    });	
		

				    table.on( 'click', 'tr', function (id) { 
						 table.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');                   
				         var selRow = table.row('.selected').data();				     
				         selectedRow = selRow[0];
				         //moreSelectEvents(selectedRow);	 
			         });

				  
				

			        $(function () {
					var $activate_selectator1 = $('#activate_selectator1');
					$activate_selectator1.click(function () {
						var $select1 = $('#select1');
						if ($select1.data('selectator') === undefined) {
							$select1.selectator({
								labels: {
									search: 'Search here...'
								}
							});
							$activate_selectator1.val('destroy selectator');
						} else {
							$select1.selectator('destroy');
							$activate_selectator1.val('activate selectator');
						}
					});
					$activate_selectator1.trigger('click');


					 postVars = {"id": $('#select1').val()}
		        	  $.post("clinic-fetchedit",postVars,function(data){
		        	  	$("#popupheading").html("<b><h4>Edit "+ data.clinicname + " </h4></b>");
		        	  			 $("#mylatitude").val(data.latitude);
								 $("#mylongitude").val(data.longitude);											
								 locationObject.init($(".gllpLatlonPicker"));                                      
		        	  },"json"); 
				});				
				  

				 $('#scanfield').keypress(function (e) {
					 var key = e.which;
					 if(key == 13)  
					  {
					    doScanProductId(this);
					    return false;  
					  }
					}); 


				 $('#scanfield2').keypress(function (e) {
					 var key = e.which;
					 if(key == 13)  
					  {
					    doScanProductId2(this);
					    return false;  
					  }
					}); 


			});

	});

	function uploadlist(){ 
         var selRow = table.row('.selected').data();
         if(selRow){
				selectedRow = selRow[0];
				window.location.href = "prescription?id="+selectedRow;
         }else{
         	alert("No drug selected!");
         }	
	}

	function selectChanged(obj){
        	postVars = {"id": obj.value}
		        	  $.post("clinic-fetchedit",postVars,function(data){
		        	  	$("#popupheading").html("<b><h4>Edit "+ data.clinicname + " </h4></b>");
		        	  			 $("#mylatitude").val(data.latitude);
								 $("#mylongitude").val(data.longitude);											
								 locationObject.init($(".gllpLatlonPicker"));                                      
		        	  },"json"); 
	}

	function doScanProductId(obj){

	          postVars = {"id": $('#scanfield').val()}

        	  $.post("med-scan",postVars,function(data){        	  	

                $("#scanbody").html(data.response);


	   			 var goToCartIcon = function($addTocartBtn){
			      var $cartIcon = $(".my-cart-icon");
			      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
			      $addTocartBtn.prepend($image);
			      var position = $cartIcon.position();
			      $image.animate({
			        top: position.top,
			        left: position.left
			      }, 500 , "linear", function() {
			        $image.remove();
			      });
			    }

			    $('.my-cart-btn').myCart({
			      classCartIcon: 'my-cart-icon',
			      classCartBadge: 'my-cart-badge',
			      classProductQuantity: 'my-product-quantity',
			      classProductRemove: 'my-product-remove',
			      classCheckoutCart: 'my-cart-checkout',
			      affixCartIcon: true,
			      showCheckoutModal: true,
			      clickOnAddToCart: function($addTocart){
			        goToCartIcon($addTocart);
			      },
			      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
			        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
			      },
			      checkoutCart: function(products, totalPrice, totalQuantity) {
			        console.log("checking out", products, totalPrice, totalQuantity);
			      },
			      getDiscountPrice: function(products, totalPrice, totalQuantity) {
			        console.log("calculating discount", products, totalPrice, totalQuantity);
			        return totalPrice * 0.5;
			      }
			    });

        	  },"json"); 

	   }


	   	function doScanProductId2(obj){

	          postVars = {"id": $('#scanfield2').val()}

        	  $.post("med-scan",postVars,function(data){        	  	

                $("#scanbody2").html(data.response);


	   			 var goToCartIcon = function($addTocartBtn){
			      var $cartIcon = $(".my-cart-icon");
			      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
			      $addTocartBtn.prepend($image);
			      var position = $cartIcon.position();
			      $image.animate({
			        top: position.top,
			        left: position.left
			      }, 500 , "linear", function() {
			        $image.remove();
			      });
			    }

			    $('.my-cart-btn').myCart({
			      classCartIcon: 'my-cart-icon',
			      classCartBadge: 'my-cart-badge',
			      classProductQuantity: 'my-product-quantity',
			      classProductRemove: 'my-product-remove',
			      classCheckoutCart: 'my-cart-checkout',
			      affixCartIcon: true,
			      showCheckoutModal: true,
			      clickOnAddToCart: function($addTocart){
			        goToCartIcon($addTocart);
			      },
			      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
			        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
			      },
			      checkoutCart: function(products, totalPrice, totalQuantity) {
			        console.log("checking out", products, totalPrice, totalQuantity);
			      },
			      getDiscountPrice: function(products, totalPrice, totalQuantity) {
			        console.log("calculating discount", products, totalPrice, totalQuantity);
			        return totalPrice * 0.5;
			      }
			    });

        	  },"json"); 

	   }




