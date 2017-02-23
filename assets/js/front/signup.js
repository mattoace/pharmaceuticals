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