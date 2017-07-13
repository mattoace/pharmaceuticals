<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class PatientpaymentController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patientpayment','patientpayment');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function fetchpatientpayment(){

        $id = $this->input->get("id");

        $list = $this->patientpayment->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $records) {
            $no++;
            $row = array();
            $row[] = $records->id;          
            $row[] = $records->billid;
            $row[] = $records->paymentdate;
            $row[] = $records->amount;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->patientpayment->count_all(),
                        "recordsFiltered" => $this->patientpayment->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);

    }
 


    public function addNew(){         
            

           $array = array(                   
                    'billid' => $this->input->post("billid") ,
                    'paymentdate' => $this->input->post("paymentdate"),
                    'amount' => $this->input->post("amount"),
                    'patientid' => $this->input->post("patientid")
                );          

            $newid = $this->patientpayment->addNew($array,$this->input->post("id") );

            echo json_encode(array("id"=>$newid));

    }


    public function fetchForm(){

        $list = $this->patientpayment->fetchedit($this->input->post("id"));
        
        echo json_encode ($list->row_array());

    }

     public function deleteRecord(){
        $qcd = $this->patientpayment->deleteRecord($this->input->post("id"));
   }

   public function fetchTotals(){

        $list = $this->patientpayment->fetchtotals($this->input->post("id"));
        
        echo json_encode ($list->row_array());


   }
 
}