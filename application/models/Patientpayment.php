<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Patientpayment extends CI_Model {
 

 
    var $table = 'patientpayment';
    var $column_order = array(null, 'billid','paymentdate','amount'); //set column field database for datatable orderable
    var $column_search = array('billid','paymentdate','amount'); //set column field database for datatable searchable 
   
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($patientid)
    {
        $this->db->select('*');
        $this->db->from('patientpayment');
        $this->db->where('patientpayment.patientid',$patientid);
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

      $this->db->query('DELETE FROM patientpayment WHERE id = "'.$id.'" ');   

      $this->db->insert('patientpayment', $arrObject);

      return $this->db->insert_id(); 

    }

 public function addNewPayTransaction($arrObject,$id){      

      $this->db->insert('patientpayment', $arrObject);

      return $this->db->insert_id(); 
    }

  public function updateTransaction($invoice,$coments,$ret_val){

       $query = $this->db->query('
            SELECT 
                pr.id
            FROM
                invoiceitems ii,
                patientrefill pr
            WHERE
                ii.itemid = pr.id
                    AND ii.invoiceno = "'.$invoice.'"
        '); 

     $resultsArray = $query->result();

     foreach ($resultsArray as $key => $prItems) {
         $prIds[] = $prItems->id;
     }

      $updateIds = implode(",",$prIds);

    //$ret_val[1]["response"] = 'UPDATE patientrefill SET description = "Paid" , comments = "'.$coments.'" WHERE id IN ('.$updateIds.')';

     $this->db->query('UPDATE patientrefill SET description = "Paid" , comments = "'.$coments.'" WHERE id IN ('.$updateIds.')');

    return $ret_val;


  }  

   public function fetchedit($id){     
        $this->db->select('*');
        $this->db->from('patientpayment');
        $this->db->where('patientpayment.id',$id);
        $query = $this->db->get();
        return $query;
    }

   public function fetchTotals($id){     
        $this->db->select('sum(amount) as total');
        $this->db->from('patientpayment');
        $this->db->where('patientpayment.patientid',$id);
        $query = $this->db->get();
        return $query;
    }

  public function deleteRecord($id){
      $this->db->where('id', $id);
      $this->db->delete('patientpayment'); 
    }

  public function addPayLog($arrObject){

    $this->db->insert('paymentlog', $arrObject);


  }  
 
}