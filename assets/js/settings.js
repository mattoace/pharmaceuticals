				 
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
				            "url": "settings-fetch",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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

                       $("#id").val("");
                       $("#host").val("");
                       $("#port").val("");
                       $("#username").val("");
                       $("#pass").val("");
                       $("#defaultemail").val("");
                       $("#popupheading").html("<b><h4>Add new</h4></b>");
                       $("#createNew").css("visibility", "visible");
                       $("#saveRecord").css("visibility", "hidden");

                       $('#dialogpopup').popup('show');
		             }

		        function deleteRecord(){

		        	  postVars = {"id": selectedRow}
		        	  $.post("settings-delete",postVars,function(data){
		        	   table.row('.selected').remove().draw( false );
		        	  }); 
		        } 

		        function edit(){                   

                    $("#createNew").css("visibility", "hidden");
                    $("#saveRecord").css("visibility", "visible");

		        	postVars = {"id": selectedRow}
		        	$.post("settings-fetchedit",postVars,function(data){

		        	$("#popupheading").html("<b><h4>Edit "+ data.response[0].host + " </h4></b>");
				        
                    $("#id").val(data.response[0].id);                     
                    $("#host").val(data.response[0].host);
                    $("#port").val(data.response[0].port); 
                    $("#username").val(data.response[0].username);
					$("#pass").val(data.response[0].pass); 
					$("#defaultemail").val(data.response[0].defaultemail); 

     				if(data.response[0].def == 1){
						   $("#def").prop('checked', true);
						}else{
					       $("#def").prop('checked', false);
						}                    

                      $('#dialogpopup').popup('show');
		        	  },"json"); 
		        }  


		        function saveRecord(){				

					var postVars = {
						"id": $("#id").val(),
						"host": $("#host").val(),
						"port": $("#port").val(),
						"username": $("#username").val(),
						"pass": $("#pass").val(),
						"defaultemail": $("#defaultemail").val(),
						"def": $("#def").is(':checked')
					}

                   $.post("settings-edit",postVars,function(){
                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');
                   });

		        }  

				function createNew(){					

					var postVars = {
						"host": $("#host").val(),
						"port": $("#port").val(),
						"username": $("#username").val(),
						"pass": $("#pass").val(),
						"defaultemail": $("#defaultemail").val(),
						"def": $("#def").val()					
					}

                   $.post("settings-add",postVars,function(){
                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	

				}

				function moreSelectEvents(selId){					
					 
					$("#host1").val(selId[2]);
					$("#port1").val(selId[3]);
					$("#username1").val(selId[4]);
					$("#pass1").val(selId[5]);
					$("#defaultemail1").val(selId[6]);				
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




