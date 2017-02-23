<?php
class Cds extends CI_Model {

    var $id   = '';
    var $jahr = '';
    var $interpret    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct(); 

    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('cds', 10);
        return $query->result();
    }


    function insert_entry()
    {
        $this->jahr   = $_POST['jahr']; // please read the below note
        $this->interpret = $_POST['interpret'];      

        $this->db->insert('cds', $this);
    }

    function update_entry()
    {
        $this->jahr   = $_POST['jahr'];
        $this->interpret = $_POST['interpret'];   

        $this->db->update('cds', $this, array('id' => $_POST['id']));
    }

    function get_all_items(){
        $query = $this->db->get('cds', 1);
        return $query;
    }

}