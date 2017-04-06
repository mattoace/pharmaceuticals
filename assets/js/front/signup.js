function signUp(obj){
		var postVars  = {
			"name" : $("#name").val(),
			"email":$("#email").val(),
			"pass":$("#name").val() 
		}
		$.post("index.php/register",postVars,function(data){
			if(data.inserted){
				alert("Successfully created!");
				window.location.href = "index.php/login";
			}	
		},"json");
}

function searchMedications(){ 

    var postVars = {
    	"cat":$( "#categorysearch" ).val(),
        "name": $( "#productname" ).val(),
        "pricerange":$( "#amount" ).val()
      }
     $("#executesearch" ).val("Searching...");
     $.post("med-search",postVars,function(data){
     $("#searchholdmeds").html(data.response); 
        $( "#executesearch" ).val("Search Complete!");
     },"json"); 



}

jQuery(function(){

jQuery('#camera_wrap_1').camera({
	thumbnails: false
});

/*jQuery('#camera_wrap_2').camera({
	height: '400px',
	loader: 'bar',
	pagination: false,
	thumbnails: true
});*/
});
