<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class PatientbillController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patientbill','patientbill');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function fetchpatientbill(){

        $id = $this->input->get("id");

        $list = $this->patientbill->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $records) {
            $no++;
            $row = array();
            $row[] = $records->id;          
            $row[] = $records->orderid;
            $row[] = $records->billingdate;
            $row[] = $records->amount;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->patientbill->count_all(),
                        "recordsFiltered" => $this->patientbill->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);

    }
 


    public function addNew(){         
            

           $array = array(                   
                    'orderid' => $this->input->post("orderid") ,
                    'billingdate' => $this->input->post("billingdate"),
                    'amount' => $this->input->post("amount"),
                    'patientid' => $this->input->post("patientid")
                );          

            $newid = $this->patientbill->addNew($array,$this->input->post("id") );

            echo json_encode(array("id"=>$newid));

    }


    public function fetchForm(){

        $list = $this->patientbill->fetchedit($this->input->post("id"));
        
        echo json_encode ($list->row_array());

    }

     public function deleteRecord(){
        $qcd = $this->patientbill->deleteRecord($this->input->post("id"));
   }

   public function fetchTotals(){

        $list = $this->patientbill->fetchtotals($this->input->post("id"));
        
        echo json_encode ($list->row_array());


   }
 
}