<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Cat extends CI_Model {
 
    var $table = 'category';
    var $column_order = array(null, 'categoryname','description'); //set column field database for datatable orderable
    var $column_search = array('categoryname','description'); //set column field database for datatable searchable 
    var $order = array('categoryname' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
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

      $this->db->insert('category', $arrObject);

      return $this->db->insert_id(); 
    }

    public function fetchedit($id){
          $this->db->where('id', $id); 
          $query = $this->db->get('category');  
        return $query;

    }

    public function get_all_items($is_service){      
        /*$this->db->from('category');
        $this->db->order_by("categoryname", "asc");
        if($is_service){
            $this->db->where('parent IS NOT NULL');

            $this->db->where('categoryname !=','My Prescriptions');
            $this->db->where('categoryname !=','My Invoices');
            $this->db->where('categoryname !=','My Orders');
            $this->db->where('categoryname !=','Go to Home');
            $this->db->where('categoryname !=','Logout');        
        }
        $query = $this->db->get();  */

       $query = $this->db->query('
            SELECT group_concat( id) as id, "Medicine" as categoryname  FROM category WHERE  id  in  (495,496) group by ""
            UNION
            SELECT group_concat( id) as id, categoryname FROM category WHERE id = 497  group by ""
            UNION
            SELECT group_concat( id) as id, "Baby Care and Nutrition"  FROM category WHERE id  in  (502,504) group by ""
            UNION
            SELECT group_concat( id) as id, categoryname FROM category WHERE id = 505  group by ""
            UNION
            SELECT group_concat( id) as id, categoryname FROM category WHERE id = 511  group by ""
            UNION
            SELECT group_concat( id) as id, categoryname FROM category WHERE id = 512  group by ""
       '); 
       
        return $query;
    }


     public function get_all_items_main($is_service){      
        $this->db->from('category');
        $this->db->order_by("categoryname", "asc");
        if($is_service){
            $this->db->where('parent IS NULL');

            $this->db->where('categoryname !=','My Prescriptions');
            $this->db->where('categoryname !=','My Invoices');
            $this->db->where('categoryname !=','My Orders');        
        }
        $query = $this->db->get(); 
        return $query;
    }

    public function get_all_items_child($is_service ,$id){      
        $this->db->from('category');
        $this->db->order_by("categoryname", "asc");
        if($is_service){
            $this->db->where('parent', $id);
            $this->db->where('categoryname !=','My Prescriptions');
            $this->db->where('categoryname !=','My Invoices');
            $this->db->where('categoryname !=','My Orders');        
        }
        $query = $this->db->get(); 
        return $query;
    }


    public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      $this->db->update('category',$arrObject);
    } 

    public function deleteRecord($id){
      $this->db->where('id', $id);
      $this->db->delete('category'); 
    }


 function getParentCategories()
      {       

       $query = $this->db->query('
           SELECT * FROM category WHERE parent IS NULL
        ');     
 
    return $query->result();
    }
function getChildCategories($parent)
      {       

       $query = $this->db->query('
           SELECT * FROM category WHERE parent  = "'.$parent.'"
        ');     
 
    return $query->result();
    }

public function deleteAllRecord(){
    $this->db->where('id', $id);
    $this->db->delete('category'); 
    $this->db->where('parent', $id);
    $this->db->delete('category'); 
    } 
}