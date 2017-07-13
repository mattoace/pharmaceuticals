<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Model {

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 

  function fetchSalesGrapgh($storeid,$patientId,$type)
      {    

       $query = $this->db->query('
           SELECT 
                pr.id,
                t.storeid,
                d.genericname,
                dp.drugprice,
                dp.tax,
                s.storename,
                s.address,
                s.telephone,
                s.email,u.id as user,
               count(*) as cnt,
               Date(pr.refilldate) as refilldate
            FROM
                stores s,
                patientrefill pr,
                transactions t,users u,
                drugs d
                    LEFT JOIN
                drugprices dp ON d.id = dp.drugid
            WHERE
                pr.id = t.orderid AND s.id = t.storeid
                    AND pr.drugid = d.id
              
                    AND pr.description = "Invoice sent" 
                     
        AND u.id = pr.patientid 
GROUP BY s.id , Date(pr.refilldate)
        '); 
 
    return $query->result();
    }

 
}