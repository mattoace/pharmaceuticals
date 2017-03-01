/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();

function setCookie(c_name, value, exdays)
	{
	    var exdate = new Date();
	    exdate.setDate(exdate.getDate() + exdays);
	    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
	    document.cookie = c_name + "=" + c_value;
	}


function getCookie(c_name)
	{
	    var i, x, y, ARRcookies = document.cookie.split(";");
	    for (i = 0; i < ARRcookies.length; i++)
	    {
	        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
	        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
	        x = x.replace(/^\s+|\s+$/g, "");
	        if (x == c_name)
	        {
	            return unescape(y);
	        }
	    }
	}



	/*http://esimakin.github.io/twbs-pagination/*/
 offset = 10;
 category = 2;
 //setCookie("page", 1, 1); 
//pg=5


 var objpajination = $('#pagination').twbsPagination({
            totalPages: 25,
            visiblePages: 5,
            initiateStartPageClick:false,
            //startPage:1,
            onPageClick: function (event, page ) { 
            	if(page == 1){  offset = 1;	 }
            		    setCookie("page", page, 1);
            		    start = page *   offset ;	
            		  
            		    dataframe.src= "data-products?st="+start+"&ct="+category+"&pg="+page;             
		                //window.location= "http://127.0.0.1/pharmaceuticals/index.php/home?st="+start+"&ct="+category+"&pg="+page;							

            
    return false;
            }
        });
        //console.info(obj.data());

 

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
      affixCartIcon: true,
      checkoutCart: function(products) {
        $.each(products, function(){
          console.log(this);
        });
      },
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      getDiscountPrice: function(products) {
        var total = 0;
        $.each(products, function(){
          total += this.quantity * this.price;
        });
        return total * 0.5;
      }
   });















});

