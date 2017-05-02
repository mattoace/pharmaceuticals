
<script type="text/javascript">
    function submitForm(){ 
      $('#prescriptionform').submit();	
    } 

function doPay(){
	$.post("pay",function(data){
			alert(data.response);
	},"json");	
}
</script>
<form name="prescriptionform" id="prescriptionform" method="post" action="ws-presc_upload?patientid=52" enctype="multipart/form-data">
<input type="file" name="uploadfiles"><br/>
<input type="button" onClick="submitForm()" name="submitprescription" value="Upload"><br/>
<hr>
<!-- <input type="button" onClick="doPay()" name="submitprescription" value="Africam talking pay"><br/> -->
</form>

