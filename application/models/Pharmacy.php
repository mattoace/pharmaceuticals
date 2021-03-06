<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pharmacy extends CI_Model {
 
    var $table = 'stores';
    var $column_order = array(null, 'Storename','Telephone','Email','Location','Latitude','Longitude','Additional services','Comments'); //set column field database for datatable orderable
    var $column_search = array('Storename','Telephone','Email','Location','Latitude','Longitude','Additional services','Comments'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 
 
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

      $this->db->insert('stores', $arrObject);

    }

    public function fetchedit($id){
          $this->db->where('id', $id); 
          $query = $this->db->get('stores');  
        return $query;

    }

    public function saveRecord($arrObject,$id){        
      $this->db->where('id',$id);
      $this->db->update('stores',$arrObject);
    } 

    public function get_all_items(){
        $query = $this->db->get('stores');
        return $query;
    }

    public function deleteRecord($id){
      $this->db->where('id', $id);
      $this->db->delete('stores'); 
    }


    public function autoFill($Parameter){
       $query = $this->db->query('

        SELECT 

        stores.id,stores.storename,stores.location,stores.latitude,stores.longitude,stores.additionalservices,stores.comments,stores.address,stores.telephone,stores.email ,IF(stores.img IS NOT NULL ,concat("http://tibamoja.co.ke/",stores.img),"http://tibamoja.co.ke/assets/img/pharmacy1.jpg")  img 

        FROM stores 

        WHERE LOWER(stores.storename) LIKE "%'.$Parameter .'%"   

        UNION

        SELECT 

        clinic.id,clinic.clinicname as storename,clinic.location,clinic.latitude,clinic.longitude,"additionalservices","comments",clinic.address,clinic.telephone,clinic.email ,IF(clinic.img IS NOT NULL ,concat("http://tibamoja.co.ke/",clinic.img),"http://tibamoja.co.ke/assets/img/pharmacy1.jpg")  img 

        FROM clinics clinic 

        WHERE LOWER(clinic.clinicname) LIKE "%'.$Parameter .'%"  

       '); 

    return $query->result();

    }
 
}