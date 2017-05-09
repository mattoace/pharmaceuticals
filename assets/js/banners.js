				 
				var tableFiles;
				var tableFilesHome;
				var tree
				var selectedRow = null;
				var selectedRowHome = null;
				storeDropdown = $('#select1');
				

          function addItemCancel(box) 
            {
            dhtmlx.modalbox.hide(box);
            }    
  

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
				        url: 'banners-imgupload'
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

				    $('#fileuploadimage').bind('fileuploaddone', function (e, data) {
					  
					      var selectedRow = tree.getSelectedItemId();
					   
		                  var postVars = {
								"selId": selectedRow					
							}
		                   $.post("banners-images",postVars,function(data){ 
		                   	    $("tbody.files").empty();		                       							

							    $('#images-box').html(data.response);

							  var  loadUrlFilterCategory = "banners-files?id="+selectedRow; 
                                tableFiles.ajax.url(loadUrlFilterCategory).load();

                              var   loadUrlFilterCategoryHome = "banners-fileshome"; 
                                tableFilesHome.ajax.url(loadUrlFilterCategoryHome).load();

                                						   var postVars = {
								"selId": 1071988					
							}

		                   $.post("banners-images",postVars,function(data){                    
							    $('#images-boxhome').html(data.response);
		                    },"json");    

		                   },"json");

					});

				    if (window.location.hostname === 'blueimp.github.io') {
				        // Demo settings:
				        $('#fileuploadimage').fileupload('option', {
				            url: '//jquery-file-upload.appspot.com/',
				           
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



            tableFiles = $('#filestable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "paging":   false,
				        "ordering": false,
				        "info":     false,
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "banners-files?id=0",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				                "targets": [ 0 ],
				                "className": "dt-right"
				         },
				         {
				                "targets": [ 0 ],
				                "className": "dt-right"
				         },
				         {

							"targets" : 3 ,
							"data": "img",
							"width": "1%",
							"className": "dt-center",
							"render" : function ( url, type, full) {
							return '<img onclick="deleteImage('+full[0]+')" style=" border-radius: 10%;cursor:pointer;" height="10px" width="25%" src="https://tibamoja.co.ke/assets/img/deletefile.jpg"/>';

							}

                          },

                             {

							"targets" : 2 ,
							"data": "html",
							//"width": "1%",
							"className": "dt-left",
							"render" : function ( url, type, full) {
							return '<a target="_blank" href="banners-file-view?id='+full[0]+'">'+full[2]+'</a> ';

							}

                          }

				        ],
				 
				    });	
		

				    tableFiles.on( 'click', 'tr', function (id) { 
						 tableFiles.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');
				         var selRow = tableFiles.row('.selected').data();
				         selectedRow = selRow[0];  
				         getSliderText(selectedRow);              
				        
			         });	



				       tableFilesHome = $('#filestablehome').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "paging":   false,
				        "ordering": false,
				        "info":     false,
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "banners-fileshome?id=0",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				                "targets": [ 0 ],
				                "className": "dt-right"
				         },
				         {
				                "targets": [ 0 ],
				                "className": "dt-right"
				         },
				         {

							"targets" : 3 ,
							"data": "img",
							"width": "1%",
							"className": "dt-center",
							"render" : function ( url, type, full) {
							return '<img onclick="deleteImageHome('+full[0]+')" style=" border-radius: 10%;cursor:pointer;" height="10px" width="25%" src="https://tibamoja.co.ke/assets/img/deletefile.jpg"/>';

							}

                          },

                             {

							"targets" : 2 ,
							"data": "html",
							//"width": "1%",
							"className": "dt-left",
							"render" : function ( url, type, full) {
							return '<a target="_blank" href="banners-file-view?id='+full[0]+'">'+full[2]+'</a> ';

							}

                          }

				        ],
				 
				    });	
		

				    tableFilesHome.on( 'click', 'tr', function (id) { 
			             tableFilesHome.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');
				         var selRow = tableFilesHome.row('.selected').data();
				         selectedRowHome = selRow[0];  

						   var postVars = {
								"selId": 1071988					
							}

		                   $.post("banners-images",postVars,function(data){                    
							    $('#images-boxhome').html(data.response);
		                    },"json");                 
						    getSliderText(selectedRowHome);    
					       });	

					   var postVars = {
							"selId": 1071988					
						}

		               $.post("banners-images",postVars,function(data){                    
						    $('#images-boxhome').html(data.response);
		                },"json");  

                     

	            tree = new dhtmlXTreeObject("treeBox","100%","100%",0);

				if(location.host == '192.168.1.207'){
				    tree.setImagePath("http://"+location.host+"/pharmaceuticals/assets/plugins/dhxtree/skins/material/imgs/dhxtree_material/");
				}else{
					tree.setImagePath("http://"+location.host+"/assets/plugins/dhxtree/skins/material/imgs/dhxtree_material/");
				}							 
  

				 tree.enableThreeStateCheckboxes(true);            
				 tree.enableDragAndDrop(true,true);
				 tree.setDragBehavior(true,true);
				 tree.loadXML("cat-tree");

				 tree.attachEvent("onClick", function(id){
					   moreSelectEvents(id);
				 });

				
				 $('#dialogpopup').popup({
				        pagecontainer: '.container',
				        autozindex:false,
				        transition: 'all 0.3s'
				    });


				

				 
				});


                     			

		function uploadlist(){                 
					if(storeDropdown.val()){
					    $('#selId').val(storeDropdown.val());
			          $('#uploadpopup').popup('show');
					}else{alert("Please select a store/pharmacy");}                  


				}

		function selectChanged(obj){				
				    loadUrl = "med-fetch?id="+obj.value;				    
				    table.ajax.url(loadUrl).load();
				}

		function uploadimage(obj){

                    tree_branchId = tree.getSelectedItemId() ; 

					if(tree_branchId){
					$('#selIdimg').val(tree_branchId);                    
                     
                     $('#uploadpopupimage').popup('show');
                    }else{alert("Please select a category to add images to!");}   
				}

	    function uploadimageHome(obj){                   
					$('#selIdimg').val(1071988);
                    $('#uploadpopupimage').popup('show');                  
				}

		function moreSelectEvents(selId){                      

                      var postVars = {
						"selId": selId					
					}

                   $.post("banners-images",postVars,function(data){                    
					    $('#images-box').html(data.response);
                   },"json");
                
                     loadUrlFilterCategory = "banners-files?id="+selId; 
                     tableFiles.ajax.url(loadUrlFilterCategory).load(); 
				}
				

     
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

				function deleteImage(imgId){
					     selectedRow = tree.getSelectedItemId() ;
						 $.post("banners-files-delete?id="+imgId,function(){
								loadUrlFilterCategory = "banners-files?id="+selectedRow; 
                                tableFiles.ajax.url(loadUrlFilterCategory).load(); 
					  });
				}

			 function deleteImageHome(imgId){					   
						 $.post("banners-files-delete?id="+imgId,function(){
								loadUrlFilterCategory = "banners-fileshome"; 
                                tableFilesHome.ajax.url(loadUrlFilterCategory).load(); 
                                						   var postVars = {
								"selId": 1071988					
							}

		                   $.post("banners-images",postVars,function(data){                    
							    $('#images-boxhome').html(data.response);
		                    },"json");  
					     });
				}

			function saveSliderText(){	
							if(selectedRow){
						     	var postvars = {
												"id" :selectedRow,
												"text":$("#slidertext").val()
											    }
											$.post("banners-text",postvars,function(){
												alert("Saved!");
											});

							}else{
								alert("Please select a record from the grid!");
							}

				    
				}

			function saveSliderTextHome(){	
							if(selectedRowHome){
						     	var postvars = {
												"id" :selectedRowHome,
												"text":$("#slidertexthome").val()
											    }
											$.post("banners-text",postvars,function(){
												alert("Saved!");
											});

							}else{
								alert("Please select a record from the grid!");
							}

				    
				}

		 function getSliderText(selected){             
		     	var postvars = {
								"id" :selected
							    }
							$.post("banners-gettext",postvars,function(data){
								$("#slidertexthome").val(data.response);
								$("#slidertext").val(data.response);
							},"json");
							
		  }







