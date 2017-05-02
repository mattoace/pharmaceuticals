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

    //var pages = totalRecords/10;
    //parent.callParentPagination(pages);
    //alert(totalRecords);


    if($(this).innerWidth() > 1000){ 
 
         colheight = totalRecords / 4 ; 

         iheight = (440 * colheight ) + 850 ;

         parent.callResize(iheight);
    }else{    
         iheight = (totalRecords * 300) + 540; 
         parent.callResize(iheight);
    }



});

function getResize(){
    if($(this).innerWidth() > 1000){
 
         colheight = totalRecords / 4 ; 

         iheight = (190 * colheight ) + 850 ;

         parent.callResize(iheight);
    }else{    
         iheight = (totalRecords * 200) + 540; 
         parent.callResize(iheight);
    }

    }


function getTotalCount(){
      return totalRecords;
    }

function rate(){
      $('#saveRating').html("Save");
      $('#dialogpopuprate').popup('show');
}

function saveRating(){
  $('#saveRating').html("<b>Rating Saved!</b>");
  $('#dialogpopuprate').popup('hide'); 
}

function invoiceEntryPopup(){

 $('#dialogpopupinvoice').popup('show');
 
}


function postInvoice(frmObj){

parent.window.location = "https://tibamoja.co.ke/ws:pay-invoice?invoiceno="+$('#invoiceno').val();

return false;
}


