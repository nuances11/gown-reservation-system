<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	function __construct(){
	    parent::__construct();
            $this->load->model("users_model");
			$this->load->model("categories_model");
			$this->load->model("products_model");

			// Pagination
			$this->load->library('pagination');

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
		$this->template->load_sub('products', $this->products_model->getAllProducts());
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		
        $this->template->load('shop/index');
	}

	public function product()
	{
		$this->template->set_template('checkout');
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		
		$this->template->set_title('Product Details - Casa Moda');
		$this->template->load('frontend/productdetails');
	}

	public function order()
    {
		$this->template->set_title('Order - Casa Moda');
        $this->template->load('frontend/orderdetails');
	}

	public function orderhistory()
	{
		$this->template->set_title('Order History - Casa Moda');
		$this->template->load('frontend/orderhistory');
	}

	public function checkout()
	{
		$this->template->set_template('checkout');
		$this->template->set_title('Checkout - Casa Moda');
		$this->template->load('frontend/checkout');
	}

	public function cart()
	{
		$this->template->set_title('Cart - Casa Moda');
		$this->template->load('frontend/cart');
	}

}

