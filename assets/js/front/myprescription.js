	jQuery(document).ready(function($) {

						$(function(){
					    var ul = $('#upload ul');                
					    $('#drop a').click(function(){			  
					        $(this).parent().find('input').click();
					    });			  
					    $('#upload').fileupload({			     
					        dropZone: $('#drop'),
					        add: function (e, data) {

					            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
					                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');			 
					            tpl.find('p').text(data.files[0].name)
					                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');			 
					            data.context = tpl.appendTo(ul);			        
					            tpl.find('input').knob();			 
					            tpl.find('span').click(function(){

					                if(tpl.hasClass('working')){
					                    jqXHR.abort();
					                }

					                tpl.fadeOut(function(){
					                    tpl.remove();
					                });
					            });                    
					            // Automatically upload the file once it is added to the queue
					            var jqXHR = data.submit();
					        },
					        progress: function(e, data){			            
					            var progress = parseInt(data.loaded / data.total * 100, 10);			        
					            data.context.find('input').val(progress).change();
					            if(progress == 100){
					                data.context.removeClass('working');
					                $('#uploadpopup').css("visibility","hidden"); 
					            }			      
					        },
					        done: function (e, data) {
						       	//postVars = {"id": userid , "persontype" : personType}
						       	childtable.ajax.reload();
				        	   /* $.post("person-fetchedit",postVars,function(data){
				        	    loc = ""+ data.img;
		                        $("#personimageholder").attr("src",loc);  
		                        },"json");*/
						    },
					        fail:function(e, data){			           
					            data.context.addClass('error');
					        }

					    });
					   
					    $(document).on('drop dragover', function (e) {
					        e.preventDefault();
					    });
					  
					    function formatFileSize(bytes) {
					        if (typeof bytes !== 'number') {
					            return '';
					        }

					        if (bytes >= 1000000000) {
					            return (bytes / 1000000000).toFixed(2) + ' GB';
					        }

					        if (bytes >= 1000000) {
					            return (bytes / 1000000).toFixed(2) + ' MB';
					        }

					        return (bytes / 1000).toFixed(2) + ' KB';
					        }
					 });

			       //datatables
				    childtable = $('#prescriptiontable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "presc-fetch?id="+userid,  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				                "targets": [ 3 ],
				                "visible": false
				         },
				         {
				                "targets": [ 0 ],
				                "visible": false
				         }
				        ],
				 
				    });	
		

				    childtable.on( 'click', 'tr', function (id) { 
						 childtable.$('tr.selected').removeClass('selected'); 
						 $(this).addClass('selected');                   
				         var selRow = childtable.row('.selected').data();				     
				         selectedRow = selRow[0];
				        	 
			         });



		});


	function uploadDocument(){

				if(userid){
						 $("#selid").val(userid); 
                         $('#uploadpopup').popup('show');
					}else{
						alert("User not logged in!");
					}
	}