				 
				var table;
				var selectedRow = null;
				storeDropdown = $('#select1');
				
				jQuery(document).ready(function($) {


				$(function () {
				    'use strict';

				    // Initialize the jQuery File Upload widget:
				    $('#fileupload').fileupload({
				        // Uncomment the following to send cross-domain cookies:
				        //xhrFields: {withCredentials: true},
				        url: 'med-upload'
				    });

				    // Enable iframe cross-domain access via redirect option:
				    $('#fileupload').fileupload(
				        'option',
				        'redirect',
				        window.location.href.replace(
				            /\/[^\/]*$/,
				            '/cors/result.html?%s'
				        )
				    );

				    if (window.location.hostname === 'blueimp.github.io') {
				        // Demo settings:
				        $('#fileupload').fileupload('option', {
				            url: '//jquery-file-upload.appspot.com/',
				            // Enable image resizing, except for Android and Opera,
				            // which actually support image resizing, but fail to
				            // send Blob objects via XHR requests:
				            disableImageResize: /Android(?!.*Chrome)|Opera/
				                .test(window.navigator.userAgent),
				            maxFileSize: 999000,
				            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
				        });
				        // Upload server status check for browsers with CORS support:
				        if ($.support.cors) {
				            $.ajax({
				                url: '//jquery-file-upload.appspot.com/',
				                type: 'HEAD'
				            }).fail(function () {
				                $('<div class="alert alert-danger"/>')
				                    .text('Upload server currently unavailable - ' +
				                            new Date())
				                    .appendTo('#fileupload');
				            });
				        }
				    } else {
				        // Load existing files:
				        $('#fileupload').addClass('fileupload-processing');
				        $.ajax({
				            // Uncomment the following to send cross-domain cookies:
				            //xhrFields: {withCredentials: true},
				            url: $('#fileupload').fileupload('option', 'url'),
				            dataType: 'json',
				            context: $('#fileupload')[0]
				        }).always(function () {
				            $(this).removeClass('fileupload-processing');
				        }).done(function (result) {
				            $(this).fileupload('option', 'done')
				                .call(this, $.Event('done'), {result: result});
				        });
				    }

				});

                //images upload


				$(function () {
				    'use strict';

				    // Initialize the jQuery File Upload widget:
				    $('#fileuploadimage').fileupload({
				        // Uncomment the following to send cross-domain cookies:
				        //xhrFields: {withCredentials: true},
				        url: 'med-imgupload'
				    });

				    // Enable iframe cross-domain access via redirect option:
				    $('#fileuploadimage').fileupload(
				        'option',
				        'redirect',
				        window.location.href.replace(
				            /\/[^\/]*$/,
				            '/cors/result.html?%s'
				        )
				    );

				    if (window.location.hostname === 'blueimp.github.io') {
				        // Demo settings:
				        $('#fileuploadimage').fileupload('option', {
				            url: '//jquery-file-upload.appspot.com/',
				            // Enable image resizing, except for Android and Opera,
				            // which actually support image resizing, but fail to
				            // send Blob objects via XHR requests:
				            disableImageResize: /Android(?!.*Chrome)|Opera/
				                .test(window.navigator.userAgent),
				            maxFileSize: 999000,
				            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
				        });
				        // Upload server status check for browsers with CORS support:
				        if ($.support.cors) {
				            $.ajax({
				                url: '//jquery-file-upload.appspot.com/',
				                type: 'HEAD'
				            }).fail(function () {
				                $('<div class="alert alert-danger"/>')
				                    .text('Upload server currently unavailable - ' +
				                            new Date())
				                    .appendTo('#fileuploadimage');
				            });
				        }
				    } else {
				        // Load existing files:
				        $('#fileuploadimage').addClass('fileupload-processing');
				        $.ajax({
				            // Uncomment the following to send cross-domain cookies:
				            //xhrFields: {withCredentials: true},
				            url: $('#fileuploadimage').fileupload('option', 'url'),
				            dataType: 'json',
				            context: $('#fileuploadimage')[0]
				        }).always(function () {
				            $(this).removeClass('fileupload-processing');
				        }).done(function (result) {
				            $(this).fileupload('option', 'done')
				                .call(this, $.Event('done'), {result: result});
				        });
				    }

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
				            "url": "order-fetch?id="+storeDropdown.val(),  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				            "url": "orderdetails-fetch?id="+selectedRow,  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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


			  tableConfirmation = $('#confirmationtable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "orderdetails-fetch?id="+selectedRow,  
				            "type": "POST"
				        },
				        		select: {
							style:    'os',
							selector: 'td:first-child'
						},
				 
				        //Set column definition initialisation properties.
				        "columnDefs": [
				        { 
				            "targets": [ 1 ], //first column / numbering column
				            "orderable": false, //set not orderable
				        },
			      
				         {
				                "targets": [ 0 ],
				                "visible": true
				         },
				         {
					            orderable: false,
					            className: 'select-checkbox',
					            'targets': 0,
					             'render': function (data, type, full, meta){
						             return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
						         }
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




				 
				});



				function assigncategories(){

					  $('#categoriespopup').popup('show');	
					}


		        function add(){

                       $("#genericname").val("");
                       $("#drugprice").val("");
                       $("#tax").val("");
                       

		        	   $("#createNew").css("visibility", "visible");
                       $("#saveRecord").css("visibility", "hidden");
		        	   $("#popupheading").html("<b><h4>Add a new drug</h4></b>");
		               $('#dialogpopup').popup('show');
		             }
                     
                     
                function addCat(){

                       $("#categoryname").val("");
                       $("#description").val("");                       

                       $("#createNew").css("visibility", "visible");
                       $("#saveRecord").css("visibility", "hidden");
                       $("#popupheadingcat").html("<b><h4>Add a new category</h4></b>");
                       $('#dialogpopupcat').popup('show');
                     }

		        function deleteRecord(){

		        	  postVars = {"id": selectedRow}
		        	  $.post("med-delete",postVars,function(data){
		        	   table.row('.selected').remove().draw( false );
		        	  }); 
		        } 
                
                function deleteRecordCat(){

                      postVars = {"id": selectedRow}
                      $.post("cat-delete",postVars,function(data){
                       tableCat.row('.selected').remove().draw( false );
                      }); 
                } 

		        function edit(){                   

                    $("#createNew").css("visibility", "hidden");
                    $("#saveRecord").css("visibility", "visible");

		        	postVars = {"id": selectedRow}
		        	  $.post("med-fetchedit",postVars,function(data){

		        	  	$("#popupheading").html("<b><h4>Edit "+ data.genericname + " </h4></b>");

						if(data.gender == 1){
						gender = "Male";
						}else{gender = "Female";}	        
                      $("#id").val(data.id);
                      $("#genericname").val(data.genericname);
                      $("#drugprice").val(data.drugprice);
                      $("#tax").val(data.tax);
                      $('#dialogpopup').popup('show');
		        	  },"json"); 
		        } 
                
                function editCat(){                   

                    $("#createNew").css("visibility", "hidden");
                    $("#saveRecord").css("visibility", "visible");

                    postVars = {"id": selectedRow}
                     $.post("cat-fetchedit",postVars,function(data){

                      $("#popupheadingcat").html("<b><h4>Edit "+ data.categoryname + " </h4></b>");
          
                      $("#idcat").val(data.id);
                      $("#categoryname").val(data.categoryname);
                      $("#description").val(data.description);
                      $('#dialogpopupcat').popup('show');
                      },"json"); 
                }  


		        function saveRecord(){
			
					var postVars = {
						"id": $("#id").val(),
						"genericname": $("#genericname").val(),
						"drugprice": $("#drugprice").val(),
						"tax": $("#tax").val()
						
					}

                   $.post("med-edit",postVars,function(){

                        alert("Successfully Saved!");
                       // table.ajax.reload();
                       	    loadUrl = "med-fetch?id="+storeDropdown.val();				    
				            table.ajax.url(loadUrl).load();
					    $('#dialogpopup').popup('hide');

                   });	



		        }
                
                function saveCatRecord(){
            
                    var postVars = {
                        "id": $("#idcat").val(),
                        "categoryname": $("#categoryname").val(),
                        "description": $("#description").val()
                        
                    }

                   $.post("cat-edit",postVars,function(){

                        alert("Successfully Saved!");
                        loadUrl = ("cat-fetch");                    
                        tableCat.ajax.url(loadUrl).load();
                        $('#dialogpopupcat').popup('hide');

                   }); 

                } 
                
                
              function createCatNew(){   

                    var postVars = {
                        "categoryname": $("#categoryname").val(),
                        "description": $("#description").val()                      
                    }

                   $.post("cat-add",postVars,function(){

                        alert("Successfully Saved!");
                        tableCat.ajax.reload();
                        $('#dialogpopupcat').popup('hide');

                   });    

                }   

				function createNew(){			



					var postVars = {
						"genericname": $("#genericname").val(),
						"drugprice": $("#drugprice").val(),
						"tax": $("#tax").val()						
					}

                   $.post("med-add?id="+storeDropdown.val(),postVars,function(){

                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	

				}

				function uploadlist(){                 
					if(storeDropdown.val()){
					    $('#selId').val(storeDropdown.val());
			          $('#uploadpopup').popup('show');
					}else{alert("Please select a store/pharmacy");}                  


				}

				function selectChanged(obj){				
				    loadUrl = "order-filter?id="+obj.value;				    
				    table.ajax.url(loadUrl).load();
				    loadUrl = "orderdetails-fetch?id=0";				    
				    tableDetails.ajax.url(loadUrl).load();
				}

				function uploadimage(obj){
					if(selectedRow){
					$('#selIdimg').val(selectedRow);                
                    $('#uploadpopupimage').popup('show');
                    }else{alert("Please select a product from the medicine grid!");}   
				}

				function moreSelectEvents(selId){

			        loadUrl = "orderdetails-fetch?id="+selId;				    
				    tableDetails.ajax.url(loadUrl).load();


/*                      var postVars = {
						"selId": selId					
					}

                   $.post("med-images",postVars,function(data){                    
					    $('#images-box').html(data.response);
                   },"json");	



                   $.post("dose-fetch",postVars,function(data){ 
                   	if(data){
							$('#dosename').val(data.dosename);
							$('#minimumdose').val(data.minimumdose);
							$('#maximumdose').val(data.maximumdose);
							$('#dose').val(data.dose);	
						}else{

						    $('#dosename').val("");
							$('#minimumdose').val("");
							$('#maximumdose').val("");
							$('#dose').val("");

						}	
                   },"json");*/	

				}


				function selectChangedCategory(obj){					

					    loadUrlAssignedMedicine = "drugassigned-fetch?id=" + obj.value + "&sid=" + storeDropdown.val();    
                        tableAssigned.ajax.url(loadUrlAssignedMedicine).load(); 

                        loadUrlDeAssignedMedicine = "drugassigning-fetch?id=" + $('#select2').val() + "&sid=" + storeDropdown.val(); 
                        tableCatChecked.ajax.url(loadUrlDeAssignedMedicine).load(); 
				 }

				 function assignSelected(){	
						var keys = [];
						tableCatChecked.$('input[type="checkbox"]').each(function(){
						   if (this.checked){
						      keys.push(this.value);
						      //tableCatChecked.row(this).remove().draw( false );						     
						   }
						});

						postvars = {
							"storeid": storeDropdown.val(),
							"drugids":keys,
							"category" : $('#select2').val()
						}	

					$.post("drug-assigncat",postvars,function(data){
                          	  loadUrlAssignedMedicine = "drugassigned-fetch?id=" + $('#select2').val() + "&sid=" + storeDropdown.val();    
                              tableAssigned.ajax.url(loadUrlAssignedMedicine).load(); 

                              loadUrlDeAssignedMedicine = "drugassigning-fetch?id=" + $('#select2').val() + "&sid=" + storeDropdown.val(); 
                              tableCatChecked.ajax.url(loadUrlDeAssignedMedicine).load(); 
						},"json");
					

				 } 


				function deassignSelected(){
					    var keys = [];
						tableAssigned.$('input[type="checkbox"]').each(function(){
						   if (this.checked){
						      keys.push(this.value);						     
						   }
						});

						postvars = {
							"storeid": storeDropdown.val(),
							"drugids":keys,
							"category" : $('#select2').val()
						}	

					$.post("drug-deassign",postvars,function(data){
                          	  loadUrlAssignedMedicine = "drugassigned-fetch?id=" + $('#select2').val() + "&sid=" + storeDropdown.val();    
                              tableAssigned.ajax.url(loadUrlAssignedMedicine).load(); 

                              loadUrlDeAssignedMedicine = "drugassigning-fetch?id=" + $('#select2').val() + "&sid=" + storeDropdown.val(); 
                              tableCatChecked.ajax.url(loadUrlDeAssignedMedicine).load(); 
						},"json");	
				} 

				function selectChangedCategoryMain(obj){
                              loadUrlFilterCategory = "order-cfilter?id="+storeDropdown.val()+"&cat="+$('#select3').val(); 
                              table.ajax.url(loadUrlFilterCategory).load(); 
                              loadUrl = "orderdetails-fetch?id=0";				    
				              tableDetails.ajax.url(loadUrl).load();
				}

             //$("#doseSave").disabled = false;
				function saveDosage(obj){
			
						if(selectedRow){

							var postvars = {
								"dosename" :$("#dosename").val(),
								"minimumdose":$("#minimumdose").val(),
								"maximumdose":$("#maximumdose").val(),
								"dose":$("#dose").val(),
								"drugid":selectedRow
							}

							$.post("dose-add",postvars,function(){
								alert("Saved!");
							});


						}else{alert("Please select a drug!");}

				}


				function sendorderconfirmation(obj){
					if(selectedRow){

					   $('#confirmationpopup').popup('show');
			           loadUrl = "orderdetails-fetch?id="+selectedRow;				    
				       tableConfirmation.ajax.url(loadUrl).load();

				   }else{alert("Please select an Order!");}
	

				}

				function cOrders(){window.location="corders";}

				function confirmSelected(obj){

					var keys = [];
						tableConfirmation.$('input[type="checkbox"]').each(function(){
						   if (this.checked){
						      keys.push(this.value);						     					     
						   }
						});

				 var postVars = {
				 	"selItems":keys,
				 	"orderid":selectedRow
				  }	

					if(keys){

						 $('#confirmingselected').html("Processing,please wait.."); 	
		 				 $.post("order-confirm",postVars,function(){
		 				 	$('#confirmingselected').html("Selected Order Confirmed"); 	
		 					$('#confirmationpopup').popup('hide');
		 					selectChangedCategoryMain(obj);
		 				 });

					}else{
						alert("Please select an order line!");
					}

				
					
				}

				function changeQuantityOfSelected(obj){


					 $('#popchngeqty').popup('show');	

				}

				function saveQuantityChange (){

			        var oItems = [];
						tableConfirmation.$('input[type="checkbox"]').each(function(){
						   if (this.checked){
						      oItems.push(this.value);						     					     
						   }
						});
						if(oItems.length == 1 ){

						var postVars = {
							 	"selItems":oItems[0],
							 	"orderid":selectedRow,
							 	"value": $('#changeqty').val()
							  }	
	                    $.post("order-changeqty",postVars,function(){
		 				    $('#popchngeqty').popup('hide');
		 				     loadUrl = "orderdetails-fetch?id="+selectedRow;				    
				             tableConfirmation.ajax.url(loadUrl).load();	
		 				 });


						}else{
							alert("Please select a record to change the quantity!");
						}



				}







