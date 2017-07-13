<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class CartController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions','transactions');
        $this->load->helper('url');
       
    }
 
    public function index()
    {
     
        
        
    }
 


    public function processOrder(){ 

      $items = $this->input->post("items"); 

      $userid = $this->input->post("user");

      $coupon = $this->input->post("coupon");
              

      $response = $this->transactions->createPendingTransactionWebInterface($userid,$items,$coupon,null,null); 

      if($response){
        //process the order
         require('OrderController.php');

         $order = new OrderController();
         
         $response = $order->orderRequest($userid);

         echo json_encode(array("response"=>$response));  

      }

           

    }
 
 
}