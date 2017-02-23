<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

require '../PHPMailerAutoload.php';



$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                              

$mail->isSMTP();                                     
$mail->Host = '192.168.1.5';  
$mail->SMTPAuth = true;                               
$mail->Username = 'mailsys';                
$mail->Password = '1234mailsys';                          
                          
$mail->Port = 587;                                    

//$mail->Sender = 'martin@nts.nl';
$mail->SetFrom('erik@nts.nl ', 'NTS');


$mail->addAddress('martin@nts.nl', 'User');    
              
$mail->addReplyTo('sharifa@nts.nl', 'Information');


$mail->isHTML(true);                                  

$mail->Subject = 'Subject';
$mail->Body    = '<b>Body</b>';
$mail->AltBody = 'Body';

if(!$mail->send()) {
    echo 'Message could not be sent.<br>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


?>