<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Patientrefill extends CI_Model {
 
    var $table = 'clinics';
    var $column_order = array(null, 'Clinic Name','Address','Location','Latitude','Longitude','Town'); //set column field database for datatable orderable
    var $column_search = array('Clinic Name','Address','Location','Latitude','Longitude','Town'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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

    function getPatientRefill($id)
    {

        $query = $this->db->query('
          SELECT 
                        concat(s.id,"_",d.id) as id,
                        t.storeid,
                        d.genericname as a,
                        SUBSTRING(d.genericname, 1,8) genericname,
                        dp.drugprice,
                        dp.tax,                        
                        SUBSTRING(s.storename, 1,8) storename,
                        s.address,
                        s.telephone,
                        DATE(pr.enddate) enddate,pr.description,DATE(pr.startdate) startdate,
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
                            AND pr.comments = "Invoiced" AND p.id = "'.$id.'" 
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

    public function fetchRefill($storeid,$drugid){

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
			                s.email,ds.dosename,ds.maximumdose,ds.minimumdose,ds.dose
			            FROM
			                stores s,
			                patientrefill pr,
			                transactions t,
			                drugs d
			                    LEFT JOIN
			                drugprices dp ON d.id = dp.drugid
			                LEFT JOIN dose ds ON  ds.drugid = d.id
			            WHERE
			                pr.id = t.orderid AND s.id = t.storeid
			                    AND pr.drugid = d.id
			                    AND d.id = "'.$drugid.'"
			                    AND pr.comments = "Invoiced" 
			            AND s.id = "'.$storeid.'"
			        '); 
			    return $query->result();


    }
 

 
}