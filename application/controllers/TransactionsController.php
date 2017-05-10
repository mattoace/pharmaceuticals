<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class TransactionsController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transactions','transactions');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }


public function order(){
   //$user = $this->input->post("user");
   $user = $_COOKIE['userlogin']; 
   $selString = $this->input->post("sel"); 

   $date1 = new DateTime($this->input->post("startdate"));
   $startdate = $date1->format('Y-m-d H:i:s'); 

   $date2 = new DateTime($this->input->post("enddate"));
   $enddate = $date2->format('Y-m-d H:i:s'); 

   $response = $this->transactions->createTransaction($user,$selString,$startdate,$enddate); 
   
   echo json_decode(array("response"=>$response));
 }
 


public function fetchtransaction(){

       $user = $_COOKIE['userlogin'];

       $selString = $this->input->get("id");

        $list = $this->transactions->get_pTransactions($user,$selString);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transactions) {
            $no++;
            $row = array();
            $row[] = $transactions->id;
            $row[] = $no;
            $row[] = $transactions->drugprice;
            $row[] = $transactions->genericname; 
            $row[] = $transactions->transactiondate; 
            $row[] = $transactions->description;      
            $row[] = $transactions->comments;        
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->transactions->count_all(),
                        "recordsFiltered" => $this->transactions->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

}

public function searchtransaction(){

        $list = $this->transactions->get_sTransactions();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transactions) {
            $no++;
            $row = array();
            $row[] = $transactions->id;        
            $row[] = $transactions->genericname;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->transactions->count_all(),
                        "recordsFiltered" => $this->transactions->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

}

public function drugDetails(){

    $drugid = $this->input->post("id");

    $result = $this->transactions->getDrugDetails($drugid);

    $response ='<div class="team-img">';                                             
    $response .='<div class="ih-item circle effect1"><a href="#">';
    $response .='<div class="spinner"><img style="width:140px;height:140px;" src=../'.$result[0]->img.' alt="" class=""></div>';                                               
    $response .='<div class="info">';
    $response .='<div class="info-back">';
    $response .='</div>';
    $response .='</div></a></div>'; 

    $dosedetails  = '<b>Dose name : </b>' .$result[0]->dosename .'<br>';
    $dosedetails .= '<b>Dose  : </b>' .$result[0]->dose.'<br>';
    $dosedetails .= '<b>Minimum dose : </b>' .$result[0]->minimumdose .'<br>' ;
    $dosedetails .= '<b>Maximum dose : </b>' .$result[0]->maximumdose .'<br>' ;  

    $response .='<h4> '.$result[0]->genericname.' </h4>';
    $response .='<p><b>KES '.$result[0]->drugprice.' /= </b></p>';    

    foreach ($this->transactions->getDrugAvailability($drugid) as $transactions) {
    $no++;   

    $response .='<a href="#" class="list-group-item"><span style="font-size:8px;" id="'.$transactions->id.'_'.$transactions->store.'" class="badge badge-danger" onClick = "orderDrug(this)">Kes '.$transactions->drugprice.' /= | Add</span> <i class="ti ti-bell"></i> <span style="font-size:12px;"><b>'.$transactions->storename.'</b></span></a>';
          
        }

    $response .='</div>';


    echo json_encode(array("response"=>$response,"dosedetails"=>$dosedetails));
}



