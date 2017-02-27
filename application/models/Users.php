<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Model { 

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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

 public function fetchRecord($id){

        $this->db->select('persons.id,persons.initial,persons.firstname,persons.secondname,persons.surname,persons.phone,persons.email,persons.address,persons.phone,persons.email,persons.town');
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
 
}