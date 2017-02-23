<?php

//send mail
   include("htmlMimeMail.php");
   error_reporting(0); 
   define ("DB_CLASS", 1);                          
                    
   
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
                $this->mail->setSMTPParams($this->host,$this->port, "coreict.co.ke", true,$this->username,$this->pass);  				
            }
          

       function getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key)
            {     
			        
                    $this->mail->setSubject($subject);
                    $this->mail->setHTML($message,$message );					
				            $this->mail->setFrom($fromName. " <" . $fromEmail . ">");
                    $this->mail->setHeader('Date',date("r"));
                    if($this->mail->send(array($toName . " <" . $toEmail . ">"), "smtp"))             
                    {
                       $bool = 1;
                       $status = "Mail succesfully send to ".$toEmail;
					             //$upDate = "Update message set statusCode = 1 where messageId = '{$key}' ";
					             //$resQ = mysql_query($upDate)or die(mysql_error());					   
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
