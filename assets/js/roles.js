
//

  userJsTree =   $('#treeView').jstree({
        'plugins': ["checkbox"],
        'core': {
            'data': {
                "url": "roles-fetch",
                "plugins": ["checkbox"],
                "dataType": "json"

            }
        }
    });  

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



        tablePharmacyChecked = $('#pharmacylist').DataTable({ 
                 "paging":   false,
                 "ordering": false,
                 "info":     false,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
             
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "rolespharm-fetch",
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
                      orderable: false,
                      className: 'select-checkbox',
                      'targets': 0,
                       'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                     }
                },
              
                     {
                            "targets": [ 0 ],
                            "visible": true
                     }
                    ],
             
                });



        tableAssignedChecked = $('#assignedlist').DataTable({ 
                 "paging":   false,
                 "ordering": false,
                 "info":     false,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
             
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "roles-fetchassigned?id="+$('#select2').val(),
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
                      orderable: false,
                      className: 'select-checkbox',
                      'targets': 0,
                       'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                     }
                },
              
                     {
                            "targets": [ 0 ],
                            "visible": true
                     }
                    ],
             
                });



}); 


  function reloadAssigned(){

        loadUrlDeAssignedPharmacy = "roles-fetchassigned?id="+$('#select2').val(); 
        tableAssignedChecked.ajax.url(loadUrlDeAssignedPharmacy).load(); 

  }


 function assignSelected(){ 
            var keys = [];
            tablePharmacyChecked.$('input[type="checkbox"]').each(function(){

               if (this.checked){

                  keys.push(this.value);   

               }
            });

           userId = $('#select2').val();  

            postvars = {
              "userid": userId,
              "pharmacyids":keys
            } 

          $.post("roles-assignpharm",postvars,function(data){
                    loadUrlDeAssignedPharmacy = "roles-fetchassigned?id="+$('#select2').val(); 
                    tableAssignedChecked.ajax.url(loadUrlDeAssignedPharmacy).load(); 
            },"json");
          

  } 



    function deassignSelected(){
              var keys = [];
            tableAssignedChecked.$('input[type="checkbox"]').each(function(){
               if (this.checked){
                  keys.push(this.value);                 
               }
            });

           userId = $('#select2').val();  

            postvars = {
              "userid": userId,
              "pharmacyids":keys
            } 

          $.post("roles-pharmacydeassign",postvars,function(data){
                    loadUrlDeAssignedPharmacy = "roles-fetchassigned?id="+$('#select2').val(); 
                    tableAssignedChecked.ajax.url(loadUrlDeAssignedPharmacy).load(); 
            },"json");  
        } 



function saveRoles(){

       userId = $('#select1').val();    
       $('#savingroles').html("Saving roles..");
       if(userId){

       checkedObjects = userJsTree.jstree("get_checked",true);

       var arr = new Array();

       for (i = 0; i < checkedObjects.length; i++) {
          arr.push(checkedObjects[i].id);       
        }

       var postVars = {
        "user_id" : userId,
        "checked" :arr
       } 

       $.post("roles-save",postVars,function(data){ 
           $('#savingroles').html("Saved!");
           alert("Successfully saved!");
       },"json");
  }else{alert("Please select a User!");}

 }


function checkSavedNodes(userId,obj){
 // check the nodes that have been saved in the database
    obj.bind("loaded.jstree", function (event, data) {
    
         var postVars = {
            "id" : userId
           } 
           $.post("roles-reload",postVars,function(data){             
            for (i = 0; i < data.length; i++) {    
               obj.jstree("check_node",data[i]);
            }
          },"json");

    });



}

function reloadRoles(obj){

   userId = $('#select1').val(); 

   obj.jstree("destroy"); 

   userJsTree=  obj.jstree({
        'plugins': ["checkbox"],
        'core': {
            'data': {
                "url": "roles-fetch",
                "plugins": ["checkbox"],
                "dataType": "json"

            }
        }
    }); 

  $('#savingroles').html("Save Roles"); 

  checkSavedNodes(userId,obj);

}

function  reLoadTree(){

   userId = $('#select1').val();

   $('#treeView').jstree("destroy");
   userJsTree=  $('#treeView').jstree({
        'plugins': ["checkbox"],
        'core': {
            'data': {
                "url": "roles-fetch",
                "plugins": ["checkbox"],
                "dataType": "json"

            }
        }
    });
 checkSavedNodes(userId);
 
}

function selectall(object){

  object.jstree("check_all");

}

function unselectall(object){

 object.jstree("uncheck_all");

}

function assignpharmacy(){
  $('#select2').val($('#select1').val()) ;
  $('#assignuserspopup').popup('show');

}

 
 
