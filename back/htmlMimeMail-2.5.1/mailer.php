<?php

   //send mail
   require '../PHPMailerAutoload.php';
   error_reporting(0); 
   define ("DB_CLASS", 1);                           
   $cls = new SendMailClass();                         
   
   class mailer
    { 

       public $host; 
       public $port; 
       public $username;
	   public $pass;

         function mailer($host,$port,$username,$pass){  
            $this->host = $host;
            $this->port = $port; 
            $this->username = $username;
			$this->pass = $pass;
            }
     
          function getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key)
            {    	
			              
                $mail->isSMTP();                                      
                $mail->Host = $this->host; 
                $mail->SMTPAuth = true;                              
                $mail->Username = $this->username;                
                $mail->Password = $this->pass;
                $mail->Port = $this->port; 
                $mail->SetFrom('mailsys@nts.nl', 'Quotation');
                $mail->addAddress($toEmail,$toName);
                $mail->addReplyTo($fromEmail,$fromName);                
                $mail->isHTML(true);    
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->AltBody = $message;

                if(!$mail->send()) {
                    $status ='Message could not be sent.<br>';
                    $status .= 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $status = "Mail succesfully sent to ".$toEmail;
                }

                return $status;
            }       
  }
                      

?>
