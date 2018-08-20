<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    function __construct(){
	    parent::__construct();
           

			// Pagination
			$this->load->library('pagination');

	    $styles = array(

			);

			$js = array(

			);

			$this->template->set_additional_css($styles);
			$this->template->set_additional_js($js);

	    //$this->_checkLogin();
	    $this->template->set_title('About - Casa Moda');
	    $this->template->set_template('shop');
    }

    public function index()
    {
		
        $this->template->load('frontend/about');
	}


}
