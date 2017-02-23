<?php

require 'PHPMailerAutoload.php';

error_reporting(0);

class mailer {

    public $host;
    public $port;
    public $username;
    public $pass;

    function mailer($host, $port, $username, $pass) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->pass = $pass;
    }

    function getMails($toEmail, $toName, $subject, $message, $headers, $title, $fromEmail, $fromName, $key ,$filepath,$file_name) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->pass;
        $mail->Port = $this->port;
        //temp use this switch for the permission enabled emails
        switch ($fromEmail) {
            case 'dave@nts.nl': $fromMail = $fromEmail;
                break;
            case 'justin@nts.nl': $fromMail = $fromEmail;
                break;
            case 'sharifah@nts.nl': $fromMail = $fromEmail;
                break;
            case 'albert@nts.nl': $fromMail = $fromEmail;
                break;
            case 'martin@nts.nl': $fromMail = $fromEmail;
                break;
            case 'kisuk@nts.nl': $fromMail = $fromEmail;
                break;
            case 'erik@nts.nl': $fromMail = $fromEmail;
                break;
            case 'jaco@nts.nl': $fromMail = $fromEmail;
                break;
            case 'john@nts.nl': $fromMail = $fromEmail;
                break;
            default : $fromMail = 'mailsys@nts.nl';
                break;
        }
        
        if($filepath){ 
           $mail->AddStringAttachment($filepath,$file_name);
        }
        
        $mail->SetFrom($fromMail, $fromName);
        $mail->addAddress($toEmail, $toName);
        $mail->addReplyTo($fromEmail, $fromName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        if (!$mail->send()) {
            $status = 'Message could not be sent.<br>';
            $status .= 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $status = "Mail succesfully sent to " . $toEmail;

            return $status;
        }
    }

}

?>
