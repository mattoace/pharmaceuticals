<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class UsersController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users','users');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 
    public function fetch()
    {
        $list = $this->users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
            $no++;
            $row = array();
            $row[] = $users->id;
            $row[] = $no;
            $row[] = $users->firstname;
            $row[] = $users->secondname;
            $row[] = $users->email;
            $row[] = $users->username;
            $row[] = $users->phone; 
            $row[] = $users->type;
            $row[] = $users->isactive;
            $row[] = $users->img;              
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->users->count_all(),
                        "recordsFiltered" => $this->users->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function addNew(){  
         
            $namesArray = explode(" ", $this->input->post("fullnames")); 

                 $array = array(
                    'firstname' => $namesArray[0] ,
                    'secondname' => $namesArray[1] ,
                    'email' => $this->input->post("username"),
                    'phone' => $this->input->post("phone")
                );        

            $insertedid = $this->users->addNew($array);

                 $arrayUsers = array(
                    'username' => $this->input->post("username"),
                    'pass' => md5($this->input->post("pass")),
                    'personid'=> $insertedid
                ); 

            $insertedid = $this->users->addNewUser($arrayUsers);

        echo json_encode(array("response"=>$insertedid));

    }

    public function fetchedit(){
        $list = $this->users->fetchRecord($this->input->post("id") );
        echo json_encode (array("response"=>$list));
    }

    public function edit(){

        $namesArray = explode(" ", $this->input->post("fullnames")); 

             $array = array(
                'firstname' => $namesArray[0] ,
                'secondname' => $namesArray[1] ,
                'email' => $this->input->post("username"),
                'phone' => $this->input->post("phone")
            ); 

        $this->load->model('Patient','persons');         

        $this->persons->saveRecord($array,$this->input->post("id"));

        $isadmin = ($this->input->post("isadmin") == 'true' ? 1: 0);
        $isactive = ($this->input->post("isactive") == 'true' ? 1: 0);

        $arrayUsers = array(
                'username' => $this->input->post("username") ,
                'pass' => md5($this->input->post("pass")),
                'type' => $isadmin,
                'isactive' => $isactive
            ); 
        $this->users->savePersonRecord($arrayUsers,$this->input->post("id"));

    } 

 public function deleteRecord(){
        $qcd = $this->users->deleteRecord($this->input->post("id"));
 }

  public function imgupload(){ 

        $upload_handler = new ClinicImgUploadHandler();

   }

 
}




