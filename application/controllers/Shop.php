<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	function __construct(){
	    parent::__construct();
            $this->load->model("users_model");
			$this->load->model("categories_model");
			$this->load->model("products_model");
			$this->load->model("transactions_model");

			// Pagination
			$this->load->library('pagination');

	    $styles = array(

			);

			$js = array(
				'assets/js/accounting.min.js',
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

	public function order($id)
    {
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		$this->template->load_sub('transaction', $this->transactions_model->getTransactionDetails($id));
		$this->template->set_title('Order - Casa Moda');
        $this->template->load('frontend/orderdetails');
	}

	public function orderSearch()
	{
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		$this->template->set_title('Order Search - Casa Moda');
		$this->template->load('frontend/orderhistory');
	}

	public function searchOrder()
	{
		echo json_encode($this->transactions_model->getSearchQuery($this->input->get('trans')));
     	exit();
	}

	public function checkout()
	{
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());
		$this->template->set_template('checkout');
		$this->template->set_title('Checkout - Casa Moda');
		$this->template->load('frontend/checkout');
	}

	public function cart()
	{
		$cartItems = array();
		$this->template->load_sub('categories', $this->categories_model->getAllCategories());

		$cartContents = $this->cart->contents();

		foreach ($cartContents as $items) {
			$cartItems[] = $this->products_model->getProductInfo($items['id']);
		}

		$this->template->load_sub('cartItems', $cartItems);
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

	public function checkoutCart()
	{
		$response = array();

		$this->form_validation->set_rules('first-name','First Name', 'required');
		$this->form_validation->set_rules('last-name','Last Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required|valid_email');
		$this->form_validation->set_rules('phone','Number', 'required|regex_match[^(09|\+639)\d{9}$^]',
          array('regex_match' => 'Please provide a valid %s <strong>ex: 09 or +639</strong>')
		);

		if ($this->form_validation->run() == FALSE) {
			$response = array(
				"messages" => validation_errors(),
				"success" => FALSE
			);
		}else{


			if ($this->cart->contents()) {

				$trans_no = $this->transactions_model->getTransNumber();

				$data = array(
					'transaction_no' => $trans_no,
					'firstname' => $this->input->post('first-name'),
					'lastname' => $this->input->post('last-name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'company-name' => $this->input->post('company-name'),
					'address' => $this->input->post('address'),
					'town_city' => $this->input->post('town-city'),
				);

				$res = $this->transactions_model->saveTransaction($data);

				if ($res) {
					
					foreach ( $this->cart->contents() as $items) {

						$itemInfo = array(
							'transaction_no' => $trans_no,
							'product_id' => $items['id'],
							'qty' => $items['qty'],
							'price' => $items['price'],
							'subtotal' => $items['subtotal'],
							'res_date' => $items['option']['date'],
						);

						$saveTrans = $this->transactions_model->saveTransactionDetails($itemInfo);

						if ($saveTrans) {

							$this->cart->destroy();
							$response = array(
								"url" => BASE_URL() . 'shop/order/' . $trans_no,
								"messages" => 'Transaction saved',
								"success" => TRUE
							);
							
						}else{
							$response = array(
								"messages" => 'Error saving transaction details',
								"success" => FALSE
							);
						}
						
					}

				}else{
					$response = array(
						"messages" => 'Error saving transactions',
						"success" => FALSE
					);
				}

			}else{
				$response = array(
					"messages" => 'No products found on cart',
					"success" => FALSE
				);
			}

		}

		echo json_encode($response);
     	exit();
		
	}

	public function add()
	{
		$response = array();
		$id = $this->input->post('id');
		$date = $this->input->post('date');
		$qty = ($this->input->post('qty')) ? $this->input->post('qty') : 1 ;

		$product = $this->products_model->getProductInfo($id);

		if ($product) {
			$data = array(
				'id' => $product->id,
				'qty' => $qty,
				'price' => $product->price,
				'name' => $product->name . '-' . $product->size_name,
				'option' => array(
					'size' => $product->size_id,
					'date' => $date,
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

	public function updatecart()
	{

		$response = array();
		$data = array(
			'rowid' => $this->input->post('rowid'),
			'qty'   => $this->input->post('qty')
		);
		
		$result = $this->cart->update($data);
		if ($result) {
			$response['success'] = TRUE;
		}else{
			$response['success'] = FALSE;
			$response['message'] = 'Error updating product on cart';
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

	public function getAvailableQty()
	{
		$response = array();
		$id = $this->input->get('id');
		$date = $this->input->get('date');

		$res = $this->transactions_model->getQty($id, $date);

		if ($res) {
			$response['availableQty'] = $res;
			$response['success'] = TRUE;
		}else{
			$response['success'] = FALSE;
		}

		echo json_encode($response);
		exit();	

	}


}

