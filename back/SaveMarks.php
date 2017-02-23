<?php
require_once("../application/config/configRaw.php");
$class_id = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$valu = filter_input(INPUT_POST, 'val', FILTER_SANITIZE_NUMBER_INT);
$term_id = filter_input(INPUT_POST, 'term', FILTER_SANITIZE_NUMBER_INT);
$stream_id = filter_input(INPUT_POST, 'stream', FILTER_SANITIZE_NUMBER_INT);
$inst_id = filter_input(INPUT_POST, 'inst', FILTER_SANITIZE_NUMBER_INT);
$row_index = filter_input(INPUT_POST, 'row_inde[]', FILTER_SANITIZE_NUMBER_INT);
$exam_id = filter_input(INPUT_POST, 'exam_id', FILTER_SANITIZE_NUMBER_INT);
$subject_id = filter_input(INPUT_POST, 'subject_id', FILTER_SANITIZE_NUMBER_INT);


$sqlClear = "DELETE FROM ems_marks WHERE student_id = '".$id."' AND class_id = '".$class_id."' AND stream_id='".$stream_id."' AND exam_id = '".$exam_id."' AND subject_id='".$subject_id."' AND term_id='".$term_id."'";

if(mysql_query($sqlClear)){
 
    $sqlInsert = "INSERT INTO ems_marks(`class_id`,`stream_id`,`exam_id`,`subject_id`,`term_id`,`marks`,`student_id`)
    VALUES('".$class_id."','".$stream_id."','".$exam_id."','".$subject_id."','".$term_id."','".$valu."','".$id."')
    ";
    if(mysql_query($sqlInsert)){
       $response = "Successfully saved!"; 
    }else{$response = mysql_error(); }    
}else{
 $response = mysql_error();  
}

$row_index++;

echo json_encode(array('response'=>$response,'id'=>$id,'debug'=>$debug,'row_index'=>$row_index));






