	jQuery(document).ready(function($) {					

			       //datatables
				    childtable = $('#orderstable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.				
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "user-ordersfetch?id="+userid,  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				                "targets": [ 3],
				                "visible": false
				         },
				         {
				                "targets": [ 0 ],
				                "visible": false
				         },{
				                "targets": [ 10 ],
				                "visible": false
				         },
				          {

							"targets" : 9 ,
							"data": "html",
							"width": "15%",
							"className": "dt-left",
							"render" : function ( url, type, full) {
							return '<a target="_blank" href="'+full[10]+'">'+full[9]+'</a> ';

							}

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

