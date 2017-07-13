<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class RegistrationController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users','users');
        $this->load->helper('form');
        $this->load->helper('url');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }


    public function addNew(){  

          if (isset($_FILES["avatar-2"]["name"])) {
              $uploaddir = 'assets/uploads/users/';
              $imgpath = "assets/uploads/users/".$_FILES["avatar-2"]["name"];
              $uploadfile = $uploaddir . basename($_FILES['avatar-2']['name']);
              if (move_uploaded_file($_FILES['avatar-2']['tmp_name'], $uploadfile)) {
                  $status = "Success";
              } else {
                  $status = "Failed";
              }                   
          } else {             
          }    

          $homelatlongArray = array();
          if($this->input->post("homelatlong")){
              $homelatlongArray = explode(",", $this->input->post("homelatlong")); 
            }
          $worklatlongArray = array();
          if($this->input->post("worklatlong")){
              $worklatlongArray = explode(",", $this->input->post("worklatlong")); 
            }

          $namesArray = explode(" ", $this->input->post("name")); 

                 $array = array(
                    'firstname' => $namesArray[0] ,
                    'secondname' => $namesArray[1] ,
                    'email' => $this->input->post("email"),
                    'address' => $this->input->post("address"),
                    'homeaddress' => $this->input->post("homeaddress"),
                    'dob' => $this->input->post("dateofbirth"),
                    'gender' => $this->input->post("gender"),
                    'nationalid' => $this->input->post("nationalid"),
                    'phone' => trim($this->input->post("telephone")),
                    'town' => $this->input->post("town"),
                    'homelat' => $homelatlongArray[0],
                    'homelon' => $homelatlongArray[1],
                    'worklat' => $worklatlongArray[0],
                    'worklon' => $worklatlongArray[1],
                    'type' => 1,
                    'img' => $imgpath 
                );        

          $insertedid = $this->users->addNew($array);

                 $arrayUsers = array(
                    'username' => $this->input->post("email"),
                    'pass' => md5($this->input->post("pass")),
                    'personid'=> $insertedid,
                    'isactive'=> 1
                ); 

         $insertedid = $this->users->addNewUser($arrayUsers);

            //send email here

              require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");      

              $this->load->model('Order','order');

              $list = $this->order->fetchsmtp();

              $smtparray = $list->row_array();

              $cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']); 

              $toEmail = $this->input->post("email");

              $toName = $namesArray[0];

              $subject = "User Registration";

              $message = "You have successfully registered as a tibamoja user ,click the link below to confirm your registration. \n";

              $message .= "http://www.tibamoja.co.ke/activate?id=".$insertedid;

              $headers = "";

              $title = "User Registration";

              $fromEmail = $smtparray['defaultemail'];            

              $fromName = "tibamoja";

              $key = null;

             $response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key);               

             
             print('<script>alert("A confirmation message has been sent to your email address.");</script>');
             $page = 'login';
             $this->load->view('frontend/header', $data);
             $this->load->view('frontend/'.$page, $data);
             $this->load->view('frontend/footer', $data);

    }


    public function activate(){

         $array = array(
            'isactive' => 1
        );          

       $this->users->saveRecord($array,$this->input->get("id"));

       header("location:activated"); 

    }

    public function check(){

    	$array = array();

    	$email = $this->input->post("email");

    	$password = $this->input->post("pass"); 

    	  try {          
            
            $array = array('username' => $email, 'pass' => md5($password) , 'isactive' => 1);

             $this->load->model('Login','login'); 

             $qcd = $this->login->login_check($array); 
    
            if ($qcd->num_rows()>0) {
                $result = $qcd->row_array();
            } else {
                $result = false;
            }

            } catch (Exception $e) {
               echo 'Caught exception: ',  $e->getMessage(), "\n";
          }              
          if($result){
           
            setcookie( "userlogin", $result['id'], time() + (86400 * 30), "/" ); 
            header("location: home");

          }else{
          	header("location: login?auth=1");
          }         

    }


     public function addNewAdmin(){

            $namesArray = explode(" ", $this->input->post("fullname")); 

            $storename = $this->input->post("storename");

            $email = $this->input->post("email");

            //check if the login exists
            $this->load->model('Login','login');

            $array = array('username' => $email); 

            $qcd = $this->login->login_check($array); 

            if ($qcd->num_rows()>0) {            

              print('<script>alert("The user is already registered in the system!");</script>');

            }else{

            $pass = $this->input->post("pass");

            $telephone = $this->input->post("telephone");        

            $splitFilename = explode(".", $_FILES['avatar-2']['name']); 

            $filename = $splitFilename[0]."_".$this->input->post("fullname").".".$splitFilename[1]; 

            $filename = 'assets/uploads/profile/'.$filename;                

                if (!is_uploaded_file($_FILES['avatar-2']['tmp_name']) or 

                    !copy($_FILES['avatar-2']['tmp_name'], $filename)) 

                { 

                  $error = "Could not  save file as $filename!"; 

                  var_dump($error);

                  exit(); 

                }

         $array = array(
                    'firstname' => $namesArray[0] ,
                    'secondname' => $namesArray[1] ,
                    'email' =>  $email,
                    'img' => $filename
                );        

            $insertedid = $this->users->addNew($array);

                 $arrayUsers = array(
                    'username' =>  $email ,
                    'pass' => md5($pass),
                    'personid'=> $insertedid,
                    'type'=>'1'
                ); 

            $insertedid = $this->users->addNewUser($arrayUsers);

            //send an email  

              require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");      

              $this->load->model('Order','order');

              $list = $this->order->fetchsmtp();

              $smtparray = $list->row_array();

              $cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']); 

              $toEmail = $email;

              $toName = $this->input->post("fullname");

              $subject = "Admin user Registration";

              $message = "You have successfully registered as an admin user,click the link below to confirm your registration. \n";

              $message .= "http://www.tibamoja.co.ke/activate?id=".$insertedid;

              $headers = "";

              $title = "Admin user Registration";

              $fromEmail = $smtparray['defaultemail'];            

              $fromName = "tibamoja";

              $key = null;

             $response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key); 

             $response = $cls -> getMails($smtparray['defaultemail'], $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key); 
             print('<script>alert("A confirmation message has been sent to your email address.");</script>');
             }

             $page = 'login';           
             $this->load->view('backend/'.$page, $data);       

                    

    }


    public function checkAdmin(){

        $array = array();

        $email = $this->input->post("username"); 

        $password = $this->input->post("pass"); 

          try {          
            
            $array = array('users.username' => $email, 'users.pass' => md5($password) ,'users.type'=>1);
            
            $this->load->model('Login','login');  

            $qcd = $this->login->login_check($array); 
    
            if ($qcd->num_rows()>0) {
                $result = $qcd->row_array();
            } else {
                $result = false;
            }

            } catch (Exception $e) {
               echo 'Caught exception: ',  $e->getMessage(), "\n";
          }              
          if($result){
           
            setcookie( "userlogin", $result['id'], time() + (86400 * 30), "/" );
            
            header("location: admin");

          }else{
            header("location: alogin?auth=1");
          }         

    }



 
}