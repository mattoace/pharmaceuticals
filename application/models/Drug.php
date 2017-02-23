<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Drug extends CI_Model {
 
    var $table = 'drugs';
    var $column_order = array(null, 'drugs.genericname','drugprices.tax','drugprices.drugprice'); //set column field database for datatable orderable
    var $column_search = array('drugs.genericname','drugprices.tax','drugprices.drugprice'); //set column field database for datatable searchable 
    var $order = array('drugs.id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($id,$cat)
    {
         
        //$this->db->from($this->table);

        $this->db->select('drugs.id,drugs.genericname,drugprices.drugprice,drugprices.tax');
        $this->db->from('drugs');
        $this->db->join('drugprices','drugprices.drugid = drugs.id');


        if($cat){
             $this->db->join('drugtocategory','drugtocategory.drugid = drugs.id');
        }

         $this->db->where('drugprices.storeid',$id);

        if($cat){
         $this->db->where('drugtocategory.categoryid',$cat);
        }

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
 
    function get_datatables($id)
    {
        $this->_get_datatables_query($id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

   function get_datatablesFilter($id,$cat)
    {
        $this->_get_datatables_query($id,$cat);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }



    function get_datatables_client()
    {
        
        $this->db->select('drugs.id,drugs.genericname,drugprices.drugprice,drugprices.tax,concat("http://pharm-portal.coreict.co.ke/",drugs.img ) img');
        $this->db->from('drugs');
        $this->db->join('drugprices','drugprices.drugid = drugs.id');
        $this->db->group_by('drugs.genericname');    
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
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
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);      
        }

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
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

    public function addNew($arrObject){

      $this->db->insert('drugs', $arrObject);
      return $this->db->insert_id();      
    }

    public function fetchedit($id){     
        $this->db->select('drugs.id,drugs.genericname,drugs.serialno,drugs.productid,drugprices.drugprice,drugprices.tax, IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('drugs');
        $this->db->join('drugprices','drugprices.drugid = drugs.id');
        $this->db->where('drugs.id',$id);
        $query = $this->db->get();

        return $query;

    }

    public function fetchProduct($storeid){

        $this->db->select('drugs.id,drugprice,tax,genericname,drugs.serialno,drugs.productid, IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('drugs');
        $this->db->join('drugprices','drugprices.drugid = drugs.id');
        $this->db->where('drugprices.storeid',$storeid); 
        $this->db->limit(300,1);
        $query = $this->db->get();
        return $query;
    }


    public function fetchReview($drugid){

        $this->db->select('drugs.id,drugs.genericname,drugs.serialno,drugs.productid,rating,comments,persons.firstname,persons.secondname,persons.surname,persons.email,title,reviewdate,
        IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('ratings');
        $this->db->join('users','users.id = ratings.patientid');
        $this->db->join('persons','persons.id = users.personid');
        $this->db->join('drugs','ratings.drugid = drugs.id');
        $this->db->where('ratings.drugid',$drugid);     
        $query = $this->db->get();
        return $query;
    }
  public function fetchAllReview($rating){

        $this->db->select('drugs.id,drugs.genericname,drugs.serialno,drugs.productid,rating,comments,persons.firstname,persons.secondname,persons.surname,persons.email,title,reviewdate,
        IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('ratings');
        $this->db->join('users','users.id = ratings.patientid');
        $this->db->join('persons','persons.id = users.personid');
        $this->db->join('drugs','ratings.drugid = drugs.id');
        $this->db->where('ratings.rating',$rating);     
        $query = $this->db->get();
        return $query;
    }

   public function creatReview($arrObject){
          $response = "Posting a rating.";
          if($this->db->insert('ratings', $arrObject)){
             $response = "Posted a rating!";
          }else{  $response = "Error in posting!";}

          return $response;
    }

   public function fetchPatientOrders($patientid){

        $this->db->select('patientrefill.id,patientrefill.patientid,patientrefill.drugid,patientrefill.refilldate ,patientrefill.comments, IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('patientrefill');
        $this->db->join('drugs','patientrefill.drugid = drugs.id');       
        $this->db->where('patientrefill.patientid',$patientid); 
        $this->db->where('patientrefill.description','New Order');      
        $query = $this->db->get();
        return $query;
    }

    public function fetchPatientUnconfirmedOrders($patientid){

        $this->db->select('patientrefill.id,patientrefill.patientid,patientrefill.drugid,patientrefill.refilldate ,patientrefill.comments, IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('patientrefill');
        $this->db->join('drugs','patientrefill.drugid = drugs.id');       
        $this->db->where('patientrefill.patientid',$patientid); 
        $this->db->where('patientrefill.description','Awaiting order confirmation');      
        $query = $this->db->get();
        return $query;
    }

    public function fetchPatientInvoices($patientid){

      /*  $this->db->select('patientrefill.id,patientrefill.patientid,patientrefill.drugid,patientrefill.refilldate ,patientrefill.comments, IF(drugs.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",drugs.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img');
        $this->db->from('patientrefill');
        $this->db->join('drugs','patientrefill.drugid = drugs.id');       
        $this->db->where('patientrefill.patientid',$patientid); 
        $this->db->where('patientrefill.description','Invoice sent');  */  

        $this->db->select('invoice.id,invoice.invoiceno,invoice.amount,invoice.tax ,invoice.currency,concat("http://pharm-portal.coreict.co.ke/",invoice.file) file');
        $this->db->from('invoice');             
        $this->db->where('invoice.patientid',$patientid);  
        $query = $this->db->get();
        return $query;
    }



    public function searchProduct($arrayObject){

       $drugname = strtolower($arrayObject['drugname']);

       $query = $this->db->query('SELECT d.id,d.genericname,d.serialno,d.productid,dp.drugprice,dp.tax ,IF(d.img IS NOT NULL ,concat("http://pharm-portal.coreict.co.ke/",d.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img
        FROM drugs d , drugprices dp , stores s 
        WHERE dp.drugid = d.id 
        AND s.id = dp.storeid 
        AND s.id = "'.$arrayObject['storeid'].'"
        AND LOWER(d.genericname) LIKE "'. $drugname .'%" || LOWER(d.genericname) LIKE "%'.$drugname .'"
       
       '); 
    
    return $query;

    }


   public function searchKeyword($arrayObject){
    
       $drugname = strtolower($arrayObject['drugname']);

       $query = $this->db->query('SELECT d.id,d.genericname,d.serialno,d.productid,dp.drugprice,dp.tax ,IF(d.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",d.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img
        FROM drugs d , drugprices dp , stores s 
        WHERE dp.drugid = d.id 
        AND s.id = dp.storeid      
        AND LOWER(d.genericname) LIKE "'. $drugname .'%" || LOWER(d.genericname) LIKE "%'.$drugname .'"
       
       '); 

    return $query;

    }


  public function getDrugCategory($arrayObject){
    
       $categoryname = strtolower($arrayObject['categoryname']);

       $query = $this->db->query('SELECT d.id,d.genericname,d.serialno,d.productid,dp.drugprice,dp.tax,IF(d.img IS NOT NULL ,concat("http://pharm-portal.coreict.co.ke/",d.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img
        FROM drugs d , drugprices dp , drugtocategory dtc , category c
        WHERE dp.drugid = d.id 
         AND dtc.drugid = d.id 
         AND c.id = dtc.categoryid     
         AND LOWER(c.categoryname) LIKE "%'.$categoryname .'%"
       
       '); 

    return $query;

    }


 public function getPrescriptionUpload($arrayObject){ 

       $query = $this->db->query('SELECT 
            id,uploadate,filename,patientid,concat("http://pharm-portal.coreict.co.ke/",path) as path
       FROM prescriptionupload WHERE patientid =  "'.$arrayObject['patientid'].'"
       
       '); 

    return $query;

    }

 public function getPrescription($arrayObject){ 

     $query = $this->db->query('SELECT 
        d.id,
        d.productid,
        i.patientid,        
        d.genericname,
        d.serialno,       
        dp.drugprice,
        dp.tax,
        IF(d.img IS NOT NULL,
            concat("http://pharm-portal.coreict.co.ke/",
                    d.img),
            "http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img,
        do.dose,
        do.maximumdose,
        do.minimumdose,
        rf.refilldate,
        rf.startdate,
        rf.enddate
    FROM
        invoice i,
        invoiceitems ii,
        drugs d
            LEFT JOIN
        drugprices dp ON dp.drugid = d.id
            LEFt JOIN
        dose do ON do.drugid = d.id
        LEFT JOIN patientrefill rf ON rf.drugid = d.id
    WHERE
        i.invoiceno = ii.invoiceno
            AND d.id = ii.itemid
            AND i.patientid =  "'.$arrayObject['patientid'].'" GROUP BY d.id
       
       '); 

    return $query;

    }


public function getDrugCoupon($arrayObject){  

       $query = $this->db->query('
        SELECT id,code,amount,status FROM coupon      
       '); 

    return $query;

    }


 public function allProducts($from=0,$to=100){  

       $query = $this->db->query('SELECT d.id,d.genericname,d.serialno,d.productid,dp.drugprice,dp.tax ,IF(d.img IS NOT NULL,concat("http://pharm-portal.coreict.co.ke/",d.img),"http://pharm-portal.coreict.co.ke/assets/img/defaultdrug.png") as img
        FROM drugs d , drugprices dp , stores s 
        WHERE dp.drugid = d.id 
        AND s.id = dp.storeid      
        GROUP BY d.genericname LIMIT '.$from.', '.$to.'     
       '); 

    return $query; //LIMIT '.$from.' , '.$to.' 

    }

    public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      $this->db->update('drugs',$arrObject);
    } 

    public function deleteRecord($id){
      $this->db->where('id', $id);
      $this->db->delete('drugs'); 
      $this->db->where('drugid', $id);
      $this->db->delete('drugprices'); 
    }

    public function addNew_Pricetable($arrObject){
      $this->db->insert('drugprices', $arrObject);
      return $this->db->insert_id();
    }

    public function addImages($arrObject){ 
      $this->db->insert('images', $arrObject);
      return $this->db->insert_id();
    }

    public function saveImage($arrObject,$id){ 
      $this->db->where('id',$id);
      $this->db->update('drugs',$arrObject);
    }



    public function save_Pricetable($arrObject,$id){
            $this->db->where('drugid',$id);
            $this->db->update('drugprices',$arrObject);
    }

    public function getImageList($id){

      $query = $this->db->query('

       SELECT * FROM images WHERE parent = "'.$id.'"
       '); 
       
       return $query->result();
    }

/*    public function createTransaction($user,$selString){

     $postArr = explode("_", $selString);
 
     $arrObject = array(
                    'patientid' => $user ,
                    'drugid' => $postArr[0] ,
                    'refilldate' => date('Y-m-d H:i:s'),
                    'description' => "New Order",
                    'comments' => "Pending"
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

  function get_pTransactions($user,$selString)
    {
       
        $this->db->select('transactions.id,drugs.genericname,transactions.transactiondate,patientrefill.description,patientrefill.comments');
        $this->db->from('transactions');
        $this->db->join('patientrefill','patientrefill.id = transactions.orderid');
        $this->db->join('drugs','drugs.id = patientrefill.drugid');
        $this->db->where('patientrefill.patientid',$user);

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
 */
}


