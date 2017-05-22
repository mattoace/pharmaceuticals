<?php
class Login extends CI_Model {

    var $id   = '';
    var $username = '';
    var $pass    = '';

    function __construct()
    {
        //Call the Model constructor
        parent::__construct(); 
    }  
  
    function login_check($array){   

        $this->db->select('users.id,users.username,users.pass ,persons.initial,persons.firstname,persons.secondname,persons.surname,persons.phone,persons.email,persons.address,persons.town,users.pass,users.type,users.isactive,concat("http://tibamoja.co.ke/",persons.img) as img,persons.homelat,persons.homelon,persons.worklat,persons.worklon');
        $this->db->from('persons');
        $this->db->join('users','users.personid = persons.id'); 
        $this->db->where($array); 
        $query = $this->db->get();
        //var_dump($this->db->last_query()); exit();
     return $query;    
    }

    function get_all_items(){
        $query = $this->db->get('users', 1);
        return $query;
    }

}