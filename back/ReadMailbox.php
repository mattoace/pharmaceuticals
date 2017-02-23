<?php
require_once("../application/config/configRaw.php");
ini_set("memory_limit", "-1");
set_time_limit(0);


$sqlSmtp = "SELECT * FROM ems_smtp LIMIT 0,1";
$resSmtp = mysql_query($sqlSmtp)or die(mysql_error());
$rowSmtp = mysql_fetch_assoc($resSmtp);

$mailboxtype = $rowSmtp['smtp_type'];
$mailusername = $rowSmtp['default_from_email'];
$mailpassword = $rowSmtp['default_from_email_password'];
$smtp = $rowSmtp['host']; 

if($mailboxtype == 'imap'){
 $mb = imap_open("{".$smtp .":143/novalidate-cert}INBOX",$mailusername, $mailpassword );       
}else{
 $mb = imap_open('{'.$smtp.' :110/pop3}', $mailusername, $mailpassword );      
}

$messageCount = imap_num_msg($mb);

//var_dump($messageCount); exit();

for( $MID = 1; $MID <= $messageCount; $MID++ )
{


         $EmailHeaders = imap_headerinfo( $mb, $MID );
         $Body = imap_fetchbody( $mb, $MID, 1 );
         $mailDate[$MID] = $EmailHeaders->date;
         $mailsubject[$MID] = $EmailHeaders->Subject;
         $mailFrom[$MID] = $EmailHeaders->fromaddress;
	     //$Body = base64_decode($Body);
         $mailBody[$MID] =  stripslashes(strip_tags($Body)) ;
}


echo json_encode(array("maildate"=>$mailDate,"mailsubject"=>$mailsubject,"mailfrom"=>$mailFrom,"mailbody"=>$mailBody));


