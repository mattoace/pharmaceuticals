<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Patientbill extends CI_Model {
 

 
    var $table = 'patientbill';
    var $column_order = array(null, 'orderid','billingdate','amount'); //set column field database for datatable orderable
    var $column_search = array('orderid','billingdate','amount'); //set column field database for datatable searchable 
   
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($patientid)
    {
        $this->db->select('*');
        $this->db->from('patientbill');
        $this->db->where('patientbill.patientid',$patientid);
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

    public function addNew($arrObject,$id){ 

      $this->db->query('DELETE FROM patientbill WHERE id = "'.$id.'" ');   

      $this->db->insert('patientbill', $arrObject);

      return $this->db->insert_id(); 

    }

   public function fetchedit($id){     
        $this->db->select('*');
        $this->db->from('patientbill');
        $this->db->where('patientbill.id',$id);
        $query = $this->db->get();
        return $query;
    }

   public function fetchTotals($id){     
        $this->db->select('sum(amount) as total');
        $this->db->from('patientbill');
        $this->db->where('patientbill.patientid',$id);
        $query = $this->db->get();
        return $query;
    }

  public function deleteRecord($id){
      $this->db->where('id', $id);
      $this->db->delete('patientbill'); 
    }
 
}