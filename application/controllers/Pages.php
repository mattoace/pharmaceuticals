<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	public function view($page = 'index')
	{
            $this->load->database();
            $this->load->helper('url');
            if ( ! file_exists(APPPATH.'/views/frontend/'.$page.'.php'))
              {              
                  show_404();
              }
            $data['title'] = ucfirst($page);
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/'.$page, $data);
            $this->load->view('frontend/footer', $data);
	}   


  public function fullview($page = 'index')
  {
            $this->load->database();
            $this->load->helper('url');
            if ( ! file_exists(APPPATH.'/views/frontend/'.$page.'.php'))
              {              
                  show_404();
              }
            $data['title'] = ucfirst($page);
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/'.$page, $data);
            //$this->load->view('frontend/footer', $data);
  }       
         
        
 
        
        public function back($page = 'index')
    	{
                $this->load->database();
                $this->load->helper('url');
                if ( ! file_exists(APPPATH.'/views/backend/'.$page.'.php'))
                  {              
                      show_404();
                  }
                $data['title'] = ucfirst($page);
                $this->load->view('backend/header', $data);
                $this->load->view('backend/'.$page, $data);
                $this->load->view('backend/footer', $data);
    	}
	

          public function fullpage($page = 'index')
      {
                $this->load->database();
                $this->load->helper('url');
                if ( ! file_exists(APPPATH.'/views/backend/'.$page.'.php'))
                  {              
                      show_404();
                  }
                $data['title'] = ucfirst($page);    
                $this->load->view('backend/'.$page, $data);
         
      }

        
        
}
