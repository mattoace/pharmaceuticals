<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Transactions extends CI_Model { 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    } 


    private function _get_datatables_query($id)
     {        
       

        $this->db->select('drugs.id,drugs.genericname,drugprices.drugprice,drugprices.tax');
        $this->db->from('drugs');
        $this->db->join('drugprices','drugprices.drugid = drugs.id');
        $this->db->where('drugprices.storeid',$id);

        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
           // $this->db->order_by('drugs.id');
        }


    }

 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }



    public function createTransaction($user,$selString,$startdate,$enddate){

     $postArr = explode("_", $selString);

    $query = $this->db->query('SELECT * FROM drugprices WHERE drugid = "'.$postArr[0].'" AND storeid = "'.$postArr[1].'" LIMIT 0,1'); 

    $drugStore = $query->result(); 
 
     $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $postArr[0] ,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "New Order",
                    'comments' => "Pending",
                    'startdate'=> $startdate,
                    'enddate' =>$enddate,
                    'qty' => 1,
                    'price' => $drugStore[0]->drugprice
                ); 

         $this->db->insert('patientrefill', $arrObject);

         $insertedid = $this->db->insert_id(); 


     $arrObjectT = array(
                    'patientid' => $user ,
                    'orderid' => $insertedid ,
                    'transactiondate' => date('Y-m-d H:i:s'),
                    'storeid' => $postArr[1] 
                ); 

         $this->db->insert('transactions', $arrObjectT); 

     return array("row"=>$this->db->insert_id());
    }

    public function createPendingTransaction($user,$drugid,$qty,$coupon,$startdate,$enddate){
       

           $query = $this->db->query('SELECT * FROM drugprices WHERE drugid = "'.$drugid.'" LIMIT 0,1'); 

           $drugStore = $query->result(); 

           //fetch the discount price on coupon
           $query = $this->db->query('SELECT amount FROM coupon WHERE  code = "'. trim($coupon).'" AND status="Open" LIMIT 0,1'); 

           $couponResultSet = $query->result(); 

           $couponamount = $couponResultSet[0]->amount;

           //$absoluteprice = $drugStore[0]->drugprice - $couponamount; 

           $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $drugid,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "New Order",
                    'comments' => "Pending",
                    'startdate'=> date('Y-m-d H:i:s'),
                    'enddate' =>date('Y-m-d H:i:s'),
                    'qty' => $qty,
                    'price' => $drugStore[0]->drugprice
                ); 

          $this->db->insert('patientrefill', $arrObject);

          $insertedid = $this->db->insert_id(); 

          $arrObjectT = array(
                    'patientid' => $user ,
                    'orderid' => $insertedid ,
                    'transactiondate' => date('Y-m-d H:i:s'),
                    'storeid' => $drugStore[0]->storeid
                ); 

         $this->db->insert('transactions', $arrObjectT);



         $arrObject = array(
                        'patientid' => $user ,
                        'drugid' => $drugid,
                        'refilldate' => date('Y-m-d H:i:s'),
                        'description' => "Coupon",
                        'comments' => "Pending",
                        'startdate'=> date('Y-m-d H:i:s'),
                        'enddate' =>date('Y-m-d H:i:s'),
                        'qty' => 1,
                        'price' => "-".$couponamount
                    );

          if($i == 0){
             if($couponamount){
              $this->db->insert('patientrefill', $arrObject);

              $insertedid = $this->db->insert_id(); 

              $arrObjectT = array(
                        'patientid' => $user ,
                        'orderid' => $insertedid ,
                        'transactiondate' => date('Y-m-d H:i:s'),
                        'storeid' => $drugStore[0]->storeid
                    ); 

              $this->db->insert('transactions', $arrObjectT);

              $this->db->query('UPDATE coupon SET status = "Closed"  WHERE  code = "'. trim($coupon).'"'); 

              } 
            }
         $i++;
          
         $response =  "Created pending transaction!"; 
       

        return $response;

    }



    public function createPendingTransactionWebInterface($user,$items,$coupon,$startdate,$enddate){
       
            $i = 0;

            foreach ($items as $key => $cartitems) {

                 $price = $cartitems['price'];

                 $qty =  $cartitems['quantity']; 

                 $drugid = $cartitems['id'];

                 //$coupon = $coupons[$i]; 

                 //fetch the discount price on coupon
                  $query = $this->db->query('SELECT amount FROM coupon WHERE  code = "'. trim($coupon).'" AND status="Open" LIMIT 0,1'); 

                  $couponResultSet = $query->result(); 

                  $couponamount = $couponResultSet[0]->amount;

                  //$absoluteprice = $price - $couponamount; 
          

           $query = $this->db->query('SELECT * FROM drugprices WHERE drugid = "'.$drugid.'" LIMIT 0,1'); 

           $drugStore = $query->result(); 

           $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $drugid,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "New Order",
                    'comments' => "Pending",
                    'startdate'=> date('Y-m-d H:i:s'),
                    'enddate' =>date('Y-m-d H:i:s'),
                    'qty' => $qty,
                    'price' => $price
                ); 

          $this->db->insert('patientrefill', $arrObject);


          $insertedid = $this->db->insert_id(); 

          $arrObjectT = array(
                    'patientid' => $user ,
                    'orderid' => $insertedid ,
                    'transactiondate' => date('Y-m-d H:i:s'),
                    'storeid' => $drugStore[0]->storeid
                ); 

         $this->db->insert('transactions', $arrObjectT);


         $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $drugid,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "Coupon",
                    'comments' => "Pending",
                    'startdate'=> date('Y-m-d H:i:s'),
                    'enddate' =>date('Y-m-d H:i:s'),
                    'qty' => 1,
                    'price' => "-".$couponamount
                );

      if($i == 0){
         if($couponamount){
          $this->db->insert('patientrefill', $arrObject);

          $insertedid = $this->db->insert_id(); 

          $arrObjectT = array(
                    'patientid' => $user ,
                    'orderid' => $insertedid ,
                    'transactiondate' => date('Y-m-d H:i:s'),
                    'storeid' => $drugStore[0]->storeid
                ); 

          $this->db->insert('transactions', $arrObjectT);
          $this->db->query('UPDATE coupon SET status = "Closed"  WHERE  code = "'. trim($coupon).'"'); 

          } 
        }
          
         $response =  "Created pending transaction!"; 

        
       
        $i++;  

        }

        return $response;

    }



    public function createPendingTransactionExpress($user,$drugid,$qty,$coupon,$startdate,$enddate){
       

           $query = $this->db->query('SELECT * FROM drugprices WHERE drugid = "'.$drugid.'" LIMIT 0,1'); 

           $drugStore = $query->result(); 

           //fetch the discount price on coupon
           $query = $this->db->query('SELECT amount FROM coupon WHERE  code = "'. trim($coupon).'" AND status="Open" LIMIT 0,1'); 

           $couponResultSet = $query->result(); 

           $couponamount = $couponResultSet[0]->amount;

           //$absoluteprice = $drugStore[0]->drugprice - $couponamount; 

           $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $drugid,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "Awaiting order confirmation",
                    'comments' => "Ordered",
                    'startdate'=> date('Y-m-d H:i:s'),
                    'enddate' =>date('Y-m-d H:i:s'),
                    'qty' => $qty,
                    'price' => $drugStore[0]->drugprice
                ); 

          $this->db->insert('patientrefill', $arrObject);

          $insertedid = $this->db->insert_id(); 

          $arrObjectT = array(
                    'patientid' => $user ,
                    'orderid' => $insertedid ,
                    'transactiondate' => date('Y-m-d H:i:s'),
                    'storeid' => $drugStore[0]->storeid
                ); 

         $this->db->insert('transactions', $arrObjectT);



         $arrObject = array(
                        'patientid' => $user ,
                        'drugid' => $drugid,
                        'refilldate' => date('Y-m-d H:i:s'),
                        'description' => "Coupon",
                        'comments' => "Pending",
                        'startdate'=> date('Y-m-d H:i:s'),
                        'enddate' =>date('Y-m-d H:i:s'),
                        'qty' => 1,
                        'price' => "-".$couponamount
                    );

          if($i == 0){
             if($couponamount){
              $this->db->insert('patientrefill', $arrObject);

              $insertedid = $this->db->insert_id(); 

              $arrObjectT = array(
                        'patientid' => $user ,
                        'orderid' => $insertedid ,
                        'transactiondate' => date('Y-m-d H:i:s'),
                        'storeid' => $drugStore[0]->storeid
                    ); 

              $this->db->insert('transactions', $arrObjectT);

              $this->db->query('UPDATE coupon SET status = "Closed"  WHERE  code = "'. trim($coupon).'"'); 

              } 
            }
         $i++;
          
         $response =  "Created pending transaction!"; 
       

        return $response;

    }



    public function createInvoiceTransactionExpress($user,$drugid,$qty,$coupon,$startdate,$enddate){
       

           $query = $this->db->query('SELECT * FROM drugprices WHERE drugid = "'.$drugid.'" LIMIT 0,1'); 

           $drugStore = $query->result(); 

           //fetch the discount price on coupon
           $query = $this->db->query('SELECT amount FROM coupon WHERE  code = "'. trim($coupon).'" AND status="Open" LIMIT 0,1'); 

           $couponResultSet = $query->result(); 

           $couponamount = $couponResultSet[0]->amount;

           //$absoluteprice = $drugStore[0]->drugprice - $couponamount; 

           $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $drugid,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "Awaiting order confirmation",
                    'comments' => "Ordered",
                    'startdate'=> date('Y-m-d H:i:s'),
                    'enddate' =>date('Y-m-d H:i:s'),
                    'qty' => $qty,
                    'price' => $drugStore[0]->drugprice
                ); 

          $this->db->insert('patientrefill', $arrObject);

          $insertedid = $this->db->insert_id(); 

          $arrObjectT = array(
                    'patientid' => $user ,
                    'orderid' => $insertedid ,
                    'transactiondate' => date('Y-m-d H:i:s'),
                    'storeid' => $drugStore[0]->storeid
                ); 

         $this->db->insert('transactions', $arrObjectT);



         $arrObject = array(
                        'patientid' => $user ,
                        'drugid' => $drugid,
                        'refilldate' => date('Y-m-d H:i:s'),
                        'description' => "Coupon",
                        'comments' => "Pending",
                        'startdate'=> date('Y-m-d H:i:s'),
                        'enddate' =>date('Y-m-d H:i:s'),
                        'qty' => 1,
                        'price' => "-".$couponamount
                    );

          if($i == 0){
             if($couponamount){
              $this->db->insert('patientrefill', $arrObject);

              $insertedid = $this->db->insert_id(); 

              $arrObjectT = array(
                        'patientid' => $user ,
                        'orderid' => $insertedid ,
                        'transactiondate' => date('Y-m-d H:i:s'),
                        'storeid' => $drugStore[0]->storeid
                    ); 

              $this->db->insert('transactions', $arrObjectT);

              $this->db->query('UPDATE coupon SET status = "Closed"  WHERE  code = "'. trim($coupon).'"'); 

              } 
            }
         $i++;
          
         $response =  "Created pending transaction!"; 
       

        return $response;

    }




  function get_pTransactions($user,$selString)
    {
       
        $this->db->select('transactions.id,drugs.genericname,transactions.transactiondate,patientrefill.description,patientrefill.comments,drugprices.drugprice');
        $this->db->from('transactions');
        $this->db->join('patientrefill','patientrefill.id = transactions.orderid');
        $this->db->join('drugs','drugs.id = patientrefill.drugid');
        $this->db->join('drugprices','drugprices.drugid = patientrefill.drugid');
        $this->db->where('patientrefill.patientid',$user);
        //$this->db->where('patientrefill.comments','Pending');

        $column_order = array(null, 'transactions.id','drugs.genericname','transactions.transactiondate','patientrefill.description','patientrefill.comments'); 
        $column_search = array('transactions.id','drugs.genericname','transactions.transactiondate','patientrefill.description','patientrefill.comments'); 
        $order = array('transactions.id' => 'asc');        
 
        $i = 0;
     
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) 
            {
                 
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            
            $this->db->order_by(key($order), $order[key($order)]);      
        }

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


 function get_sTransactions($user,$selString)
      {
       
        $this->db->select('drugs.id,drugs.genericname,drugprices.drugprice,drugprices.tax');
        $this->db->from('drugs');
        $this->db->join('drugprices','drugprices.drugid = drugs.id');
        $this->db->group_by('drugs.genericname');

        $column_order = array(null, 'drugs.id','drugs.genericname','drugprices.drugprice','drugprices.tax'); 
        $column_search = array('drugs.id','drugs.genericname','drugprices.drugprice','drugprices.tax'); 
        $order = array('drugs.id' => 'asc');      
 
        $i = 0;
     
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) 
            {
                 
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            //$order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);      
        }

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }



     function getDrugAvailability($drugid)
      { 
       $query = $this->db->query('SELECT d.id,s.storename,s.id as store,
        dp.drugprice FROM drugs d , drugprices dp , stores s 
        WHERE dp.drugid = d.id 
        AND s.id = dp.storeid 
        AND d.genericname 
        like (SELECT genericname FROM drugs 
             WHERE id = '.$drugid.')'); 
    return $query->result();
    }

    function fetchPendingRefillStores($patientId)
      { 
       $query = $this->db->query('
        SELECT pr.id,t.storeid
         FROM patientrefill pr , transactions t
         WHERE
        pr.id = t.orderid
        AND pr.patientid = "'.$patientId.'"
        AND pr.comments = "Pending" AND storeid IS NOT NULL 
        GROUP BY t.storeid
        '); 
    return $query->result();
    }


    function fetchPendingRefill($storeid,$patientId)
      { 
       $query = $this->db->query('
            SELECT 
                pr.id,
                t.storeid,
                d.genericname,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,
                pr.price,
                pr.qty
            FROM
                stores s,
                patientrefill pr,
                transactions t,
                drugs d
                    LEFT JOIN
                drugprices dp ON d.id = dp.drugid
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND pr.patientid = "'.$patientId.'"
                    AND pr.comments = "Pending" 
            AND s.id = "'.$storeid.'"
        '); 
    return $query->result();
    }




     function getDrugDetails($drugid)
      { 
       $query = $this->db->query('
            SELECT 
            d.id,d.genericname,dp.drugprice,i.img,ds.dosename,ds.minimumdose,ds.maximumdose,ds.dose 
            FROM drugprices dp ,drugs d 
            LEFT JOIN
            images i ON i.parent = d.id
            LEFT JOIN dose ds ON ds.drugid = d.id
            WHERE dp.drugid = d.id 
            AND d.id = '.$drugid.'
            GROUP BY d.id
             '
        ); 
    return $query->result();
    }

  function searchDrugDetails($arrayParameters)
      { 
       $query = $this->db->query('
            SELECT 
            d.id,d.genericname,dp.drugprice,i.img,ds.dosename,ds.minimumdose,ds.maximumdose,ds.dose 
            FROM drugprices dp ,drugs d 
            LEFT JOIN
            images i ON i.parent = d.id
            LEFT JOIN dose ds ON ds.drugid = d.id
            WHERE dp.drugid = d.id           
            GROUP BY d.id LIMIT 0,10
             '
        ); 
    return $query->result();
    }


   function searchPharmacyDetails($arrayParameters)
      {       
        $this->db->select('stores.id,stores.storename,stores.location,stores.latitude,stores.longitude,stores.longitude,stores.additionalservices,stores.comments,stores.address,stores.telephone,stores.email ,IF(stores.img IS NOT NULL ,concat("http://tibamoja.co.ke/",stores.img),"http://tibamoja.co.ke/assets/img/pharmacy1.jpg")  img ');
        $this->db->from('stores');
        $query = $this->db->get();
    return $query->result();
    }

   function searchPharmacysDetails($parameter)
      {    
           $query = $this->db->query('
            SELECT 

            stores.id,stores.storename,stores.location,stores.latitude,stores.longitude,stores.additionalservices,stores.comments,stores.address,stores.telephone,stores.email ,IF(stores.img IS NOT NULL ,concat("http://tibamoja.co.ke/",stores.img),"http://tibamoja.co.ke/assets/img/pharmacy1.jpg")  img 


            FROM stores WHERE stores.storename LIKE "%'.$parameter .'%" 

            UNION

            SELECT 

            clinic.id,clinic.clinicname as storename,clinic.location,clinic.latitude,clinic.longitude,"additionalservices","comments",clinic.address,clinic.telephone,clinic.email ,IF(clinic.img IS NOT NULL ,concat("http://tibamoja.co.ke/",clinic.img),"http://tibamoja.co.ke/assets/img/pharmacy1.jpg")  img 

            FROM clinics clinic 

            WHERE LOWER(clinic.clinicname) LIKE "%'.$Parameter .'%"  

            '
        ); 
    return $query->result();
    }


  function getDrugScannedDetails($drugid)
      { 
       $query = $this->db->query('
            SELECT 
            d.id,d.genericname,dp.drugprice,i.img,ds.dosename,ds.minimumdose,ds.maximumdose,ds.dose,IF(d.img IS NOT NULL ,concat("http://pharm-portal.coreict.co.ke/",d.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img
            FROM drugprices dp ,drugs d 
            LEFT JOIN
            images i ON i.parent = d.id
            LEFT JOIN dose ds ON ds.drugid = d.id
            WHERE dp.drugid = d.id 
            AND (d.id = '.$drugid.' || d.productid = '.$drugid.' || d.serialno = '.$drugid.')
            GROUP BY d.id
             '
        ); 
    return $query->result();
    }

  public function updateStatusTransaction($arrObject,$id){ 
      $array = array('patientid' => $id, 'comments' => 'Pending');
      $this->db->where($array);    
      $this->db->update('patientrefill',$arrObject);
    } 
 
 
}


