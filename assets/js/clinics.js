				 
				var table;
				var selectedRow = null;
				
				jQuery(document).ready(function($) {
				    //datatables
				    table = $('#persontable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "clinic-fetch",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				         }
				        ],
				 
				    });	
		

				    table.on( 'click', 'tr', function (id) { 
						 table.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');                   
				         var selRow = table.row('.selected').data();				     
				         selectedRow = selRow[0];
				         moreSelectEvents(selRow);	 
			         });				
				  
                   
				    $('#dialogpopup').popup({
				        pagecontainer: '.container',
				        autozindex:false,
				        transition: 'all 0.3s'
				    });





				    $(function () {
				    'use strict';

				    // Initialize the jQuery File Upload widget:
				    $('#fileuploadimage').fileupload({
				        // Uncomment the following to send cross-domain cookies:
				        //xhrFields: {withCredentials: true},
				        url: 'clinic-imgupload'
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

					 
				});

		        function add(){

                       $("#clinicname").val("");
                       $("#location").val("");
                       $("#address").val("");
                       $("#latitude").val("");
                       $("#telephone").val("");
                       $("#email").val("");
                       $("#longitude").val("");
                       $("#town").val("");
                       $("#createNew").css("visibility", "visible");
                       $("#saveRecord").css("visibility", "hidden");
	                   $("#popupheading").html("<b><h4>Add new</h4></b>");
                       $('#dialogpopup').popup('show');
		             }

		        function deleteRecord(){

		        	  postVars = {"id": selectedRow}
		        	  $.post("clinic-delete",postVars,function(data){
		        	   table.row('.selected').remove().draw( false );
		        	  }); 
		        } 

		        function edit(){                   

                    $("#createNew").css("visibility", "hidden");
                    $("#saveRecord").css("visibility", "visible");

		        	postVars = {"id": selectedRow}
		        	  $.post("clinic-fetchedit",postVars,function(data){

		        	  	$("#popupheading").html("<b><h4>Edit "+ data.clinicname + " </h4></b>");
				        
                      $("#id").val(data.id);
                      $("#clinicname").val(data.clinicname);
                      $("#address").val(data.address);
                      $("#location").val(data.location);
                      $("#telephone").val(data.telephone);
                      $("#email").val(data.email);  
                      $("#latitude").val(data.latitude);
                      $("#longitude").val(data.longitude);
                      $("#town").val(data.town);                
 
                      $('#dialogpopup').popup('show');
		        	  },"json"); 
		        }  


		        function saveRecord(){

					if($("#gender").val() == "Male"){
                           gender = 1; 
					}else{ gender = 2; }

					var postVars = {
						"id": $("#id").val(),
						"clinicname": $("#clinicname").val(),
						"address": $("#address").val(),
					    "telephone": $("#telephone").val(),
						"email": $("#email").val(),
						"location": $("#location").val(),
						"longitude": $("#longitude").val(),
						"latitude": $("#latitude").val(),						
						"town": $("#town").val()
					}

                   $.post("clinic-edit",postVars,function(){

                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	



		        }  

				function createNew(){					

					var postVars = {
						"clinicname": $("#clinicname").val(),
						"address": $("#address").val(),
						"location": $("#location").val(),
						"telephone": $("#telephone").val(),
						"email": $("#email").val(),
						"town": $("#town").val(),						
						"latitude": $("#latitude").val(),
						"longitude": $("#longitude").val()
					}

                   $.post("clinic-add",postVars,function(){

                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	

				}

				function moreSelectEvents(selId){
                     $("#mylatitude").val(selId[6]);
					 $("#mylongitude").val(selId[7]);
					 loc = ""+ selId[8];
                     $("#pharmacyholder").attr("src",loc);				
					 locationObject.init($(".gllpLatlonPicker"));

				}

				function changePersonImage(){
					if(selectedRow){
						 $("#selid").val(selectedRow); 
                         $('#uploadpopup').popup('show');
					}else{
						alert("Please select a record!");
					}

				}

			   function uploadimage(){
		            if(selectedRow){
					$('#selId').val(selectedRow);                
                    $('#uploadpopupimage').popup('show');
                    }else{alert("Please select a clinic!");}  

				} 




