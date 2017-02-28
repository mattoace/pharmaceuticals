				 
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
				            "url": "users-fetch",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
					 
				});

		        function add(){

                       $("#clinicname").val("");
                       $("#location").val("");
                       $("#address").val("");
                       $("#latitude").val("");
                       $("#longitude").val("");
                       $("#town").val("");
                       $('#dialogpopup').popup('show');
		             }

		        function deleteRecord(){

		        	  postVars = {"id": selectedRow}
		        	  $.post("users-delete",postVars,function(data){
		        	   table.row('.selected').remove().draw( false );
		        	  }); 
		        } 

		        function edit(){                   

                    $("#createNew").css("visibility", "hidden");
                    $("#saveRecord").css("visibility", "visible");

		        	postVars = {"id": selectedRow}
		        	  $.post("users-fetchedit",postVars,function(data){

		        	  $("#popupheading").html("<b><h4>Edit "+ data.response[0].firstname + " </h4></b>");
				        
                      $("#id").val(data.response[0].id);
                      $("#fullnames").val(data.response[0].firstname +" "+ data.response[0].secondname);
                      $("#username").val(data.response[0].email);
                      $("#phone").val(data.response[0].phone); 
                      $("#pass").val(data.response[0].pass); 

                

					  if(data.response[0].type == 1){
						   $("#isadmin").prop('checked', true);
						}else{
					       $("#isadmin").prop('checked', false);
						}

					 if(data.response[0].isactive == 1){
						   $("#isactive").prop('checked', true);
						}else{
					       $("#isactive").prop('checked', false);
						}                   
            

                      $('#dialogpopup').popup('show');
		        	  },"json"); 
		        }  


		        function saveRecord(){				

					var postVars = {
						"id": $("#id").val(),
						"fullnames": $("#fullnames").val(),
						"username": $("#username").val(),
						"phone": $("#phone").val(),
						"pass": $("#pass").val(),
						"isadmin": $("#isadmin").is(':checked'),
						"isactive": $("#isactive").is(':checked')
					}

                   $.post("users-edit",postVars,function(){
                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');
                   });	



		        }  

				function createNew(){					

					var postVars = {
						"fullnames": $("#fullnames").val(),
						"username": $("#username").val(),
						"phone": $("#phone").val(),
						"pass": $("#pass").val()
					}

                   $.post("users-add",postVars,function(){

                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	

				}

				function moreSelectEvents(selId){					
					 loc = ""+ selId[9];
                     $("#personimageholder").attr("src",loc);
                     $("#fullnames").val(selId[2]+" "+selId[3]);
                     $("#username").val(selId[5]);
                     $("#email").val(selId[4]);
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




