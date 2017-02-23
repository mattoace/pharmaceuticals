<?php
class Login extends CI_Model {

    var $id   = '';
    var $username = '';
    var $pass    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct(); 

    }  
  
    function login_check($array){
        $this->db->where($array); 
        $query = $this->db->get('users');
        return $query;
    }

    function get_all_items(){
        $query = $this->db->get('users', 1);
        return $query;
    }

}