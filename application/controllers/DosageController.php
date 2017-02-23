<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DosageController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dose','dose');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 


    public function addNew(){         
            

                 $array = array(
                    'dosename' => $this->input->post("dosename") ,
                    'minimumdose' => $this->input->post("minimumdose"),
                    'maximumdose' => $this->input->post("maximumdose"),
                    'dose' => $this->input->post("dose"),
                    'drugid' => $this->input->post("drugid")
                );          

            $qcd = $this->dose->addNew($array);

    }


    public function fetchForm(){

        $list = $this->dose->fetchedit($this->input->post("selId"));
        
        echo json_encode ($list->row_array());

    }
 
}