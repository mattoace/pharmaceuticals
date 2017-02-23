<?php
require_once("../application/config/configRaw.php");
$actionid = filter_input(INPUT_GET, 'case', FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$class_id = filter_input(INPUT_GET, 'class_id', FILTER_SANITIZE_NUMBER_INT);
$institution_id = filter_input(INPUT_GET, 'institution_id', FILTER_SANITIZE_NUMBER_INT);

switch($actionid){    
    case 1:
        $sqlDelStud = "DELETE FROM ems_studentclasses WHERE student_id = '".$id."'";
        if(mysql_query($sqlDelStud)){
            $insert = "INSERT INTO ems_studentclasses(`class_id`,`student_id`,`institution_id`)VALUES('".$class_id."','".$id."','".$institution_id."')";
            if(mysql_query($insert)){
               $response = "Sucessfully inserted."; 
            }else{
                $response = mysql_error();
            }
            
        }else{
            $response = mysql_error();
        }
        echo json_encode(array("response"=>$response));
    break;
    case 2:
         $sqlDelStud = "DELETE FROM ems_studentclasses WHERE student_id = '".$id."'";
        if(mysql_query($sqlDelStud)){  
        }else{
            $response = mysql_error();
        }
        echo json_encode(array("response"=>$response));        
    break; 
    case 3:
        $streamId = filter_input(INPUT_GET, 'streamId', FILTER_SANITIZE_NUMBER_INT);
        $sqlUpdateStream = "UPDATE ems_studentclasses SET stream_id = '".$streamId."' WHERE student_id = '".$id."' AND class_id ='".$class_id."'";
        if(mysql_query($sqlUpdateStream)){
            $response = "Updated!";
        }else{
            $response = mysql_error();
        }
        echo json_encode(array("response"=>$response));
    break;
    case 4:
        $streamId = filter_input(INPUT_GET, 'streamId', FILTER_SANITIZE_NUMBER_INT);
        $sqlUpdateStream = "UPDATE ems_studentclasses SET stream_id = null WHERE student_id = '".$id."' AND class_id ='".$class_id."'";
        if(mysql_query($sqlUpdateStream)){
            $response = "Updated!";
        }else{
            $response = mysql_error();
        }
        echo json_encode(array("response"=>$response)); 
    break;
    case 5:
        
         $studentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
         $subjectId = filter_input(INPUT_GET, 'subjectId', FILTER_SANITIZE_NUMBER_INT);
        
         $sqlSelSubj = "SELECT * FROM ems_studentsubject WHERE student_id = '".$studentId."' AND subject_id ='".$subjectId."'";
         $resSubj = mysql_query($sqlSelSubj)or die(mysql_error());
         if(mysql_num_rows($resSubj) ==0){           
            $insert = "INSERT INTO ems_studentsubject(`student_id`,`subject_id`)VALUES('".$studentId."','".$subjectId."')";
            if(mysql_query($insert)){
               $response = "Sucessfully inserted."; 
            }else{
                $response = mysql_error();
            }
         } 
        echo json_encode(array("response"=>$response)); 
    break;
    case 6:
        
         $studentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
         $subjectId = filter_input(INPUT_GET, 'subjectId', FILTER_SANITIZE_NUMBER_INT);
         
         $sqlDelStud = "DELETE FROM ems_studentsubject WHERE student_id = '".$studentId."' AND subject_id='".$subjectId."'";
         if(mysql_query($sqlDelStud)){
            $response = "Remove subject assignment to selected student"; 
         }else{
             $response = mysql_error();
         }
        echo json_encode(array("response"=>$response));
    break;    
}
