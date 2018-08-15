<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	function __construct(){
	    parent::__construct();
            $this->load->model("users_model");
			$this->load->model("categories_model");
			$this->load->model("products_model");

	    $styles = array(

			);

			$js = array(

			);

			$this->template->set_additional_css($styles);
			$this->template->set_additional_js($js);

	    //$this->_checkLogin();
	    $this->template->set_title('Shop - Casa Moda');
	    $this->template->set_template('shop');
    }

    public function index()
    {
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		$this->template->load_sub('products', $this->products_model->getAllProducts());
        $this->template->load('shop/index');
    }

}

