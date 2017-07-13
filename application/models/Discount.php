<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Discount extends CI_Model {
 
    var $table = 'coupon';
    var $column_order = array(null, 'code','amount'); //set column field database for datatable orderable
    var $column_search = array('code','amount'); //set column field database for datatable searchable 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    } 
    

  private function _get_datatables_query($drugid)
    {
        $this->db->select('*');
        $this->db->from('coupon');
        //$this->db->where('coupon.drugid',$drugid);
        //$this->db->from($this->table);
 
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

    public function addNew($arrObject){ 

      $this->db->query('DELETE FROM discount WHERE drugid = "'.$arrObject['drugid'].'" ');   

      $this->db->insert('discount', $arrObject);

    }

    public function addNewCoupon($arrObject){         

      $this->db->insert('coupon', $arrObject);

    }

    public function clearCoupon($drugid){ 

      $this->db->query('DELETE FROM coupon');  

    }

   public function fetchedit($id){     
        $this->db->select('discount.id,discount.qty,discount.amount,discount.drugid');
        $this->db->from('discount');
        $this->db->where('discount.drugid',$id);
        $query = $this->db->get();
        return $query;
    }

 
}