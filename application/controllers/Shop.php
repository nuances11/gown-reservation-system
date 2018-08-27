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
				'assets/js/shop.js',
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

	public function product($id)
	{
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		
		$product = $this->products_model->getProductInfo($id);
		if($product){
			
			$this->template->set_title($product->name . ' | Casa Moda');

		}
		$this->template->load_sub('product', $product);
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

	public function category($id)
	{
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		$products = $this->categories_model->getCategoryProducts($id);
		$category = $this->categories_model->getCategoryInfo($id);
		if($products){
			
			$this->template->set_title($category->name . ' | Casa Moda');

		}
		$this->template->load_sub('products', $products);
		$this->template->load('frontend/category');
	}

	public function add()
	{
		$response = array();
		$id = $this->input->post('id');

		$product = $this->products_model->getProductInfo($id);

		if ($product) {
			$data = array(
				'id' => $product->id,
				'qty' => 1,
				'price' => $product->qty,
				'name' => $product->name,
				'option' => array(
					'size' => $product->size_id
				)
			);

			$result = $this->cart->insert($data);
			if ($result) {
				$response['success'] = TRUE;
				$response['message'] = $product->name . ' added to cart.';
			}else{
				$response['success'] = FALSE;
				$response['message'] = 'Error adding product to cart';
			}
		}else{
			$response['success'] = FALSE;
			$response['message'] = 'Product not found. Error on adding to cart';
		}

		echo json_encode($response);
     	exit();

	}

	public function getCartItems()
	{
		$response['totalCartItems'] = $this->cart->total_items();
		$response['items'] = $this->cart->contents();
		$response['total'] = $this->cart->format_number($this->cart->total());
		echo json_encode($response);
		exit();	
	}

	public function removeItem()
	{
		$response = array();
		$data = array(
			'rowid'   => $this->input->post('rowid'),
			'qty'     => 0
		);
		
		$result = $this->cart->update($data);
		if ($result) {
			$response['success'] = TRUE;
			$response['message'] = 'Product removed from cart';
		}else{
			$response['success'] = FALSE;
			$response['message'] = 'Error removing product on cart';
		}

		echo json_encode($response);
		exit();	
	}


}

