<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Banners extends CI_Model { 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

   public function addImages($arrObject){ 
      $this->db->insert('bannerimages', $arrObject);
      return $this->db->insert_id();
    }

   public function getImageList($id){

      $query = $this->db->query('

       SELECT * FROM bannerimages WHERE parent = "'.$id.'"
       '); 
       
       return $query->result();
    }

   public function fetchFiles($Id){   

        $this->db->select(' * ');

        $this->db->from('bannerimages');  

        $this->db->where('parent',$Id);   

        $column_order = array(null, 'bannerimages.id','bannerimages.img'); 
        $column_search = array('bannerimages.id','bannerimages.img'); 
        $order = array('bannerimages.id' => 'asc');        
 
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
        $query = $this->db->get();
        return $query->result();

   }

   function count_filtered_img()
    {
        $this->db->select(' * ');

        $this->db->from('bannerimages'); 

        $query = $this->db->get();
        return $query->num_rows();
        exit();
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_img()
    {    

        $this->db->select(' * ');

        $this->db->from('bannerimages');   

        return $this->db->count_all_results();
    }

  public function fetchFile($drugId){ 

        $this->db->select(' * ');

        $this->db->from('bannerimages');  

        $this->db->where('id',$drugId);   

        $query = $this->db->get();

        return $query->result();
  }

    public function deleteFile($id){

     $this->db->select(' * ');

     $this->db->from('bannerimages');

     $this->db->where('id',$id);

     $query = $this->db->get();

     $row = $query->result();

     unlink($row[0]->img); 

     $this->db->where('id', $id);

     $response = $this->db->delete('bannerimages'); 

     return $response;
   } 






}
 
?>