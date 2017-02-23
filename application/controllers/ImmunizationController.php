<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ImmunizationController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Immunization','immunization');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function fetchimmunization(){

        $id = $this->input->get("id");

        $list = $this->immunization->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $records) {
            $no++;
            $row = array();
            $row[] = $records->id;          
            $row[] = $records->immunization;
            $row[] = $records->immundate;
            $row[] = $records->clinicattended;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->immunization->count_all(),
                        "recordsFiltered" => $this->immunization->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);

    }
 


    public function addNew(){         
            

           $array = array(                   
                    'immunization' => $this->input->post("immunization") ,
                    'immundate' => $this->input->post("immundate"),
                    'clinicattended' => $this->input->post("clinicattended"),
                    'patientid' => $this->input->post("patientid")
                );          

            $newid = $this->immunization->addNew($array,$this->input->post("id") );

            echo json_encode(array("id"=>$newid));

    }


    public function fetchForm(){

        $list = $this->immunization->fetchedit($this->input->post("id"));
        
        echo json_encode ($list->row_array());

    }

     public function deleteRecord(){
        $qcd = $this->immunization->deleteRecord($this->input->post("id"));
   }
 
}