public function drugSearch(){

    $categorysearch = $this->input->post("categorysearch");
    $productname = $this->input->post("productname");
    $amount = $this->input->post("amount");

   $cnt = 0;
    foreach ($this->transactions->searchDrugDetails($arrayParameters) as $result) {

 if($cnt <= 3){
       $response  .='<div class="team-img" style="width:30%;float:left;padding: 0; margin-bottom: 1%;  margin-left: 2%;">';
       $cnt = -1;
    }else{
         $response  .='<div class="team-img" style="width:30%;padding: 0; margin-bottom: 1%;  margin-left: 2%;">';   
    }

   

    $response .='<div class="ih-item circle effect1"><a href="#">';
    $response .='<div class="spinner"><img style="width:140px;height:140px;" src=../'.$result->img.' alt="" class=""></div>';                                               
    $response .='<div class="info">';
    $response .='<div class="info-back">';
    $response .='</div>';
    $response .='</div></a></div>'; 

    $dosedetails  = '<b>Dose name : </b>' .$result->dosename .'<br>';
    $dosedetails .= '<b>Dose  : </b>' .$result->dose.'<br>';
    $dosedetails .= '<b>Minimum dose : </b>' .$result->minimumdose .'<br>' ;
    $dosedetails .= '<b>Maximum dose : </b>' .$result->maximumdose .'<br>' ;  

    $response .='<h4 style="font-size: 10px;"> '.$result->genericname.' </h4>';
    $response .='<p style="font-size: 8px;"><b>KES '.$result->drugprice.' /= </b></p>';    

  /*  foreach ($this->transactions->getDrugAvailability($drugid) as $transactions) {
    $no++;   

    $response .='<a href="#" class="list-group-item"><span style="font-size:8px;" id="'.$transactions->id.'_'.$transactions->store.'" class="badge badge-danger" onClick = "orderDrug(this)">Kes '.$transactions->drugprice.' /= | Add</span> <i class="ti ti-bell"></i> <span style="font-size:12px;"><b>'.$transactions->storename.'</b></span></a>';
          
        }*/

    $response .='</div>';

   
    $cnt++;
   }


    echo json_encode(array("response"=>$response,"dosedetails"=>$dosedetails));
   }


   public function pharmSearch(){

    $response = "
        <style>
        .team-img {
            background: #fff none repeat scroll 0 0;
            border-top: 2px solid transparent;
            box-shadow: 0 0 8px 0 #d4d4d4;
            height: 400px;
            padding: 20px;
            width: 350px !important;
            margin-left: 0.3% !important;         
        }
        .ih-item.circle {
    width: auto;
   }
   .ih-item.circle.effect1 .spinner { 
    height: auto;
    width: auto;
}




@media only screen and (max-device-width: 480px) {
         .explore-left.wow.zoomIn.animated.nbs-flexisel-ul {
            left: 2px !important;
        }
    }



</style>
<script>
</script>
    ";

   $cnt = 0;
    foreach ($this->transactions->searchPharmacyDetails($arrayParameters) as $result) {
       /*  if($cnt <= 3){
               $response  .='<div class="team-img" style="width:30%;float:left;padding: 0; margin-bottom: 1%;  margin-left: 2%;">';
               $cnt = -1;
            }else{
                 $response  .='<div class="team-img" style="width:30%;padding: 0; margin-bottom: 1%;  margin-left: 2%;">';   
            }    
       */



    $response  .='<div class="team-img" style="width:30%;float:left;padding: 0; margin-bottom: 1%;  margin-left: 2%;">'; 
    $response .='<div class="ih-item circle effect1"><a href="javascript:void()" onclick=loadMap('.$result->latitude.','.$result->longitude.') >';
    $response .='<div class="spinner"><img style="width:100%;height:250px;" src='.$result->img.' alt="" class=""></div>';                                               
    $response .='<div class="info">';
    $response .= '<b>Name : </b>' .$result->storename .'<br>';
    $response .= '<b>Location  : </b>' .$result->location.'<br>';
    $response .= '<b>Telephone : </b>' .$result->telephone .'<br>' ;
    $response .= '<b>Email : </b>' .$result->email .'<br>' ; 

    //$response .='<div class="info-back">';
    //$response .='</div>';
    $response .='</div></a></div>'; 
    $response .='</div>';

 

   
    $cnt++;
   }


    echo json_encode(array("response"=>$response,"dosedetails"=>$dosedetails));
   }



    public function scanDrug(){

      $drugid = $this->input->post("id");

      $result = $this->transactions->getDrugScannedDetails($drugid);

      $response ='<div class="row">';

        foreach ($result as $list) {
        
            $response .=' <div class="col-md-3 text-center">';
            $response .='<img src='.$list->img.' width="150px" height="150px">';
            $response .='<br>';
            $response .= $list->genericname.' <strong>'.$list->drugprice.'</strong>';
            $response .='<br>';
            $response .='<button class="btn btn-danger my-cart-btn" data-id="'.$list->id.'" data-name="'.$list->genericname.'" data-summary="'.$list->genericname.'" data-price="'.$list->drugprice.'" data-quantity="1" data-image="'.$list->img.'">Add to Cart</button>';
            $response .='<a href="#" class="btn btn-info">Details</a>';
            $response .='</div>';       

            }
          $response .='</div>';
          echo json_encode(array("response"=>$response));

    }


 
}
