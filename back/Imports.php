<?php
require_once('ImportsDatabase.php');
$output_dir = "uploads/";
//$output_dir = "/back/uploads/";
if(isset($_FILES["myfile"]))
{
	$ret = array();
	
//	This is for custom errors;	
/*	$custom_error= array();
	$custom_error['jquery-upload-file-error']="File already exists";
	echo json_encode($custom_error);
	die();
*/
	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
            $fileName = $_FILES["myfile"]["name"];
            move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
            $ret[]= $fileName;
            $fn = new ImportDatabase($output_dir.$fileName,$_GET['id'],$_GET['id2']);
            switch($_GET['case']){
               case 1:
                 $response = $fn->saveStudents();   
               break;
               case 2:
                 $response = $fn->saveMarks($_GET['inst'],$_GET['class_id'],$_GET['stream_id'],$_GET['exam_id'],$_GET['subject_id'],$_GET['term_id']); 
               break;                  
               default:
                 $response = $fn->saveInstitutions();     
               break;
            } 
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  	$ret[]= $fileName;
	  }
	
	}
    echo json_encode($ret);
 }
 ?>