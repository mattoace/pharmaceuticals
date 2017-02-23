<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class CatController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cat','cat');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 
    public function fetch()
    {
        $list = $this->cat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cat) {
            $no++;
            $row = array();
            $row[] = $cat->id;
            $row[] = $no;
            $row[] = $cat->categoryname;
            $row[] = $cat->description;         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cat->count_all(),
                        "recordsFiltered" => $this->cat->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function addNew(){  
         

                 $array = array(
                    'categoryname' => $this->input->post("categoryname") ,
                    'description' => $this->input->post("description")
                );          

            $qcd = $this->cat->addNew($array);

    }

    public function fetchedit(){
        $list = $this->cat->fetchedit($this->input->post("id") );
        echo json_encode ($list->row_array());
    }

    public function edit(){

                 $array = array(
                    'categoryname' => $this->input->post("categoryname") ,
                    'description' => $this->input->post("description")
                );          

            $qcd = $this->cat->saveRecord($array,$this->input->post("id"));

    } 

 public function deleteRecord(){
        $qcd = $this->cat->deleteRecord($this->input->post("id"));
 }


 
}