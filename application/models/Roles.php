<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Roles extends CI_Model {
 
    var $table = 'stores';
    var $column_order = array(null, 'Storename','Telephone','Email','Location','Latitude','Longitude','Additional services','Comments'); //set column field database for datatable orderable
    var $column_search = array('Storename','Telephone','Email','Location','Latitude','Longitude','Additional services','Comments'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    private function _get_datatables_query($id)
    {
         
        //$this->db->from($this->table);
        $this->db->select(' stores.* ');
        $this->db->from('stores');
        $this->db->join('userpharm','userpharm.pharmacyid = stores.id');
        $this->db->where('userpharm.userid',$id);
 
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
 
    function get_datatables($id)
    {
        $this->_get_datatables_query($id);
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


 
      function getMain()
        { 
           $query = $this->db->query('
             SELECT id,menuname FROM menu WHERE parentid IS NULL
            '); 
        return $query->result();
        }

        function getSubMenus($id){
         $query = $this->db->query('
             SELECT id,menuname FROM menu WHERE parentid = "'.$id.'"
            '); 
        return $query->result();
        }

       function clearRoles($userid)
        { 
           $query = $this->db->query('
             DELETE FROM roles WHERE userid = "'.$userid.'"
            '); 
        return $query;
        }

      public function addNew($arrObject){    

          return $this->db->insert('roles', $arrObject);

        }
        public function getSavedRoles($userid){

           $query = $this->db->query('
             SELECT * FROM roles WHERE userid = "'.$userid.'"
            '); 
         return $query->result();

        }


     public function clearpharmacyassigned($userid){
        $query = $this->db->query('
          DELETE FROM userpharm WHERE userid = "'.$userid.'"
       '); 

      return $query;
    }

    public function clearpharmacydeassigned($pharmacyid,$userid){
      $query = $this->db->query('DELETE FROM userpharm WHERE userid = "'.$userid.'" AND pharmacyid = "'.$pharmacyid.'"');      
      return $query;

    }

    public function assignPharmacy($arrObject){

      $this->db->insert('userpharm', $arrObject);

      return $this->db->insert_id();
    }
 
 
}