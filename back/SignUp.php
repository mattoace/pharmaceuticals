<?php
require_once('htmlMimeMail-2.5.1/send_mail.php');
require_once("../application/config/configRaw.php");
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$schoolname = $_POST['schoolname'];
$website = $_POST['website'];
$username = $_POST['username'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$town = $_POST['town'];
$institution = $_POST['schoolcategory'];
$bool = false;

$sqlImageName = "SELECT * FROM ems_imgtmp";
$resImg = mysql_query($sqlImageName)or die(mysql_error());
$rowImg = mysql_fetch_assoc($resImg);

$img_name = $rowImg['image_name'];

$sqlUser = "INSERT INTO ems_users(`username`,`pass`,`fname`,`mname`,`email`,`mobile`,`role_id`,`profile_image`,`schoolname`,`website`)
VALUES('".$username."','".md5($pass)."','".$fname."','".$lname."','".$email."','".$mobile."',1,'".$img_name ."','".$schoolname."','".$website."')";


$sqlCheck = "SELECT * FROM ems_users WHERE username = '".$username."'";

$resCheck = mysql_query($sqlCheck);

if(mysql_num_rows($resCheck) >0){

  $response = "There exist a similar username,please select a unique username!";
}else{

	if(mysql_query($sqlUser)){

          $newUid = mysql_insert_id();
          mysql_query("DELETE FROM ems_imgtmp");
          $sqlSettings = "SELECT * FROM ems_smtp WHERE default_mail = 1";
		      $resSettings = mysql_query($sqlSettings)or die(mysql_error());
		      $rowSettings = mysql_fetch_assoc($resSettings);

          //check if there is an existing school in thedatabase
          $sqlCheckSchool = "SELECT * FROM ems_institution WHERE institution_name LIKE = '".$schoolname."'";
          $resCheckSchool = mysql_query($sqlCheckSchool);

          if(mysql_num_rows($resCheckSchool) == 0){
            $sqlInsertSchool = "INSERT INTO ems_institution(`institution_name`,`website`,`email`,`telephone`,`type`,`town`,`address`) VALUES('".$schoolname."','".$website."','".$email."','".$mobile."','".$institution."','".$town."','".mysql_real_escape_string($address)."')";
            if(mysql_query($sqlInsertSchool)){
              $response = "School entered into the ems database!";
              $newInstId = mysql_insert_id();
              //map the user to the institution
              mysql_query("INSERT INTO ems_userinstitution(`userId`,`institution`,`type`)VALUES('".$newUid."','".$newInstId."','".$institution."')");
            }else{
              $response = mysql_error();
            }
          }else{
             $rowSchool = mysql_fetch_assoc($resCheckSchool);
             mysql_query("INSERT INTO ems_userinstitution(`userId`,`institution`,`type`)VALUES('".$newUid."','".$rowSchool['id']."','".$rowSchool['type']."')");
          }

    			$host = $rowSettings['host'];
    			$port = $rowSettings['port'];
    			$username =$rowSettings['username'];
    			$pass = $rowSettings['pass'];

          $cls = new SendMailClass($host,$port,$username,$pass);

          $activationlink = "http://ems.coreict.co.ke/index.php/activate?id=".md5($newUid);
          $activeLink = '<a href="'.$activationlink.'">Activate User</a> ';

          $message = "  
            Dear ".$fname.", <br>
            Your account has been successfully created.<br>
            Click on this link to activate :  <u>".$activationlink."</u><br></p>
            <br>
            Warm Regards,<br> 
            Ems Admin.
           ";
           $names = $fname." ".$lname;
           $subject = "EMS User Account";
           $fromEmail = $rowSettings['default_from_email'];
           $fromName = $rowSettings['default_from_name'];
		   $resp = $cls->getMails($email,$names, $subject, $message, $headers, $title,$fromEmail,$fromName,$key); 
		   if( $resp ){
             $response = "An activation link has been sent to your email address.";
             $email = "admin_ems@coreict.co.ke";
             $subject = "EMS System";
             $activationlink = "http://ems.coreict.co.ke/index.php/activate?type=de&id=".md5($newUid);
             $activeLink = '<a href="'.$activationlink.'">Activate User</a> ';
             $mess = "
             Dear Admin,<br>
             <p>
             A new user account for : <br>
             Names : ".$names." <br>
             School Name : ".$schoolname." <br>
             Website : ".$website." <br>
             <br>
             If you need to deactivate the user , click on this link :  <u>".$activationlink."</u><br></p>
             <br>
             Warm Regards,<br>
             System Admin Ems.
             ";
             $cl = new SendMailClass($host,$port,$username,$pass);
             $resp = $cl->getMails($email,$subject, $subject, $mess, $headers, $title,$fromEmail,$fromName,$key); 
		   }else{
             $response = $resp; 
		   }  
		  
		  $bool = true;

		}else{
		   $response = mysql_error();
		}

}

echo json_encode(array("response"=>$response,"bool"=>$bool));

?>
