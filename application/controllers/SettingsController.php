<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class SettingsController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings','settings');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 
    public function fetch()
    {
        $list = $this->settings->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $settings) {
            $no++;
            $row = array();
            $row[] = $settings->id;
            $row[] = $no;
            $row[] = $settings->host;
            $row[] = $settings->port;
            $row[] = $settings->username;
            $row[] = $settings->pass;
            $row[] = $settings->defaultemail; 
            $row[] = $settings->default;                    
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->settings->count_all(),
                        "recordsFiltered" => $this->settings->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function addNew(){           
       

                 $array = array(
                    'host' => $this->input->post("host"),
                    'port' => $this->input->post("port") ,
                    'username' => $this->input->post("username"),
                    'pass' => $this->input->post("pass"),
                    'defaultemail' => $this->input->post("defaultemail"),
                    'default' => $this->input->post("def")
                );        

            $insertedid = $this->settings->addNew($array);

        echo json_encode(array("response"=>$insertedid));

    }

    public function fetchedit(){
        $list = $this->settings->fetchRecord($this->input->post("id"));
        echo json_encode (array("response"=>$list));
    }

    public function edit(){  

             $isdefault = ($this->input->post("def") == 'true' ? 1: 0);   

             $array = array(
                'host' =>  $this->input->post("host"),
                'port' => $this->input->post("port"),
                'username' => $this->input->post("username"),
                'pass' => $this->input->post("pass"),
                'defaultemail' => $this->input->post("defaultemail"),
                'default' => $isdefault
            ); 
     
         $response =  $this->settings->saveRecord($array,$this->input->post("id"));

         echo json_encode (array("response"=>$response));

    } 

 public function deleteRecord(){
        $qcd = $this->settings->deleteRecord($this->input->post("id"));
 }

  public function imgupload(){ 

        $upload_handler = new ClinicImgUploadHandler();

   }

 
}




