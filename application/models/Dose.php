<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dose extends CI_Model {
 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    } 
    

    public function addNew($arrObject){ 

      $this->db->query('DELETE FROM dose WHERE drugid = "'.$arrObject['drugid'].'" ');   

      $this->db->insert('dose', $arrObject);

    }

   public function fetchedit($id){     
        $this->db->select('dose.id,dose.dosename,dose.minimumdose,dose.maximumdose,dose.dose');
        $this->db->from('dose');
        $this->db->where('dose.drugid',$id);
        $query = $this->db->get();
        return $query;
    }

 
}