<?php
require_once('htmlMimeMail-2.5.1/send_mail.php');
require_once("../application/config/configRaw.php");
$uId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM ems_users WHERE md5(id)='".$uId."'";

$res = mysql_query($sql)or die(mysql_error());

$type = $_GET['type'];


function createNesessaryRoles($userId){

	$myRoleValues = array(
	"sub_0_4",
	"sub_1_5",
	"sub_0_1",
	"sub_1_2",
	"sub_2_21",
	"main_1",
	"sub_0_3",
	"sub_1_15",
	"sub_2_16",
	"sub_3_17",
	"main_2",
	"sub_0_8",
	"sub_1_9",
	"main_3",
	"sub_0_7",
	"main_4",
	"sub_2_6",
	"sub_3_22",
	"main_5",
	"sub_0_10",
	"sub_1_11",
	"sub_2_12",
	"sub_3_13",
	"sub_4_14",
	"main_6",
	"sub_0_18",
	"sub_1_19",
	"sub_2_20",
	"main_7",
	"sub_0_23",
	"main_8",
	"j2_1"
	);

	foreach ($myRoleValues as $key => $module) {
		$explVars = explode('_',$module);
		$moduleId = end($explVars);
		$sqlInsertRoles = "INSERT INTO ems_useroles(`userId`,`moduleId`)VALUES('".$userId."','".$module."');";
		if($explVars[0]=='sub'){
			//enable add role for each submodule
			$sqlSubRoles = "INSERT INTO ems_accessroles(`module`,`add`,`edit`,`delete`,`user_id`)VALUES('".$module."','1','1','1','".$userId."');";		
		}else{$sqlSubRoles="";}
	    if(mysql_query($sqlInsertRoles)){
			mysql_query($sqlSubRoles);
		}else{
			$response = mysql_error();
		}
	}



} 

if(mysql_num_rows($res ) > 0){
   if($type == 'de'){
    //update to activate the user
	$sqlUpdate = "UPDATE ems_users SET is_active = 0 WHERE md5(id) = '".$uId."'";
   }else{
    //update to activate the user
	$sqlUpdate = "UPDATE ems_users SET is_active = 1 WHERE md5(id) = '".$uId."'";
    }

     $rowUser = mysql_fetch_assoc($res);
     mysql_query("DELETE FROM ems_accessroles WHERE user_id='".$rowUser['id']."'");
     mysql_query("DELETE FROM ems_useroles WHERE userId = '".$rowUser['id']."'"); 
	if(mysql_query($sqlUpdate)){

		//send email to user
	             $sqlSettings = "SELECT * FROM ems_smtp WHERE default_mail = 1";
	             $resSettings = mysql_query($sqlSettings)or die(mysql_error());
	             $rowSettings = mysql_fetch_assoc($resSettings);

				 $host = $rowSettings['host'];
				 $port = $rowSettings['port'];
				 $username =$rowSettings['username'];
				 $pass = $rowSettings['pass'];
				 $fromEmail = $rowSettings['default_from_email'];
                 $fromName = $rowSettings['default_from_name'];

				  $cls = new SendMailClass($host,$port,$username,$pass);

				  

				  $fname = $rowUser['fname'];
				  $lname = $rowUser['mname'];
				  $names= $rowUser['fname']." ".$rowUser['mname']; 
				  $email = $rowUser['email'];

                  createNesessaryRoles($rowUser['id']);

		          $message = "  
		          Dear ".$fname.", <br>
		          Your ems account has been successfully acivated.<br>
		          www.ems.coreict.co.ke<br>
		          Follow link : <u>http://ems.coreict.co.ke/index.php/signin</u><br> 
		          <br>
		          Warm Regards,<br> 
		          Ems Admin.
		          ";

		           $subject = "EMS Account activation.";

		       $resp = $cls->getMails($email,$names, $subject, $message, $headers, $title,$fromEmail,$fromName,$key);

			   if($type == 'de'){
			         mysql_query("DELETE FROM ems_accessroles WHERE user_id='".$rowUser['id']."'");
                     mysql_query("DELETE FROM ems_useroles WHERE userId = '".$rowUser['id']."'"); 
			         $msg = $fname." ".$lname." has been de-activated to access ems portal."; 
			   }else{
			   	     $msg = $fname." ".$lname." has been activated to access ems portal."; 
			   }
		  

	}

}else{
	$msg  = "Selected user no longer exists!";
}




echo json_encode(array("response"=>$msg));


