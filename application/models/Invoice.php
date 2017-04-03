<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Invoice extends CI_Model { 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }    

    public function fetchsmtp(){ 
          $this->db->where('default', 1);         
          $query = $this->db->get('smtp');  
        return $query;

    }

 

 function fetchConfirmRefillIds($storeid,$patientId,$orderno,$type)
      {      

        if($type == 1){
            $description = "Invoice sent";
        }else{
            $description = "Awaiting Invoice";
        }

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
                s.email,u.id as user,pr.price,pr.qty,orderno
            FROM
                stores s,
               
                transactions t,users u,
                drugs d , patientrefill pr
                    LEFT JOIN
                drugprices dp ON pr.drugid = dp.drugid
                LEFT JOIN orderitems oi ON oi.itemid = pr.id
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = "'.$patientId.'"
                    AND pr.description = "'.$description.'" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'"  AND orderno ="'.$orderno.'"
        ');  

      /*  var_dump('
            SELECT 
                pr.id,
                t.storeid,
                d.genericname,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,u.id as user,pr.price,pr.qty,orderno
            FROM
                stores s,
               
                transactions t,users u,
                drugs d , patientrefill pr
                    LEFT JOIN
                drugprices dp ON pr.drugid = dp.drugid
                LEFT JOIN orderitems oi ON oi.itemid = pr.id
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = "'.$patientId.'"
                    AND pr.description = "'.$description.'" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'"  AND orderno ="'.$orderno.'"
        '); exit(); */
 
    return $query->result();
    }

    function count_filtered()
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
                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id
                    FROM
                        stores s,
                        patientrefill pr,
                        transactions t,
        users u ,
        persons p,
                        drugs d
                            LEFT JOIN
                        drugprices dp ON d.id = dp.drugid
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
        AND u.personid = p.id 
        AND u.id = pr.patientid                 
                            AND pr.comments = "Invoiced" 
        GROUP BY u.id ,s.id

       '); 
        return $query->num_rows();
    }
 
    public function count_all()
    {

      $query = $this->db->query('
          SELECT 
               count(*) as count
                    FROM
                        stores s,
                        patientrefill pr,
                        transactions t,
        users u ,
        persons p,
                        drugs d
                            LEFT JOIN
                        drugprices dp ON d.id = dp.drugid
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
        AND u.personid = p.id 
        AND u.id = pr.patientid                 
                            AND pr.comments = "Invoiced"  
        GROUP BY u.id ,s.id

       '); 
      
        $list = $query->result();

        return $list[0]->count;
    }

    function getInvoices()
    {

        $query = $this->db->query('
            SELECT 
                concat(s.id, "_", p.id ,"_",ie.invoiceno) as id,
                t.storeid,
                d.genericname,
                i.invoicedate,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,
                p.Firstname,
                p.Secondname,
                p.phone,
                p.address,
                p.town,
                u.id as user,
                ie.invoiceno,
                i.orderno,
              (i.amount + i.tax) totals,
               i.file
            FROM
                stores s,
                transactions t,
                users u,
                persons p,
                drugs d,
                patientrefill pr
                    LEFT JOIN
                drugprices dp ON pr.drugid = dp.drugid
                    LEFT JOIN
                invoiceitems ie ON ie.itemid = pr.id
                    LEFT JOIN
                invoice i ON ie.invoiceno = i.invoiceno
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = p.id
                    AND u.id = pr.patientid
                    AND (pr.comments = "Invoiced" || pr.description = "Paid" )
            GROUP BY i.invoicedate DESC

       '); 


        $column_order = array(null, 's.id'); 
        $column_search = array('s.storename'); 
        $order = array('s.storename' => 'asc');        
 
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
        return $query->result();
    }




function getUserInvoices($userId)
    {

        $query = $this->db->query('
            SELECT 
                concat(s.id, "_", p.id ,"_",ie.invoiceno) as id,
                t.storeid,
                d.genericname,
                i.invoicedate,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,
                p.Firstname,
                p.Secondname,
                p.phone,
                p.address,
                p.town,
                u.id as user,
                ie.invoiceno,
                i.orderno,
              (i.amount + i.tax) totals,
               i.file
            FROM
                stores s,
                transactions t,
                users u,
                persons p,
                drugs d,
                patientrefill pr
                    LEFT JOIN
                drugprices dp ON pr.drugid = dp.drugid
                    LEFT JOIN
                invoiceitems ie ON ie.itemid = pr.id
                    LEFT JOIN
                invoice i ON ie.invoiceno = i.invoiceno
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = p.id
                    AND u.id = pr.patientid
                    AND (pr.comments = "Invoiced" || pr.description = "Paid" ) AND u.personid = "'.$userId.'"
            GROUP BY i.invoicedate DESC

       '); 

        $column_order = array(null, 's.id'); 
        $column_search = array('s.storename'); 
        $order = array('s.storename' => 'asc');        
 
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
        return $query->result();
    }




    function getInvoiceDetails($orderId)
    {
        $parArray = explode('_',$orderId);

        $query = $this->db->query('
                SELECT 
                    concat(s.id, "_", p.id) as id,
                    t.storeid,
                    d.genericname,
                    dp.drugprice,
                    dp.tax,
                    s.storename,
                    s.address,
                    s.telephone,
                    s.email,
                    p.Firstname,
                    p.Secondname,
                    p.phone,
                    p.address,
                    p.town,
                    u.id as user,
                    ie.invoiceno,
                    i.orderno,
                    pr.description,
                    pr.qty,
                    pr.price
                FROM
                    stores s,
                    transactions t,
                    users u,
                    persons p,
                    drugs d,
                    patientrefill pr
                        LEFT JOIN
                    drugprices dp ON pr.drugid = dp.drugid
                        LEFT JOIN
                    invoiceitems ie ON ie.itemid = pr.id
                        LEFT JOIN
                    invoice i ON ie.invoiceno = i.invoiceno
                WHERE
                    pr.id = t.orderid AND s.id = t.storeid
                        AND pr.drugid = d.id
                        AND u.personid = p.id
                        AND u.id = pr.patientid
                        
                        AND s.id = "'.$parArray[0].'" AND p.id = "'.$parArray[1].'" AND ie.invoiceno = "'.$parArray[2].'"             

       '); //AND pr.comments = "Invoiced"


        $column_order = array(null, 's.id'); 
        $column_search = array('s.storename'); 
        $order = array('s.storename' => 'asc');        
 
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
        return $query->result();
    }


        function getOrdersDetails($orderId)
    {
        $parArray = explode('_',$orderId);

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
                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id as user
                    FROM
                        stores s,
                        patientrefill pr,
                        transactions t,
        users u ,
        persons p,
                        drugs d
                            LEFT JOIN
                        drugprices dp ON d.id = dp.drugid
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
        AND u.personid = p.id 
        AND u.id = pr.patientid                 
                            AND pr.comments = "Invoiced" 
        AND s.id = "'.$parArray[0].'" AND p.id = "'.$parArray[1].'"

       '); 


        $column_order = array(null, 's.id'); 
        $column_search = array('s.storename'); 
        $order = array('s.storename' => 'asc');        
 
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
        return $query->result();
    }


    function getFilterInvoices($storeid){
        

        $query = $this->db->query('
          SELECT 
                    concat(s.id, "_", p.id ,"_",ie.invoiceno) as id,
                    t.storeid,
                    i.invoicedate,
                    d.genericname,
                    dp.drugprice,
                    dp.tax,
                    s.storename,
                    s.address,
                    s.telephone,
                    s.email,
                    p.Firstname,
                    p.Secondname,
                    p.phone,
                    p.address,
                    p.town,
                    u.id as user,
                    ie.invoiceno,
                    i.orderno,
                  (i.amount + i.tax) totals,
                    pr.description,
                    i.file
                FROM
                    stores s,
                    transactions t,
                    users u,
                    persons p,
                    drugs d,
                    patientrefill pr
                        LEFT JOIN
                    drugprices dp ON pr.drugid = dp.drugid
                        LEFT JOIN
                    invoiceitems ie ON ie.itemid = pr.id
                        LEFT JOIN
                    invoice i ON ie.invoiceno = i.invoiceno
                WHERE
                    pr.id = t.orderid AND s.id = t.storeid
                        AND pr.drugid = d.id
                        AND u.personid = p.id
                        AND u.id = pr.patientid
                        AND pr.comments = "Invoiced"
                        AND t.storeid = "'.$storeid.'"
                GROUP BY   i.invoicedate DESC

       '); 


        $column_order = array(null, 's.id'); 
        $column_search = array('s.storename'); 
        $order = array('s.storename' => 'asc');        
 
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
        return $query->result();


    }


       function getInvoicesCatFilter($storeid,$cat){
        

        $query = $this->db->query('
          SELECT 
                concat(s.id, "_", p.id ,"_",ie.invoiceno) as id,
                t.storeid,
                i.invoicedate,
                d.genericname,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,
                p.Firstname,
                p.Secondname,
                p.phone,
                p.address,
                p.town,
                u.id as user,
                ie.invoiceno,
                i.orderno,
              (i.amount + i.tax) totals,
                i.file
            FROM
                stores s,
                transactions t,
                users u,
                persons p,
                drugs d,
                drugtocategory dc ,
                patientrefill pr
                    LEFT JOIN
                drugprices dp ON pr.drugid = dp.drugid
                    LEFT JOIN
                invoiceitems ie ON ie.itemid = pr.id
                    LEFT JOIN
                invoice i ON ie.invoiceno = i.invoiceno
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = p.id
           AND dc.drugid = d.id
                    AND u.id = pr.patientid
                    AND pr.comments = "Invoiced"
                   AND dc.storeid = "'.$storeid.'"  AND dc.categoryid = "'.$cat.'" GROUP BY ie.invoiceno

       '); 


        $column_order = array(null, 's.id'); 
        $column_search = array('s.storename'); 
        $order = array('s.storename' => 'asc');        
 
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
        return $query->result();


    }


  public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      $this->db->update('patientrefill',$arrObject);
    } 

  public function getMaxInv(){
     $query = $this->db->query('SELECT max(id) as max FROM invoice   
       '); 
    return $query->result(); 
    }

  public function getInvoiceTotals($storeid,$patientId,$type){

        if($type == 1){
            $description = "Invoice sent";
        }else{
            $description = "Awaiting Invoice";
        }

       $query = $this->db->query('
            SELECT 
                sum(pr.price * pr.qty) as totals
            FROM
                stores s,
                patientrefill pr,
                transactions t,users u,
                drugs d
                    LEFT JOIN
                drugprices dp ON d.id = dp.drugid
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = "'.$patientId.'"
                    AND pr.description = "'.$description.'" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'" 
        '); 

    return $query->result();

  }  

 public function getInvoiceTax($storeid,$patientId,$type){

        if($type == 1){
            $description = "Invoice sent";
        }else{
            $description = "Awaiting Invoice";
        }

       $query = $this->db->query('
            SELECT 
                sum((pr.price * pr.qty) * (dp.tax/100)) as tax
            FROM
                stores s,
                patientrefill pr,
                transactions t,users u,
                drugs d
                    LEFT JOIN
                drugprices dp ON d.id = dp.drugid
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = "'.$patientId.'"
                    AND pr.description = "'.$description.'" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'" 
        '); 

    return $query->result();

  }  

    public function createInvoice($arrObject){    

      $this->db->insert('invoice', $arrObject);

      return $this->db->insert_id(); 

    }

    public function createInvoiceItems($arrObject){    

      $this->db->insert('invoiceitems', $arrObject);

     return $this->db->insert_id(); 

    }

    public function fetchUserInvoice($invoice){

     $query = $this->db->query('
            SELECT 
                p.phone, p.firstname,p.secondname,u.id as user,p.id as personid , i.amount , i.tax
            FROM
                persons p,
                users u,
                invoice i
            WHERE
                p.id = u.personid AND i.patientid = u.id
                    AND i.invoiceno = "'.$invoice.'"
        '); 

    return $query->result();


    }


    public function savePdfFile($arrObject,$id){        
      $this->db->where('invoiceno',$id);
      $this->db->update('invoice',$arrObject);
    } 

 
}