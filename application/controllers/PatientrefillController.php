<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class PatientrefillController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patientrefill','patientrefill');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }


    public function fetchRefill(){

    	$id = $this->input->get("id");

        $list = $this->patientrefill->getPatientRefill($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $patientrefill) {
            $no++;
            $row = array();
            $row[] = $patientrefill->id;
            //$row[] = $no;
            $row[] = $patientrefill->storename;
            $row[] = $patientrefill->genericname."...";
            $row[] = $patientrefill->startdate;  
            $row[] = $patientrefill->enddate; 
            $row[] = $patientrefill->description; 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->patientrefill->count_all(),
                        "recordsFiltered" => $this->patientrefill->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);

    }

    public function fetchformRefill(){
        $postArr = explode('_',$this->input->post("id"));
        $list = $this->patientrefill->fetchRefill($postArr[0],$postArr[1]);
        echo json_encode ($list);

    }


 
}