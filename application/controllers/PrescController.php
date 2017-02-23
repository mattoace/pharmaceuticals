<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class PrescController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prescriptionupload','prescupload');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }

    public function fetch(){

        $id = $this->input->get("id");

        $list = $this->prescupload->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $records) {
            $no++;
            $row = array();
            $row[] = $records->id;          
            $row[] = $records->uploadate;
            $row[] = $records->filename;
            $row[] = $records->path;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->prescupload->count_all(),
                        "recordsFiltered" => $this->prescupload->count_filtered(),
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


    public function fetchComments(){

        $list = $this->prescupload->fetchedit($this->input->post("id"));
        
        echo json_encode ($list->row_array());

    }

     public function deleteRecord(){
        $qcd = $this->immunization->deleteRecord($this->input->post("id"));
   }

     public function saveComments(){

                 $array = array(
                    'doctorscomments' => $this->input->post("doctorscomments")
                );          

            $qcd = $this->prescupload->saveRecord($array,$this->input->post("id"));

            echo json_encode(array("response"=>$qcd));

    } 

    public function orderMedication(){

        $selIds = $this->input->post("selectedOrders");

        $storeId = $this->input->post("storeid");

        $patientid = $this->input->post("patientid");

        $this->load->model('Users','user');

        $list = $this->user->fetchUid($patientid);

        $patientid = $list[0]->id; 

        //get user equivalent

        $this->load->model('Transactions','transactions');

        foreach ($selIds as $key => $drugID) {
            $qty = 1;          
            $response = $this->transactions->createPendingTransactionExpress($patientid,$drugID,$qty,$coupon,null,null); // create a new pending Order  
        }  

       echo json_encode(array("response"=>$resonse));

    }

    public function loadOrdered(){


        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                 $patientid = $this->input->get("id");
                 $list = $this->prescupload->fetchOrderedRefill($patientid); 
                 $result = array();
                   foreach ($list as $records) {
                       array_push($result,$records);

                   }

            break;

            case "POST":
                $result = $clients->insert(array(
                    "name" => $_POST["name"],
                    "age" => intval($_POST["age"]),
                    "address" => $_POST["address"],
                    "married" => $_POST["married"] === "true" ? 1 : 0,
                    "country_id" => intval($_POST["country_id"])
                ));
                break;

            case "PUT":
                parse_str(file_get_contents("php://input"), $_PUT);

              $array = array(
                    'qty' => $_PUT["qty"]
                );          

             $result = $this->prescupload->saveRecordPatientOrderQty($array,$_PUT["id"]);

              
            break;

            case "DELETE":
                parse_str(file_get_contents("php://input"), $_DELETE);

                $result = $clients->remove(intval($_DELETE["id"]));
                break;
        }


        header("Content-Type: application/json");

        echo json_encode($result);

    }


    function confirmOrdered(){

       $patientid = $this->input->post("patientid");

       $list = $this->prescupload->fetchOrderedRefill($patientid);

       //$patientid = $list[0]->user;     

       require_once("OrderController.php");

       

       $newOrder = new OrderController();

       $items = array();

      
                 
       foreach ($list as $records) {
           array_push($items,$records->id);

       }                  

        $response = $newOrder->confirmOrder(true,1,$patientid,$items);       

        $code = $response; 
      
        require_once("InvoiceController.php");  

        $newInvoice = new InvoiceController();

        $response = $newInvoice->createInvoice(true,1,$patientid,$code,$items); 

        echo json_encode(array("response"=>$resonse));
    }
 
}