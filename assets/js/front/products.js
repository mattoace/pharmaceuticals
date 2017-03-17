/*Tooltip*/
dataframe = document.getElementById('dataframe');

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

  function callResize(heigh){   
    $(dataframe).css("height",heigh+"px"); 
  }


$(function () {
  $('[data-toggle="tooltip"]').tooltip();



	/*http://esimakin.github.io/twbs-pagination/*/
 offset = 10;
 category = 2;

 var objpajination = $('#pagination').twbsPagination({
            totalPages: 50,
            visiblePages: 5,
            initiateStartPageClick:false,
            //startPage:1,
            onPageClick: function (event, page ) { 
            	if(page == 1){  offset = 1;	 }
            		    setCookie("page", page, 1);
            		    start = page *   offset ;	            		  
            		    dataframe.src= "data-products?st="+start+"&ct="+getCookie("categoryid")+"&pg="+page; 

                  
       return false;
       }
    });


});

function loadCategory(categoryname,categoryid){ 
  switch(categoryname){
    case "AllProducts":  
       dataframe.src= "data-products?st=0&ct=&pg=0";
       setCookie("categoryid",null, 1); 
    break;
    case "MyPrescriptions":  
         dataframe.src="user-prescription";
        setCookie("categoryid",null, 1);
    break;
    case "MyInvoices":  
        alert("Work on progress ~ invoices.");
        setCookie("categoryid",null, 1);
    break;
    case "MyOrders":  
        alert("Work on progress ~ Orders.");
         setCookie("categoryid",null, 1);
    break;
    default: 
     dataframe.src= "data-products?st=0&ct="+categoryid+"&pg=0"; 
     setCookie("categoryid", categoryid, 1);
    break;
  }
 
}


/*function callParentPagination(count){


     $('#pagination').twbsPagination('destroy');
                    $('#pagination').twbsPagination({
                      totalPages:count,
                      initiateStartPageClick:false,
                       onPageClick: function (event, page ) { 
                     if(page == 1){  offset = 1; }                      
                        start = page *   offset ;                   
                        dataframe.src= "data-products?st="+start+"&ct="+category+"&pg="+page;                              
                        return false;
                       }


                    });
                    alert(count);

}
*/
