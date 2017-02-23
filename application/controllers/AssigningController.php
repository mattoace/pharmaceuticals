<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class AssigningController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
    public function fetchNew()
    { 
        $this->load->model('Assigning','assigning'); 
        $list = $this->assigning->getDeAssigned($this->input->get("id"),$this->input->get("sid"));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $assigning) {
            $no++;
            $row = array();
            $row[] = $assigning->id;           
            $row[] = $assigning->genericname; 
            $row[] = $assigning->tax; 
            $row[] = $assigning->drugprice;       
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->assigning->count_all_de($this->input->get("id"),$this->input->get("sid")),
                        "recordsFiltered" => $this->assigning->count_filtered_de($this->input->get("id"),$this->input->get("sid")),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }



 public function fetch()
    {
        
        $this->load->model('Drug','drugs');
        $list = $this->drugs->get_datatables_client();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $drugs) {
            $no++;
            $row = array();
            $row[] = $drugs->id;            
            $row[] = $drugs->genericname; 
            $row[] = $drugs->tax; 
            $row[] = $drugs->drugprice;       
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->drugs->count_all(),
                        "recordsFiltered" => $this->drugs->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function fetchassigned(){

        $this->load->model('Assigning','assigning');         

        $list = $this->assigning->getAssigned($this->input->get("id"),$this->input->get("sid"));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $assigning) {
            $no++;
            $row = array();
            $row[] = $assigning->id;        
            $row[] = $assigning->genericname; 
            $row[] = $assigning->tax; 
            $row[] = $assigning->drugprice;       
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->assigning->count_all($this->input->get("id"),$this->input->get("sid")),
                        "recordsFiltered" => $this->assigning->count_filtered($this->input->get("id"),$this->input->get("sid")),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

    }

    public function assignCat(){

        $this->load->model('Assigning','assigning');

        $storeid = $this->input->post("storeid");
        $drugids = $this->input->post("drugids");
        $category = $this->input->post("category");

        foreach ($drugids as $key => $value) {

           $clearresponse = $this->assigning->clearcategory($value,$category,$storeid);

           $arrayCategories = array(
                    'drugid' => $value,
                    'categoryid'  => $category,
                    'storeid' => $storeid
                ); 

            $this->assigning->addNewCategory($arrayCategories); 

           $response  =  $value;
        }

      
    echo json_encode(array("response"=>$response));
    }

  public function deassignCat(){

        $this->load->model('Assigning','assigning');

        $storeid = $this->input->post("storeid");
        $drugids = $this->input->post("drugids");
        $category = $this->input->post("category");

        foreach ($drugids as $key => $value) {

           $clearresponse = $this->assigning->clearcategory($value,$category,$storeid);

           $arrayCategories = array(
                    'drugid' => $value,
                    'categoryid'  => $category,
                    'storeid' => $storeid
                );           
           $response  =  $value;
        }

      
    echo json_encode(array("response"=>$response));
    }



 
}