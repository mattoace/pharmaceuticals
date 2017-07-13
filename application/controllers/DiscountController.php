<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DiscountController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Discount','discount');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function addNew(){  

                 $array = array(
                    'qty' => $this->input->post("qty") ,
                    'amount' => $this->input->post("amount"),             
                    'drugid' => $this->input->post("drugid")
                );          

            $qcd = $this->discount->addNew($array);

    }


    public function fetchForm(){

        $list = $this->discount->fetchedit($this->input->post("selId"));
        
        echo json_encode ($list->row_array());

    }

    public function fetchgrid(){

        $id = $this->input->get("id");

        $list = $this->discount->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $records) {
            $no++;
            $row = array();
            $row[] = $records->id;          
            $row[] = $records->code;
            $row[] = $records->amount;
            $row[] = $records->status;            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->discount->count_all(),
                        "recordsFiltered" => $this->discount->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);

    }

    public function generateCoupons(){

         require_once("Coupon.php");

         $couponumber = $this->input->post("couponumber");

         $couponamount = $this->input->post("couponamount");

         $drugid = $this->input->post("drugid");

         $coupon = new Coupon();

         $myArray = array("length"=>6,"prefix"=>"PHARM-");

         //$this->discount->clearCoupon($drugid);

         for ($i=0; $i <  $couponumber ; $i++) { 

           $code =   $coupon->generate($myArray);         

                    $array = array(
                    'code' => $code ,
                    'amount' => $couponamount,
                    'status' => "Open",              
                    'drugid' => $drugid
                );          

               $this->discount->addNewCoupon($array);

         }    



    }

    function clearCoupons(){

       $drugid = $this->input->post("drugid");

       $this->discount->clearCoupon($drugid);


    }
 
}