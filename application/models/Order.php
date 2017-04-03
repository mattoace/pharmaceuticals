<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Order extends CI_Model { 

 
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
                            AND pr.comments = "Ordered" 
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
                            AND pr.comments = "Ordered" 
        GROUP BY u.id ,s.id

       '); 
      
        $list = $query->result();

        return $list[0]->count;
    }

    function getOrders()
    {

        $query = $this->db->query('
          SELECT 
                        concat(s.id,"_",p.id) as id,
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
                      
                        transactions t,
                        patientrefill pr ,
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
                            AND pr.comments = "Ordered" 
        GROUP BY u.id ,s.id

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


    function getcOrders()
    {

        $query = $this->db->query('
        SELECT 
            concat(s.id, "_", p.id, "_", o.orderno) as id,
            t.storeid,
            d.genericname,
            o.orderdate,
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
            o.orderno,
            pr.description,
            o.file
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
            orderitems oi ON oi.itemid = pr.id
                LEFT JOIN
            orders o ON o.orderno = oi.orderno
        WHERE
            pr.id = t.orderid AND s.id = t.storeid
                AND pr.drugid = d.id
                AND u.personid = p.id
                AND u.id = pr.patientid
        GROUP BY o.orderdate DESC
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




    function getUserOrders($userId)
    {

        $query = $this->db->query('
        SELECT 
            concat(s.id, "_", p.id, "_", o.orderno) as id,
            t.storeid,
            d.genericname,
            o.orderdate,
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
            o.orderno,
            pr.description,
            o.file
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
            orderitems oi ON oi.itemid = pr.id
                LEFT JOIN
            orders o ON o.orderno = oi.orderno
        WHERE
            pr.id = t.orderid AND s.id = t.storeid
                AND pr.drugid = d.id
                AND u.personid = p.id
                AND u.id = pr.patientid AND u.personid = "'.$userId.'"
        GROUP BY o.orderdate DESC
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


    function getFilterOrders($storeid){
        

        $query = $this->db->query('
          SELECT 
                        concat(s.id,"_",p.id,"_",orderno) as id,
                        t.storeid,
                        d.genericname,
                        dp.drugprice,
                        dp.tax,
                        s.storename,
                        s.address,
                        s.telephone,
                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id as user ,orderno
                    FROM
                        stores s,
                        
                        transactions t,
        users u ,
        persons p,
                        drugs d ,patientrefill pr
                            LEFT JOIN
                        drugprices dp ON pr.drugid  = dp.drugid
                           LEFT JOIN orderitems oi ON oi.itemid = pr.id
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
        AND u.personid = p.id 
        AND u.id = pr.patientid                 
                            AND pr.comments = "Ordered" 
        AND s.id = "'.$storeid.'"  GROUP BY p.id

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


    function getFiltercOrders($storeid){
        

        $query = $this->db->query('
            SELECT 
                concat(s.id, "_", p.id, "_", o.orderno) as id,
                t.storeid,
                o.orderdate,
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
                pr.id as patientrefillid,
                o.orderno,
                pr.description,
                o.file 
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
                orderitems oi ON oi.itemid = pr.id
                   LEFT JOIN
                   orders o ON o.orderno = oi.orderno
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
                    AND u.personid = p.id
                    AND u.id = pr.patientid
                    AND pr.description = "Awaiting Invoice"
                    AND s.id = "'.$storeid.'"
            GROUP BY o.orderdate DESC

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



    function getcFilterOrders($storeid,$cat){
        

        $query = $this->db->query('
          SELECT 
                        concat(s.id,"_",p.id,"_",orderno) as id,
                        t.storeid,
                        d.genericname,
                        dp.drugprice,
                        dp.tax,
                        s.storename,
                        s.address,
                        s.telephone,
                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id as user,orderno
                    FROM
                        stores s,                    
                        transactions t,
        users u ,
        persons p, drugtocategory dc ,
                        drugs d , patientrefill pr
                            LEFT JOIN
                        drugprices dp ON pr.drugid = dp.drugid
                        LEFT JOIN orderitems oi ON oi.itemid = pr.id
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
                            AND dc.drugid = d.id
        AND u.personid = p.id 
        AND u.id = pr.patientid                 
                            AND pr.comments = "Ordered" 
        AND dc.storeid = "'.$storeid.'"  AND dc.categoryid = "'.$cat.'" GROUP BY p.id

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



       function getcFiltercOrders($storeid,$cat){
        

        $query = $this->db->query('
          SELECT 
                        concat(s.id,"_",p.id,"_",orderno) as id,
                        t.storeid,
                        d.genericname,
                        dp.drugprice,
                        dp.tax,
                        s.storename,
                        s.address,
                        s.telephone,
                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id as user,orderno,pr.description 
                    FROM
                        stores s,
                        
                        transactions t,
        users u ,
        persons p, drugtocategory dc ,
                        drugs d ,patientrefill pr
                            LEFT JOIN
                        drugprices dp ON pr.drugid = dp.drugid
                            LEFT JOIN orderitems oi ON oi.itemid = pr.id
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
                            AND dc.drugid = d.id
        AND u.personid = p.id 
        AND u.id = pr.patientid                 
                            
        AND dc.storeid = "'.$storeid.'"  AND dc.categoryid = "'.$cat.'" GROUP BY p.id

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

    function getOrdersDetails($orderId)
    {
        $parArray = explode('_',$orderId);

        $query = $this->db->query('
          SELECT 
                        d.id,
                        t.storeid,
                        d.genericname,
                        dp.drugprice,
                        dp.tax,
                        s.storename,
                        pr.qty,
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
                            AND pr.comments = "Ordered" 
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


    function getcOrdersDetails($orderId)
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
                        s.email ,p.Firstname,p.Secondname,p.phone,p.address,p.town,u.id as user ,orderno
                    FROM
                        stores s,                       
                        transactions t,
                        users u ,
                        persons p,
                        drugs d,
                        patientrefill pr
                            LEFT JOIN
                        drugprices dp ON  pr.drugid  = dp.drugid
                           LEFT JOIN orderitems oi ON oi.itemid = pr.id
                    WHERE
                        pr.id = t.orderid 
                           AND s.id = t.storeid
                            AND pr.drugid = d.id  
        AND u.personid = p.id 
        AND u.id = pr.patientid                
                            
        AND s.id = "'.$parArray[0].'" AND p.id = "'.$parArray[1].'" AND orderno="'.$parArray[2].'"

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


 function fetchConfirmRefillIds($storeid,$patientId,$itemsArr)
      { 

       $itemsArr = implode(',',$itemsArr);

       $query = $this->db->query('
            SELECT 
                pr.id,
                t.storeid,
                d.genericname,
                pr.refilldate,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,u.id as user,
                pr.price,
                pr.qty
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
                    AND pr.comments = "Ordered" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'" AND d.id IN ('.$itemsArr.')
        ');      
 
    return $query->result();
    }

  public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      return $this->db->update('patientrefill',$arrObject);
    }

  public function saveRecordDrugQty($arrObject,$id){        
      $this->db->where('drugid',$id);
      return $this->db->update('patientrefill',$arrObject);
    }

 public function getMaxOrder(){
     $query = $this->db->query('SELECT max(id) as max FROM orders   
       '); 
    return $query->result(); 
    } 

  public function getOrderTotals($storeid,$patientId,$itemsArr){
       
       $itemsArr = implode(',',$itemsArr);

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
                    AND pr.comments = "Ordered" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'" AND d.id IN ('.$itemsArr.')
        '); 

    return $query->result();

  }  

   public function getOrderTax($storeid,$patientId,$itemsArr){

      $itemsArr = implode(',',$itemsArr);
        
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
                    AND pr.comments = "Ordered" 
                     
        AND u.id = pr.patientid 
            AND s.id = "'.$storeid.'" AND d.id IN ('.$itemsArr.')
        '); 

    return $query->result();

  }  

    public function createOrder($arrObject){    

      $this->db->insert('orders', $arrObject);

      return $this->db->insert_id(); 

    }

    public function createOrderItems($arrObject){    

      $this->db->insert('orderitems', $arrObject);

     return $this->db->insert_id(); 

    }

    public function savePdfFile($arrObject,$id){        
      $this->db->where('orderno',$id);
     return $this->db->update('orders',$arrObject);
    } 

 
}