<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class RolesController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Roles','roles');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 

    public function fetch(){  
         
       $treeData = [];
       $j = 0;
       foreach ($this->roles->getMain() as $mainmenu) {
          $nodesChildren = [];
          $i=0;
                   foreach ($this->roles->getSubMenus($mainmenu->id) as $submenu) {

                    $nodesChildren[] = ['id'=>"sub_".$i."_".$submenu->id, 'text'=>$submenu->menuname,  'children'=>['id'=>"ch1_".$submenu->id, 'text'=>$submenu->menuname], 'state'=>['opened'=>true]];
                    $i++; 

                   }

           $treeData[$j] = array('id'=>"main_".$mainmenu->id, 'text'=>$mainmenu->menuname, 'children'=>$nodesChildren, 'state'=>['opened'=>true]);
         $j++;
       }
      echo json_encode(['id'=>0, 'text'=>'Modules', 'children'=>$treeData, 'state'=>['opened'=>true]]);
    }

     public function save(){  
       $userid =  $this->input->post("user_id");
       $checked = $this->input->post("checked");

       $this->roles->clearRoles($userid);

       foreach ($checked as $key => $moduleId) {

           $array = array(
                    'userid' => $userid ,
                    'moduleid' => $moduleId
                );          

            $response = $this->roles->addNew($array);

       }
       echo json_encode($response);

     }


     public function reload(){

          $userid =  $this->input->post("id");

         foreach ($this->roles->getSavedRoles($userid) as $savedroles) {

           $modules[] = $savedroles->moduleid;

         }

      echo json_encode($modules);

     }

  public function pharmfetch()
    {
        $this->load->model('Pharmacy','pharmacy');
        $list = $this->pharmacy->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pharmacy) {
            $no++;
            $row = array();
            $row[] = $pharmacy->id;         
            $row[] = $pharmacy->storename;  
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->pharmacy->count_all(),
                        "recordsFiltered" => $this->pharmacy->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function assignpharm(){


          $this->load->model('Roles','roles');

                $userid = $this->input->post("userid");

                $pharmacyids = $this->input->post("pharmacyids");

                $clearresponse = $this->roles->clearpharmacyassigned($userid);

                foreach ($pharmacyids as $key => $value) {

                   

                   $arrayPharm = array(
                            'pharmacyid' => $value,
                            'userid'  => $userid
                        ); 

                    $this->roles->assignPharmacy($arrayPharm); 

                   $response  =  $value;
                }
              
            echo json_encode(array("response"=>$response));


    }


    public function pharmfetchassigned(){
   
        $list = $this->roles->get_datatables($this->input->get("id"));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $roles) {
            $no++;
            $row = array();
            $row[] = $roles->id;         
            $row[] = $roles->storename;  
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->roles->count_all(),
                        "recordsFiltered" => $this->roles->count_filtered(),
                        "data" => $data,
                );

        echo json_encode($output);

    }

    public function pharmdeassigned(){

         $userid = $this->input->post("userid");

         $pharmacyids = $this->input->post("pharmacyids");

          foreach ($pharmacyids as $key => $value) {

            $clearresponse = $this->roles->clearpharmacydeassigned($value,$userid);

          }
    echo json_encode(array("response"=>$response));

    }


  

 
}

