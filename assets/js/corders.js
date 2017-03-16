				 
				var table;
				var selectedRow = null;
				storeDropdown = $('#select1');
				
				jQuery(document).ready(function($) {

	              

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
				});


				$(function () {
					var $activate_selectator3 = $('#activate_selectator3');
					$activate_selectator3.click(function () {
						var $select3 = $('#select3');
						if ($select3.data('selectator') === undefined) {
							$select3.selectator({
								labels: {
									search: 'Search here...'
								}
							});
							$activate_selectator3.val('destroy selectator');
						} else {
							$select3.selectator('destroy');
							$activate_selectator3.val('activate selectator');
						}
					});
					$activate_selectator3.trigger('click');
				});
				 
				    //datatables
		      table = $('#persontable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "corder-fetch?id="+storeDropdown.val(),  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				        },
			      
				         {
				                "targets": [ 0 ],
				                "visible": false
				         },
				         {
				                "targets": [ 4 ],
				                "className": "dt-right"
				         },
				         {
				                "targets": [ 3 ],
				                "className": "dt-right"
				         }
				        ],
				 
				    });	
		

				    table.on( 'click', 'tr', function (id) { 
						 table.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');                   
				         var selRow = table.row('.selected').data();				     
				         selectedRow = selRow[0];
				         moreSelectEvents(selectedRow);	 
			         });	


				   tableDetails = $('#itemtable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "corderdetails-fetch?id="+selectedRow,  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				        },
			      
				         {
				                "targets": [ 0 ],
				                "visible": false
				         },
				         {
				                "targets": [ 4 ],
				                "className": "dt-right"
				         },
				         {
				                "targets": [ 3 ],
				                "className": "dt-right"
				         }
				        ],
				 
				    });	
		

				    tableDetails.on( 'click', 'tr', function (id) { 
						 tableDetails.$('tr.selected').removeClass('selected'); 
						 //$(this).addClass('selected');                   
				         //var selRow = tableDetails.row('.selected').data();				     
				         //selectedRow = selRow[0];
				         //moreSelectEvents(selectedRow);	 
			         });                     
                     
                     

				  
                     //http://dev.vast.com/jquery-popup-overlay/
				    $('#dialogpopup').popup({
				        pagecontainer: '.container',
				        autozindex:false,
				        transition: 'all 0.3s'
				    });


				   $('#dialogpopupimage').popup({
				        pagecontainer: '.container',
				        autozindex:false,
				        transition: 'all 0.3s'
				    });



				$(function () {
					var $activate_selectator2 = $('#activate_selectator2');
					$activate_selectator2.click(function () {
						var $select2 = $('#select2');
						if ($select2.data('selectator') === undefined) {
							$select2.selectator({
								labels: {
									search: 'Search here...'
								}
							});
							$activate_selectator2.val('destroy selectator');
						} else {
							$select2.selectator('destroy');
							$activate_selectator2.val('activate selectator');
						}
					});
					$activate_selectator2.trigger('click');
				});


	
				 
				});





      

				function selectChanged(obj){				
				    loadUrl = "corder-filter?id="+obj.value;				    
				    table.ajax.url(loadUrl).load();
				    loadUrl = "corderdetails-fetch?id=0";				    
				    tableDetails.ajax.url(loadUrl).load();
				}

		

				function moreSelectEvents(selId){

			        loadUrl = "corderdetails-fetch?id="+selId;				    
				    tableDetails.ajax.url(loadUrl).load();


				}

	

		
				function selectChangedCategoryMain(obj){
                              loadUrlFilterCategory = "corder-cfilter?id="+storeDropdown.val()+"&cat="+$('#select3').val(); 
                              table.ajax.url(loadUrlFilterCategory).load(); 
                              loadUrl = "corderdetails-fetch?id=0";				    
				              tableDetails.ajax.url(loadUrl).load();
				}

           


				function invoices(obj){

				
				window.location = "invoice";

				}

				function sendInvoice(obj){
		

				 var postVars = {				 	
				 	"orderid":selectedRow
				  }	

					if(selectedRow){

						 $('#confirmingselected').html("Processing,please wait.."); 	
		 				 $.post("invoice-create",postVars,function(){
		 				 	$('#confirmingselected').html("Invoice sent."); 
		 				 	//selectChangedCategoryMain(obj);
		 				 });

					}else{
						alert("Please select an order line!");
					}

				
					
				}



		        $('#pdfpopup').popup({
				        pagecontainer: '.container',
				        autozindex:false,
				        transition: 'all 0.3s'
				    });


				function generatePDF(){                               
			         var selRow = table.row('.selected').data();			         
                      //url = "http://192.168.1.207/pharmaceuticals/"+selRow[8]; // on localpc
                     url = selRow[9];					
				     PDFObject.embed(url, "#pdfpopup");
					 $('#pdfpopup').popup('show');					
					
				}




