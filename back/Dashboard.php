<?php
require_once('htmlMimeMail-2.5.1/send_mail.php');
require_once("../application/config/configRaw.php");
$actionId = filter_input(INPUT_POST, 'case', FILTER_SANITIZE_NUMBER_INT);


switch($actionId){
	case 1:
    //save to do details
    $uid = $_POST['userId'];
    $body = $_POST['todoText'];
    $bool = false;

    $sqlTodo = "INSERT INTO ems_todo(`user_id`,`body`) VALUES('".$uid."','".$body."');";

    if(mysql_query($sqlTodo)){
    	 $msg = "Saved successfully!";
    	$bool = true;
    }else{
    	$msg = mysql_error();
    }

    echo json_encode(array("response"=>$msg,"bool"=>$bool,"id"=>mysql_insert_id()));
	break;
	case 2:
	 $uid = $_POST['userId'];
     $sqlToDo = "SELECT * FROM ems_todo WHERE user_id = '".$uid."'";
     $resToDo = mysql_query($sqlToDo)or die(mysql_error());
     while($rowToDo = mysql_fetch_assoc($resToDo)){
      $body[]= $rowToDo['body'];
      $id[]= $rowToDo['id'];  
     }
     echo json_encode(array("body"=>$body,"id"=>$id));
	break;
	case 3:
	    $uid = $_POST['userId'];
		$todo = $_POST['id'];
        $bool = false;
		$idArr = explode('_',$todo);

		$sqlDeleteTodo = "DELETE FROM ems_todo WHERE id = '".$idArr[1]."' AND user_id = '".$uid."'";

		    if(mysql_query($sqlDeleteTodo)){
		    	 $msg = "Deleted successfully!";
		    	$bool = true;
		    }else{
		    	$msg = mysql_error();
		    }
    echo json_encode(array("response"=>$msg,"bool"=>$bool,"id"=>$idArr[1]));
	break;
	default;

		$names = $_POST['names'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$sqlSmtp = "SELECT * FROM ems_smtp LIMIT 0,1";
		$resSmtp = mysql_query($sqlSmtp)or die(mysql_error());
		$rowSmtp = mysql_fetch_assoc($resSmtp);

		$host = $rowSmtp['host'];
		$port = $rowSmtp['port'];;
		$username = $rowSmtp['username'];;
		$pass = $rowSmtp['pass'];
		$fromEmail = $rowSmtp['default_from_email'];
		$fromName = $rowSmtp['default_from_name'];
		$subject = $rowSmtp['default_mail_heading'];


		$cls = new SendMailClass($host,$port,$username,$pass);
		$response = $cls->getMails($email,$names, $subject, $message, $headers, $title,$fromEmail,$fromName,$key); 
		echo json_encode(array("response"=>$response));
	 break;

}


?>