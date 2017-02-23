<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class PatientinsuranceController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patientinsurance','insurance');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function fetchInsurance(){

        $id = $this->input->get("id");

        $list = $this->insurance->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $records) {
            $no++;
            $row = array();
            $row[] = $records->id;          
            $row[] = $records->inscompanyname;
            $row[] = $records->phone;
            $row[] = $records->address;  
            $row[] = $records->memberno;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->insurance->count_all(),
                        "recordsFiltered" => $this->insurance->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);

    }
 


    public function addNew(){         
            

           $array = array(                   
                    'inscompanyname' => $this->input->post("inscompanyname") ,
                    'phone' => $this->input->post("phone"),
                    'address' => $this->input->post("address"),
                    'memberno' => $this->input->post("memberno"),
                    'patientid' => $this->input->post("patientid")
                );          

            $newid = $this->insurance->addNew($array,$this->input->post("id") );

            echo json_encode(array("id"=>$newid));

    }


    public function fetchForm(){

        $list = $this->insurance->fetchedit($this->input->post("id"));
        
        echo json_encode ($list->row_array());

    }

     public function deleteRecord(){
        $qcd = $this->insurance->deleteRecord($this->input->post("id"));
   }
 
}