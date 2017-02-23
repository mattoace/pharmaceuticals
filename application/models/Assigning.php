<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Assigning extends CI_Model {
 
    var $table = 'drugs drugs,drugprices dp';
    var $order = array('d.id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
  function getAssigned($drugcategory,$storeid)
    {

        $query = $this->db->query('
		SELECT 
		    d.id, d.genericname, dp.drugprice, dp.tax, c.categoryname
		FROM
		    stores s,
		    category c,
		    drugtocategory dc,
		    drugs d
		        LEFT JOIN
		    drugprices dp ON dp.drugid = d.id
		WHERE
		    dc.drugid = d.id AND s.id = dc.storeid
		        AND c.id = dc.categoryid
		        AND dc.categoryid = "'.$drugcategory.'"
		        AND s.id = "'.$storeid.'"

       '); 


        $column_order = array(null, 'd.genericname'); 
        $column_search = array('d.genericname'); 
        $order = array('d.genericname' => 'asc');        
 
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
 
    function count_filtered($drugcategory,$storeid)
    {    

        $query = $this->db->query('
		SELECT 
		    d.id, d.genericname, dp.drugprice, dp.tax, c.categoryname
		FROM
		    stores s,
		    category c,
		    drugtocategory dc,
		    drugs d
		        LEFT JOIN
		    drugprices dp ON dp.drugid = d.id
		WHERE
		    dc.drugid = d.id AND s.id = dc.storeid
		        AND c.id = dc.categoryid
		        AND dc.categoryid = "'.$drugcategory.'"
		        AND s.id = "'.$storeid.'"
       '); 

        return $query->num_rows();
    }
 
    public function count_all($drugcategory,$storeid)
    {
        $query = $this->db->query('
		SELECT 
		    d.id, d.genericname, dp.drugprice, dp.tax, c.categoryname
		FROM
		    stores s,
		    category c,
		    drugtocategory dc,
		    drugs d
		        LEFT JOIN
		    drugprices dp ON dp.drugid = d.id
		WHERE
		    dc.drugid = d.id AND s.id = dc.storeid
		        AND c.id = dc.categoryid
		        AND dc.categoryid = "'.$drugcategory.'"
		        AND s.id = "'.$storeid.'"
       '); 

        return   $query->num_rows();
    }






  function getDeAssigned($drugcategory,$storeid)
    {
        $query = $this->db->query('
			SELECT 
			    d.id, d.genericname, dp.drugprice, dp.tax
			FROM
			    drugs d
			        LEFT JOIN
			    drugprices dp ON dp.drugid = d.id
			WHERE
			    dp.storeid = "'.$storeid.'"
			        AND d.id NOT IN (SELECT 
			            CONCAT(drugid)
			        FROM
			            drugtocategory
			        WHERE
			            categoryid = "'.$drugcategory.'")
       '); 


        $column_order = array(null, 'd.genericname'); 
        $column_search = array('d.genericname'); 
        $order = array('d.genericname' => 'asc');        
 
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

    function count_filtered_de($drugcategory,$storeid)
    {    

        $query = $this->db->query('
			SELECT 
			    d.id, d.genericname, dp.drugprice, dp.tax
			FROM
			    drugs d
			        LEFT JOIN
			    drugprices dp ON dp.drugid = d.id
			WHERE
			    dp.storeid = "'.$storeid.'"
			        AND d.id NOT IN (SELECT 
			            CONCAT(drugid)
			        FROM
			            drugtocategory
			        WHERE
			            categoryid = "'.$drugcategory.'")
       '); 

        return $query->num_rows();
    }
 
    public function count_all_de($drugcategory,$storeid)
    {
        $query = $this->db->query('
			SELECT 
			    d.id, d.genericname, dp.drugprice, dp.tax
			FROM
			    drugs d
			        LEFT JOIN
			    drugprices dp ON dp.drugid = d.id
			WHERE
			    dp.storeid = "'.$storeid.'"
			        AND d.id NOT IN (SELECT 
			            CONCAT(drugid)
			        FROM
			            drugtocategory
			        WHERE
			            categoryid = "'.$drugcategory.'")
       '); 

        return   $query->num_rows();
    }


    public function clearcategory($drugid,$categoryid,$storeid){

        $query = $this->db->query('
        	DELETE FROM drugtocategory WHERE drugid = "'.$drugid.'" AND categoryid = "'.$categoryid.'" AND storeid= "'.$storeid.'"
       '); 

      return $query;
    }

    public function addNewCategory($arrObject){

      $this->db->insert('drugtocategory', $arrObject);

      return $this->db->insert_id();
    }
  
 
}