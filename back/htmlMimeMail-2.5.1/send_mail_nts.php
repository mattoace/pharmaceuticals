<?php

//send mail
   include("htmlMimeMail2.php");
   error_reporting(0); 
   define ("DB_CLASS", 1);                           
   $cls = new SendMailClass();                         
   
   class SendMailClass
    { 

       public $host; 
       public $port; 
       public $username;
	   public $pass;

         function SendMailClass($host,$port,$username,$pass){  
            $this->host = $host;
            $this->port = $port; 
            $this->username = $username;
			$this->pass = $pass;			

                return $this->connect();
            }
                function connect() {       
                $this->mail = new htmlMimeMail();
				$this->mail->setSMTPParams($this->host,$this->port, "nts.nl", true,$this->username,$this->pass);				
            }
          
          function getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key,$file_path,$file_name)
            {     	
			
                    $this->mail->setSubject($subject); 
                    $this->mail->setHTML($message,$message );
					
					if($file_path){
					$attachment = $this->mail->getFile($file_path);
                    $this->mail->addAttachment($attachment,$file_name, 'application/pdf');
					}
					
					$fromEmail_ = $fromEmail;
					$fromEmail = 'mailsys@nts.nl';
					
					
				    $this->mail->setFrom($fromName. " <" . $fromEmail . ">");
					$this->mail->setReturnPath($fromEmail_);
					//$this->mail->setBcc($fromEmail_);
                     
                    if($this->mail->send(array($toName . " <" . $toEmail . ">"), "smtp"))             
                    {
                       $bool = 1;
                       $status = "Mail succesfully sent to ".$toEmail;					     
                    }
                    else
                    {					
                       $bool =0;
					   $err = implode(",<br>",$this->mail->errors);
                       $status = "<b>Failed</b> <br>".$err; 
                    }            
                    return $status;
            }       
  }
                      

?>
