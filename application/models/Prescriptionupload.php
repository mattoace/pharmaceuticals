<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Prescriptionupload extends CI_Model {
 

 
    var $table = 'prescriptionupload';
    var $column_order = array(null, 'uploadate','filename','path'); //set column field database for datatable orderable
    var $column_search = array('uploadate','filename','path'); //set column field database for datatable searchable 
   
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($patientid)
    {
        $this->db->select('prescriptionupload.id,prescriptionupload.uploadate,prescriptionupload.filename,prescriptionupload.path');
        $this->db->from('prescriptionupload');
        $this->db->join('users','users.id = prescriptionupload.patientid');
        $this->db->join('persons','persons.id = users.personid'); 
             
        $this->db->where('persons.id',$patientid);
        //var_dump($patientid); exit();
 
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
        }
    }
 
    function get_datatables($patientid)
    {
        $this->_get_datatables_query($patientid);
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

    public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      $this->db->update('prescriptionupload',$arrObject);
    } 

    public function fetchedit($id){     
        $this->db->select('*');
        $this->db->from('prescriptionupload');
        $this->db->where('prescriptionupload.id',$id);
        $query = $this->db->get();
        return $query;
    }

    public function fetchOrderedRefill($patientid)
      { 
       $query = $this->db->query('
            SELECT 
                d.id,
                t.storeid,
                d.genericname,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,
                pr.price,
                pr.qty,
                u.id as user
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
                    AND u.id = pr.patientid 
                    AND u.personid = "'.$patientid.'"
                    AND pr.description = "Awaiting order confirmation" AND pr.comments = "Ordered"                   
        '); 

    return $query->result();
    }


    public function fetchInvoiceRefill($patientid)
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
                pr.qty,
                u.id as user
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
                    AND u.id = pr.patientid 
                    AND u.personid = "'.$patientid.'"
                    AND pr.description = "Awaiting order confirmation" AND pr.comments = "Ordered"                   
        '); 

    return $query->result();
    }

   public function saveRecordPatientOrderQty($arrObject,$id){        
      $this->db->where('id',$id);
       $this->db->update('patientrefill',$arrObject);
       return  null;
    }



    public function getInvoiceTotals($storeid,$patientId,$type){       
     
      
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
                    AND pr.description = "Awaiting order confirmation" AND pr.comments = "Ordered"                       
        AND u.id = pr.patientid 
          
        '); 

    return $query->result();

  }  

 public function getInvoiceTax($storeid,$patientId,$type){      

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
                  AND pr.description = "Awaiting order confirmation" AND pr.comments = "Ordered"                       
        AND u.id = pr.patientid 
        
        '); 

    return $query->result();

  }   

 
}