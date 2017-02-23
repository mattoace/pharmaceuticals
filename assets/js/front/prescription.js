//shopping cart demo : http://www.jquery-az.com/jquery/demo.php?ex=69.0_1#
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function (m, key, value) {
                vars[key] = value;
            });
    return vars;
}
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

function executeOrder(){

var postvariables = {
		"user": getCookie('userlogin'),
		"sel":$('#seldetails').val(),
		"startdate":$('#startdate').val(),
		"enddate":$('#enddate').val()
	}

	$.post("med-order",postvariables,function(){
            table.ajax.reload();
		    $('#dialogpopup').popup('hide'); 
	});

	return true;
}

function orderDrug(storeobj){
 $('#seldetails').val(storeobj.id);
 $('#dialogpopup').popup('show');
return true;
}

function sendOrder(obj){
  var postVars = {
  	"id":getCookie("userlogin")
  }
    $('#orderbutton').html("Wait..");
	$.post("order-request",postVars,function(){
     $('#orderbutton').html("Done");
     table.ajax.reload(); 
	});  


}


jQuery(document).ready(function($) {

 $("#startdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
 $("#enddate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

	$(function () {

	    $('#dialogpopup').popup({
        pagecontainer: '.container',
        autozindex:false,
        transition: 'all 0.3s'
    });

	    //datatables
  table = $('#persontable').DataTable({ 
	       "paging":   false,
           "ordering": false,
           "info":     false,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "med-transfetch",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
	            "type": "POST"
	        },
	        		select: {
				style:    'os',
				selector: 'td:first-child'
			},
	 
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ 0 ], //first column / numbering column
	            "orderable": false, //set not orderable
	        },{
				                "targets": [ 0 ],
				                "visible": false
				         }
	        ]	 
	     });


	    table.on( 'click', 'tr', function (id) { 
						 table.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');                   
				         var selRow = table.row('.selected').data();				     
				         selectedRow = selRow[0];
				         //moreSelectEvents(selectedRow);	 
			         });				
				  	



    tableSerch = $('#searchdrug').DataTable({ 
	       "paging":   false,
           "ordering": false,
           "info":     false,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "med-transearch",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
	            "type": "POST"
	        },
	        		select: {
				style:    'os',
				selector: 'td:first-child'
			},
	 
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ 0 ], //first column / numbering column
	            "orderable": false, //set not orderable
	        },{
				                "targets": [ 0 ],
				                "visible": false
		    },
	        {
				                "targets": [ 1 ],
				                "visible": true
		    }
	        ]
	 
	    });	


    tableSerch.on( 'click', 'tr', function (id) { 
						 tableSerch.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');                   
				         var selRow = tableSerch.row('.selected').data();				     
				         selectedRow = selRow[0];				       
				         var postVars = {"id":selectedRow}
                         $.post("med-details",postVars,function(data){

                          $("#drugdetails").html(data.response);
                          $("#dosedetails").html(data.dosedetails);

                        },"json"); 
			         });


	    });	

				
				  
});	