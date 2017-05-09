				 
				var table;
				var selectedRow = null;
				
				jQuery(document).ready(function($) {

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









          medicationtable = $('#medicationtable').DataTable({ 
				 
				        "processing": true, 
				        "serverSide": true, 
				        "order": [], 
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "medc-fetch?id=1", 
				            "type": "POST"
				        },
				        		select: {
							style:    'os',
							selector: 'td:first-child'
						},
				 
				        //Set column definition initialisation properties.
				        "columnDefs": [
				        { 
				            "targets": [ 0 ], 
				            "orderable": false, 
				        },
				        { 
				            "targets": [ 1 ], 
				            "width": "5%" 
				        },
			      
				         {
				                "targets": [ 0 ],
				                "visible": false
				         },
				         {
				                "targets": [ 5 ],
				                "className": "dt-right"
				         }, {
				                "targets": [ 6 ],
				                "className": "dt-right"
				         },
				         {
				                "targets": [ 3 ],
				                "className": "dt-left"
				         },{
							"targets" : 2 ,
							"data": "img",
							"width": "10%",
							"render" : function ( url, type, full) {
							return '<img style=" border-radius: 20%;" height="20%" width="100%" src="'+full[2]+'"/>';
							}
                          },
                          {
							"targets" : 4 ,
							"data": "img",
							"width": "5%",
							"render" : function (data, type, full, meta) {						
	
                              return '<input onchange="setChecked(this)" type="checkbox" name='+full[0]+' value="' + $('<div/>').text(data).html() + '">';
							 //return '<button class="btn btn-danger my-cart-btn" data-id="'+full[0]+'" data-name="'+full[3]+'" data-summary="'+full[3]+'" data-price="'+full[6]+'" data-quantity="1" data-image="'+full[2]+'">add to cart</button>';
							}
                          }

				        ],
				         "drawCallback": function(settings, json) {			   

					 


					  }
				 
				    });	
		

				    medicationtable.on( 'click', 'tr', function (id) { 						                 
				         //var medicationselRow = medicationtable.row('.selected').data();				     
				        // medicationelectedRow = medicationselRow[0];
				         //moreSelectEvents(selectedRow);	 
			         });


				$(function() {

				    $.ajax({
				        type: "GET",
				        url: "presc-loadordered?id="+selectedRow,
				    }).done(function(countries) {

				        //countries.unshift({ id: "0", name: "" });

				   orderedtable = $("#jsGrid").jsGrid({
				            height: "70%",
				            width: "100%",
				            filtering: false,
				            inserting: false,
				            editing: true,
				            sorting: true,
				            paging: true,
				            autoload: true,
				            pageSize: 10,
				            pageButtonCount: 5,
				            deleteConfirm: "Do you really want to cancel this ordered product?",
				            controller: {
				                loadData: function(filter) {
				                    return $.ajax({
				                        type: "GET",
				                        url: "presc-loadordered?id="+selectedRow,
				                        data: filter
				                    });
				                },
				                insertItem: function(item) {
				                    return $.ajax({
				                        type: "POST",
				                        url: "presc-loadordered?id="+selectedRow,
				                        data: item
				                    });
				                },
				                updateItem: function(item) {
				                    return $.ajax({
				                        type: "PUT",
				                        url: "presc-loadordered?id="+selectedRow,
				                        data: item
				                    });
				                },
				                deleteItem: function(item) {
				                    return $.ajax({
				                        type: "DELETE",
				                        url: "presc-loadordered?id="+selectedRow,
				                        data: item
				                    });
				                }
				            },
				            fields: [
				                { name: "qty", title: "Quantity", type: "number", width: 50 },
				                { name: "genericname", title: "Product", type: "text", width: 350 ,readOnly: true },
				                { name: "storename", title: "Store/Pharmacy", type: "text", width: 150, filtering: true , readOnly: true },
				                { name: "price", title: "Price", type: "text", width: 50 , readOnly: true},				               
				                { type: "control" }
				            ]
				        });

				    });


				});




				$(function(){

			    var ul = $('#upload ul');
                
			    $('#drop a').click(function(){
			        // Simulate a click on the file input button
			        // to show the file browser dialog
			        $(this).parent().find('input').click();
			    });

			    // Initialize the jQuery File Upload plugin
			    $('#upload').fileupload({

			        // This element will accept file drag/drop uploading
			        dropZone: $('#drop'),

			        // This function is called when a file is added to the queue;
			        // either via the browse button, or via drag/drop:
			        add: function (e, data) {

			            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
			                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

			            // Append the file name and file size
			            tpl.find('p').text(data.files[0].name)
			                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

			            // Add the HTML to the UL element
			            data.context = tpl.appendTo(ul);

			            // Initialize the knob plugin
			            tpl.find('input').knob();

			            // Listen for clicks on the cancel icon
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

			            // Calculate the completion percentage of the upload
			            var progress = parseInt(data.loaded / data.total * 100, 10);

			            // Update the hidden input field and trigger a change
			            // so that the jQuery knob plugin knows to update the dial
			            data.context.find('input').val(progress).change();

			            if(progress == 100){
			                data.context.removeClass('working');
			                $('#uploadpopup').css("visibility","hidden"); 
			            }
			      
			        },
			        done: function (e, data) {
				       	postVars = {"id": selectedRow}
				       	table.ajax.reload();
		        	    $.post("person-fetchedit",postVars,function(data){
		        	    loc = ""+ data.img;
                        $("#personimageholder").attr("src",loc);  
                        },"json");
				    },

			        fail:function(e, data){
			            // Something has gone wrong!
			            data.context.addClass('error');
			        }

			    });

			    // Prevent the default action when a file is dropped on the window
			    $(document).on('drop dragover', function (e) {
			        e.preventDefault();
			    });

			    // Helper function that formats the file sizes
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
				    table = $('#persontable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "rowId": 'extn',
                        select: true,
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "person-fetch?personType=1",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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

			            /* {
				                "targets": [ 40 ],
				                "visible": false
				         },*/
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
				         moreSelectEvents(selectedRow);	 
			         });

					table.on( 'draw', function () {
					   // alert( 'Table redrawn' );
					   // table.row(getCookie("personsel")).select();
					} );
                    
                    


			       //datatables
				    childtable = $('#prescriptiontable').DataTable({ 
				 
				        "processing": true, //Feature control the processing indicator.
				        "serverSide": true, //Feature control DataTables' server-side processing mode.
				        "order": [], //Initial no order.
				 
				        // Load data for the table's content from an Ajax source
				        "ajax": {
				            "url": "immunization-fetch?id=0",  //"url": "<?php echo site_url('patientController/ajax_list')?>",
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
				         selectedRowChild = selRow[0];
				         moreSelectEventsChild(selectedRowChild);	 
			         });				
				  


                     //http://dev.vast.com/jquery-popup-overlay/
				    $('#dialogpopup').popup({
				        pagecontainer: '.container',
				        autozindex:false,
				        transition: 'all 0.3s'
				    });

				    //Date picker
				    // $('#datepickerpop').datepicker({
				    // autoclose: true
				    // });

				   $("#dob").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});					 
				});

		        function add(){

                       $("#insu_id").val("");
                       $("#inscompanyname").val("");
                       $("#phone").val("");
                       $("#address").val("");
                       $("#memberno").val("");
                       $("#dob").val("");
                       $("#nationalid").val("");
                       $("#address").val("");
                       $("#phone").val("");
                       $("#town").val(""); 

		        	   $("#createNew").css("visibility", "visible");
                       $("#saveRecord").css("visibility", "hidden");
		        	   $("#popupheading").html("<b><h4>Add a new patient</h4></b>");
		               $('#dialogpopup').popup('show');
		             }

		        function savePatientUploads(){

		        	if(selectedRowChild){

		            var postVars = {						
						"doctorscomments": $("#doctorscomments").val(),											
						"id": selectedRowChild
					}

                   $.post("presc-addcomments",postVars,function(data){

                        alert("Successfully Saved!");
                        loadUrl = "presc-fetch?id="+selectedRow;
				        childtable.ajax.url(loadUrl).load();
				        moreSelectEventsChild(data.id);

                   },"json");	 


		        	}else{alert("Please select aa patient's upload!");}

		        }  

		         function clearInsu(){

				       $("#immun_id").val("");
                       $("#immunization").val("");
                       $("#immundate").val("");
                       $("#clinicattended").val("");
                      


		        }   

		         function deleteInsu(){
		        	if(selectedRowChild){
                      postVars = {"id": selectedRowChild}
		        	  $.post("immunization-delete",postVars,function(data){
		        	   childtable.row('.selected').remove().draw( false );
		        	   clearInsu();
		        	  }); 

		        	}else{
		        		alert("Please select an insurance company!");
		        	}


		        }  

		        function deleteRecord(){

		        	  postVars = {"id": selectedRow}
		        	  $.post("personinsurance-delete",postVars,function(data){
		        	   childtable.row('.selected').remove().draw( false );
		        	  }); 
		        } 

		        function edit(){                   

                    $("#createNew").css("visibility", "hidden");
                    $("#saveRecord").css("visibility", "visible");

		        	postVars = {"id": selectedRow}
		        	  $.post("person-fetchedit",postVars,function(data){

		        	  	$("#popupheading").html("<b><h4>Edit "+ data.initial +" "+  data.firstname +" "+  data.secondname  + " </h4></b>");

						if(data.gender == 1){
						gender = "Male";
						}else{gender = "Female";}	        
                      $("#id").val(data.id);
                      $("#initial").val(data.initial);
                      $("#firstname").val(data.firstname);
                      $("#secondname").val(data.secondname); 
                      $("#surname").val(data.surname);
                      $("#gender").val(gender);
                      $("#dob").val(data.dob);
                      $("#nationalid").val(data.nationalid);
                      $("#address").val(data.address);
                      $("#phone").val(data.phone);
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
						"initial": $("#initial").val(),
						"firstname": $("#firstname").val(),
						"secondname": $("#secondname").val(),
						"surname": $("#surname").val(),
						"gender": gender,
						"dob": $("#dob").val(),
						"nationalid": $("#nationalid").val(),
						"address": $("#address").val(),
						"type": 1,
						"phone": $("#phone").val(),
						"town": $("#town").val()
					}

                   $.post("person-edit",postVars,function(){

                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	



		        }  

				function createNew(){

					if($("#gender").val() == "Male"){
                           gender = 1; 
					}else{ gender = 2; }



					var postVars = {
						"initial": $("#initial").val(),
						"firstname": $("#firstname").val(),
						"secondname": $("#secondname").val(),
						"surname": $("#surname").val(),
						"gender": gender,
						"dob": $("#dob").val(),
						"nationalid": $("#nationalid").val(),
						"address": $("#address").val(),
						"type": 1,
						"phone": $("#phone").val(),
						"town": $("#town").val()
					}

                   $.post("person-add",postVars,function(){

                        alert("Successfully Saved!");
                        table.ajax.reload();
					    $('#dialogpopup').popup('hide');

                   });	

				}

				function moreSelectEvents(){ 
                       var selRow = table.row('.selected').data();
                       $("#personname").html(selRow[2] +" "+ selRow[3] );
                       $("#personaddress").html(selRow[5]); 
                       $("#personimageholder").attr("src","/assets/img/persondefault.jpg");
		        	   loc = ""+ selRow[7];
                       $("#personimageholder").attr("src",loc);
                       $("#personimageholderg").attr("height","200px"); 

       	               loadUrl = "presc-fetch?id="+selRow[0];	

				       childtable.ajax.url(loadUrl).load(); 


				       $("#insu_id").val("");
                       $("#immunization").val("");
                       $("#immundate").val("");
                       $("#clinicattended").val("");
                       
				}

				function changePersonImage(){
					if(selectedRow){
						 $("#selid").val(selectedRow); 
                         $('#uploadpopup').popup('show');
					}else{
						alert("Please select a record!");
					}

				}

				function moreSelectEventsChild(selectedPresc){
				 postvars = {"id":selectedPresc}
                  $.post("presc-formfetch",postvars,function(data){                  	
					$("#doctorscomments").val(data.doctorscomments);  
                  },"json");
				}

			   function openInNewTab(url) {
				    var win = window.open(url, '_blank');
				    win.focus();
				  }

				function viewUploadedDocument(){

				    var selRow = childtable.row('.selected').data();				     
			         
			         if(selRow){
			         	
			         	if(location.host=='192.168.1.207'){
                            url = "http://192.168.1.207/pharmaceuticals/"+selRow[3];
			         	}else{
	                            url = selRow[3];
			         	}
			         	openInNewTab(url) ;

			         }else{alert("Please select a document!");}				     

				}



	

	           $('#medicationspopup').popup({
			        pagecontainer: '.container',
			        autozindex:false,
			        transition: 'all 0.3s'
			    });

	           	$('#confirmorderspopup').popup({
			        pagecontainer: '.container',
			        autozindex:false,
			        transition: 'all 0.3s'
			    });

				function orderMedication(){

                  $('#medicationspopup').popup('show');
                    //orderedtable.jsGrid("loadData");
                   // $('#confirmorderspopup').popup('show');                 
				}

			  function executeOrder(){			  	

               if(selectedRow){

                     postvars = {
                     	"selectedOrders":keys,
                     	"storeid":$('#select1').val(),
                     	"patientid": selectedRow
                     }
                  $.post("presc-ordermed",postvars,function(data){  				     

				      $('#medicationspopup').popup('hide');

				       orderedtable.jsGrid("loadData");
                      $('#confirmorderspopup').popup('show');  

                  },"json");
                  }else{
						alert("Please select a Patient!");
					}

				}


		      var keys = [];

				function setChecked(obj){                      
						

						if(obj.checked){
							keys.push(obj.name);
						}else{
                           var index = keys.indexOf(obj.name);

                           if (index > -1) {
							    keys.splice(index, 1);
							}

						}				

				}

				function confirmOrder(){

                if(selectedRow){
                     postvars = {                    
                     	"patientid": selectedRow
                     }
                  $.post("presc-confirmordered",postvars,function(data){  				     
                       orderedtable.jsGrid("loadData");
				      $('#confirmorderspopup').popup('hide');
                  },"json");
                  }else{
						alert("Please select a Patient!");
					}

				}


