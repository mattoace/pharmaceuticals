<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class PatientController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patient','persons');
    }
 
    public function index()
    {
        $this->load->helper('url');
        //$this->load->view('customers_view');
    }
 
    public function fetch()
    {
        $list = $this->persons->get_datatables($this->input->get("personType"));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $persons) {
            $no++;
            $row = array();
            $row[] = $persons->id;
            $row[] = $no;
            $row[] = $persons->firstname;
            $row[] = $persons->secondname;
            $row[] = $persons->phone;
            $row[] = $persons->address;
            $row[] = $persons->town;
            $row[] = $persons->img;          
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->persons->count_all(),
                        "recordsFiltered" => $this->persons->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function addNew(){  

                $date1 = new DateTime($this->input->post("dob"));
                $dob = $date1->format('Y-m-d H:i:s');          

                 $array = array('initial' => $this->input->post("initial") ,
                    'firstname' => $this->input->post("firstname"),
                    'secondname' => $this->input->post("secondname"),
                    'surname' => $this->input->post("surname"),
                    'dob' => $dob,
                    'gender' => $this->input->post("gender"),
                    'nationalid' => $this->input->post("nationalid"),
                    'address' => $this->input->post("address"),
                    'type' => 1,
                    'phone' => $this->input->post("phone"),
                    'town' => $this->input->post("town"),
                    'type'=>$this->input->post("type")

                );          

            $qcd = $this->persons->addNew($array);

    }

    public function fetchedit(){
        $list = $this->persons->fetchedit($this->input->post("id") );
        echo json_encode ($list->row_array());
    }

    public function edit(){

                $date1 = new DateTime($this->input->post("dob"));
                $dob = $date1->format('Y-m-d H:i:s');          

                 $array = array(
                    'initial' => $this->input->post("initial") ,
                    'firstname' => $this->input->post("firstname"),
                    'secondname' => $this->input->post("secondname"),
                    'surname' => $this->input->post("surname"),
                    'dob' => $dob,
                    'gender' => $this->input->post("gender"),
                    'nationalid' => $this->input->post("nationalid"),
                    'address' => $this->input->post("address"),
                    'type' => 1,
                    'phone' => $this->input->post("phone"),
                    'town' => $this->input->post("town"),
                    'type' => $this->input->post("type")

                );          

            $qcd = $this->persons->saveRecord($array,$this->input->post("id"));

    } 

 public function deleteRecord(){
        $qcd = $this->persons->deleteRecord($this->input->post("id"));
 }

 public function uploadPicture(){

      $this->load->library('upload');

      $this->load->helper(array('form', 'url'));

        // A list of permitted file extensions
      $allowed = array('png', 'jpg', 'gif','zip');

        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
                echo '{"status":"error1"}';
                exit;
            }

            $splitFilename = explode(".", $_FILES['upl']['name']);

            $filename = $splitFilename[0]."_".$this->input->post("selid").".".$splitFilename[1]; 

            $newpath = 'assets/uploads/'.$filename;

            if(move_uploaded_file($_FILES['upl']['tmp_name'], $newpath )){
             $array = array(
                    'img' => $newpath  
                    );

                $qcd = $this->persons->saveRecord($array,$this->input->post("selid"));
                echo '{"status":"success"}';
                exit;
            }
        }

        echo '{"status":"error2"}';
        exit;
 }
 
}