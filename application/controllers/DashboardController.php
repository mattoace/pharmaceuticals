<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DashboardController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard','dashboard');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function drawAreaGrapgh(){

     $list = $this->dashboard->fetchSalesGrapgh();   

      foreach ($list as $records) {

      	    $stores[] = $records->storename;

      	    $stores = array_unique($stores);

            $data[] = array("y"=>$records->refilldate,"item1"=>0,"item2"=>$records->cnt,"stores"=>implode(',<br>',$stores));  //   {y: '2011 Q1', item1: 0, item2: 2666},

          }

       echo json_encode($data);

    }

    public function drawlineGrapgh(){

     $list = $this->dashboard->fetchSalesGrapgh();   

      foreach ($list as $records) {

      	    $stores[] = $records->storename;

      	    $stores = array_unique($stores);

            $data[] = array("y"=>$records->refilldate,"item1"=>0,"item2"=>$records->cnt,"stores"=>implode(',<br>',$stores));  //   {y: '2011 Q1', item1: 0, item2: 2666},

          }

       echo json_encode($data);

    }

    public function sendEmail(){




 require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");

			$this->load->model('Order','order');

			$listsmtp = $this->order->fetchsmtp();

			$smtparray = $listsmtp->row_array();

			$cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']);

			$toEmail = $this->input->post("to");

			$toName =  $this->input->post("to");

			$subject = $this->input->post("subject");

			$message = $this->input->post("body");

			$headers = "'X-Mailer', 'All rights reserved Core Ict Consultancy'";

			$title = $this->input->post("subject");

			$fromEmail = $smtparray['defaultemail'];

			$fromName = "Pharm-Portal";

			$key = null;    

			$response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key);   

             echo json_encode(array("response"=>$response));
			

    }



 
}