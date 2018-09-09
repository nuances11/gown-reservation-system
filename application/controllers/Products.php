<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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
	    $this->template->set_title('Admin - Produts');
	    $this->template->set_template('admin');
    }

    public function index()
	{

		$styles = array(
				'assets/css/dataTables.bootstrap.min.css',
		);

		$js = array(
				'assets/js/jquery.dataTables.min.js',
				'assets/js/dataTables.bootstrap.min.js',
				'assets/js/application.js',
		);

		$this->template->set_additional_css($styles);
		$this->template->set_additional_js($js);

    
    $this->template->set_title('Admin - Products');
    $this->template->set_template('admin');

    $this->template->load_sub('sizes', $this->products_model->getSizes());
    $this->template->load_sub('categories', $this->categories_model->getAllCategories());
    $this->template->load('products/index');
  }

    /**

    * Create from display on this method.

    *

    * @return Response

   */

   public function Datatable()
   {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->products_model->getProducts();

        $data = [];

        foreach($query->result() as $r) {

            $created = date('F jS Y h:i:sa', strtotime($r->created_at));
            $delete_btn = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnProductDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>';
            // $edit_btn = ($r->id != 1) ? '<a href="javascript:void(0);" id="btnUserDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>' : '' ;
            $action = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnProductEdit"><i class="fa fa-fw fa-edit"></i> Edit</a>  ' . $delete_btn;
            $category = $r->catname;
            $available = ($r->is_available) ? 'Available' : 'Unavailable' ;

            $data[] = array(

                $r->id,
                $r->name,
                $category,
                $created,
                $available,
                $action

           );

      }

        $result = array(

            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data

        );

      echo json_encode($result);
      exit();

    }

    public function save()
    {
        $response = array();

        if ($_FILES['product_img']['size'] == 0 && $_FILES['product_img']['error'] == 4) {
            $response['product_image'] = 'Product Image Required';
            $response['success'] = FALSE;
        }
        
        $this->form_validation->set_rules('name','Name', 'required|is_unique[products.name]');
        $this->form_validation->set_rules('price','Price', 'required|numeric');
        $this->form_validation->set_rules('category','Category', 'required|numeric');
        $this->form_validation->set_rules('description','Description', 'required');
        $this->form_validation->set_rules('qty','Quantity', 'numeric');
        $this->form_validation->set_rules('size','Size', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{

            $target_dir = "uploads/img/products/";
            $file_name = basename($_FILES["product_img"]["name"]);
            $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
            // // Check if image file is a actual image or fake image
            // $check = getimagesize($_FILES["product_img"]["tmp_name"]);
            // if($check !== false) {
            //     $response['image_size'] = "File is an image - " . $check["mime"];
            //     $uploadOk = 1;
            // } else {
            //     $response['image_size'] = "File is not an image.";
            //     $uploadOk = 0;
            // }

            // Check file size
            if ($_FILES["product_img"]["size"] > 5000000) {
                $response['size'] = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $response['format'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $response['upload'] = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            }else{
                
                if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {

                    $data = array(
                        'name' => $this->input->post('name'),
                        'image' => $file_name,
                        'price' => $this->input->post('price'),
                        'category_id' => $this->input->post('category'),
                        'description' => $this->input->post('description'),
                        'is_available' => $this->input->post('is_available'),
                        'size_id' => $this->input->post('size'),
                        'qty' => $this->input->post('qty'),

                    );

                    $res = $this->products_model->saveProduct($data);
                    if ($res) {
                        $response['message'] = 'Product Created Successfully';
                        $response['success'] = TRUE;
                    }else{
                        $response['message'] = 'Error on creating produt';
                        $response['success'] = FALSE;
                    }

                }
                else{
                    $response['upload_error'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        echo json_encode($response);
        exit;
    }

    /**

    * Show Category details on this method.

    *

    * @return Response

   */

    public function edit()
    {
            $response = array();
            $id = $this->input->get('id');

            $data = $this->products_model->getProductInfo($id);
            if ($data) {
                $response['product'] = $data;
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error getting product data';
                $response['success'] = FALSE;
            }

            echo json_encode($response);
            exit;
    }

    /**

    * Update User details on this method.

    *

    * @return Response

   */

    public function update()
    {

        $response = array();
        $id = $this->input->post('product_id');

        $this->form_validation->set_rules('name','Name', 'required');
        $this->form_validation->set_rules('price','Price', 'required|numeric');
        $this->form_validation->set_rules('category','Category', 'required|numeric');
        $this->form_validation->set_rules('description','Description', 'required');
        $this->form_validation->set_rules('qty','Quantity', 'numeric');
        $this->form_validation->set_rules('size','Size', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{

            $file_name = '';

            $target_dir = "uploads/img/products/";
            $file_name = basename($_FILES["product_img"]["name"]);
            $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if ($_FILES['product_img']['size'] == 0 && $_FILES['product_img']['error'] == 4)
            {
                $file_name = $this->input->post('image_file');

                $data = array(
                    'name' => $this->input->post('name'),
                    'image' => $file_name,
                    'price' => $this->input->post('price'),
                    'category_id' => $this->input->post('category'),
                    'description' => $this->input->post('description'),
                    'is_available' => $this->input->post('is_available'),
                    'size_id' => $this->input->post('size'),
                    'qty' => $this->input->post('qty'),
                );
    
                $res = $this->products_model->updateProduct($id, $data);
                if ($res) {
                    $response['message'] = 'Product Updated Successfully';
                    $response['success'] = TRUE;
                }else{
                    $response['message'] = 'Error on updating produt';
                    $response['success'] = FALSE;
                }

                
            }else{
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["product_img"]["tmp_name"]);
                if($check !== false) {
                    $response['image_size'] = "File is an image - " . $check["mime"];
                    $uploadOk = 1;
                } else {
                    $response['image_size'] = "File is not an image.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["product_img"]["size"] > 5000000) {
                    $response['size'] = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $response['format'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $response['upload'] = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                }else{
        
                    if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {

                        $data = array(
                            'name' => $this->input->post('name'),
                            'image' => $file_name,
                            'price' => $this->input->post('price'),
                            'category_id' => $this->input->post('category'),
                            'description' => $this->input->post('description'),
                            'is_available' => $this->input->post('is_available'),
                            'size_id' => $this->input->post('size'),
                            'qty' => $this->input->post('qty'),
                        );
            
                        $res = $this->products_model->updateProduct($id, $data);
                        if ($res) {
                            $response['message'] = 'Product Updated Successfully';
                            $response['success'] = TRUE;
                        }else{
                            $response['message'] = 'Error on updating produt';
                            $response['success'] = FALSE;
                        }

                    }else{
                        $response['upload_error'] = "Sorry, there was an error uploading your file.";
                    }   
                }
            }      
        }

        echo json_encode($response);
        exit;

    }

    public function delete()
    {
        $response = array();

        $id = $this->input->post('id');

        $res = $this->products_model->delete_product($id);

        if ($res) {
            $response['success'] = TRUE;
            $response['message'] = 'Product Deleted';
        }else{
            $response['success'] = FALSE;
            $response['message'] = 'Cannot delete product, it is currently under a transaction process';
        }

        echo json_encode($response);
        exit;
    }

}

