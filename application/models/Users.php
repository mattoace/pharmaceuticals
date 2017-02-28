<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Model { 
    
    var $table = 'users';
    var $column_order = array(null, 'username','pass','personid'); //set column field database for datatable orderable
    var $column_search = array('username','pass','personid'); //set column field database for datatable searchable 
    var $order = array('users.id' => 'asc'); // default order 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
   private function _get_datatables_query()
    {   

        $this->db->select('users.id,persons.firstname,persons.secondname,persons.email,persons.phone,users.username,users.pass,users.type,users.isactive,persons.img');
        $this->db->from('users');
        $this->db->join('persons','users.personid = persons.id');  
 
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

      $this->db->insert('persons', $arrObject);
      return $this->db->insert_id();  
    }

   public function addNewUser($arrObject){   

      $this->db->insert('users', $arrObject);
      return $this->db->insert_id();  
    }

  public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      $this->db->update('users',$arrObject);
    } 

 public function savePersonRecord($arrObject,$id){        
      $this->db->where('personid',$id);
      $this->db->update('users',$arrObject);
    } 

 public function fetchRecord($id){

        $this->db->select('persons.id,persons.initial,persons.firstname,persons.secondname,persons.surname,persons.phone,persons.email,persons.address,persons.phone,persons.email,persons.town,users.pass,users.type,users.isactive');
        $this->db->from('persons');
        $this->db->join('users','users.personid = persons.id'); 
        $this->db->where('users.id',$id);
        $query = $this->db->get();
       return $query->result();
    } 

 public function fetchUser($email){

        $this->db->select('persons.id,persons.initial,persons.firstname,persons.secondname,persons.surname,persons.phone,persons.email,persons.address,persons.phone,persons.email,persons.town');
        $this->db->from('persons');
        $this->db->join('users','users.personid = persons.id'); 
        $this->db->where('users.username',$email);
        $query = $this->db->get();
       return $query->result();
    } 


 public function fetchUid($id){

        $this->db->select('users.id,persons.initial,persons.firstname,persons.secondname,persons.surname,persons.phone,persons.email,persons.address,persons.phone,persons.email,persons.town');
        $this->db->from('persons');
        $this->db->join('users','users.personid = persons.id'); 
        $this->db->where('users.personid',$id);
        $query = $this->db->get();
       return $query->result();
    } 

 public function fetchDefaultCompany(){
        $this->db->select('*');
        $this->db->from('default');      
        $query = $this->db->get();
       return $query->result();
    } 

 public function deleteRecord($id){


        $this->db->select('users.personid');
        $this->db->from('users');
        $this->db->join('persons','users.personid = persons.id'); 
        $this->db->where('users.id',$id);
        $query = $this->db->get();

        $assoc = $query->result();

        $personid = $assoc[0]->personid;    

        $this->db->where('id', $id);
        $this->db->delete('users'); 
        $this->db->where('id', $personid);
        $this->db->delete('persons'); 
    }
 
}