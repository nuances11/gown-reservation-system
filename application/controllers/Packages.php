<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends CI_Controller {

	function __construct(){
	    parent::__construct();
            $this->load->model("users_model");
            $this->load->model("categories_model");
            $this->load->model("packages_model");

	    $styles = array(

			);

			$js = array(

			);

			$this->template->set_additional_css($styles);
			$this->template->set_additional_js($js);

	    //$this->_checkLogin();
	    $this->template->set_title('Admin - Packages');
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

    //$this->_checkLogin();
    $this->template->set_title('Admin - Packages');
    $this->template->set_template('admin');

    $this->template->load('package/index');
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

        $query = $this->packages_model->getPackages();

        $data = [];

        foreach($query->result() as $r) {

            $finalPrice = number_format($r->price,2);
            $created = date('F jS Y h:i:sa', strtotime($r->created_at));
            $delete_btn = '<a href="javascript:void(0);" data-id="' . $r->package_number . '" class="btnPackageDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>';
            // $edit_btn = ($r->id != 1) ? '<a href="javascript:void(0);" id="btnUserDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>' : '' ;
            $action = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnPackageEdit"><i class="fa fa-fw fa-edit"></i> Edit</a>  ' . $delete_btn;

            $data[] = array(

                $r->id,
                $r->name,
                $r->package_description,
                $finalPrice,
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

    /**

    * Create category on this method.

    *

    * @return Response

   */

    public function save()
    {
        $response = array();

        if ($_FILES['package_img']['size'] == 0 && $_FILES['package_img']['error'] == 4) {
            $response['package_image'] = 'Package Image Required';
            $response['success'] = FALSE;
        }

        $this->form_validation->set_rules('name','Name', 'required|is_unique[package.name]');
        $this->form_validation->set_rules('price','Price', 'required|is_numeric');
        $this->form_validation->set_rules('package_description','Description', 'required');
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{

            $target_dir = "uploads/img/packages/";
            $file_name = basename($_FILES["package_img"]["name"]);
            $target_file = $target_dir . basename($_FILES["package_img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check file size
            if ($_FILES["package_img"]["size"] > 5000000) {
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
                if (move_uploaded_file($_FILES["package_img"]["tmp_name"], $target_file)) {

                    $package_number = $this->packages_model->getPackageNumber();

                    $data = array(
                        'image' => $file_name,
                        'package_number' => $package_number,
                        'name' => $this->input->post('name'),
                        'package_description' => $this->input->post('package_description'),
                        'price' => $this->input->post('price'),
                        'is_available' => $this->input->post('is_available'),
                    );
        
                    $res = $this->packages_model->savePackage($data);
                    if ($res) {
                        $response['message'] = 'Package Created Successfully';
                        $response['success'] = TRUE;
                    }else{
                        $response['message'] = 'Error on creating package';
                        $response['success'] = FALSE;
                    }
                }else{
                    $response['upload_error'] = "Sorry, there was an error uploading your file.";
                }
            }  
        }

        echo json_encode($response);
        exit;
    }

    /**

    * Show Package details on this method.

    *

    * @return Response

   */

    public function edit()
    {
            $response = array();
            $id = $this->input->get('id');

            $data = $this->packages_model->getPackageInfo($id);
            if ($data) {
                $response['package'] = $data;
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error getting package data';
                $response['success'] = FALSE;
            }

            echo json_encode($response);
            exit;
    }

    /**

    * Update Package details on this method.

    *

    * @return Response

   */

  public function update()
  {

    $response = array();
    $id = $this->input->post('package_id');

    $this->form_validation->set_rules('name','Name', 'required');
    $this->form_validation->set_rules('price','Price', 'required|is_numeric');
    $this->form_validation->set_rules('package_description','Description', 'required');  
      
    if ($this->form_validation->run() == FALSE) {

        $response['validation_errors'] = validation_errors();
        $response['success'] = FALSE;

    }else{

        $file_name = '';

        $target_dir = "uploads/img/packages/";
        $file_name = basename($_FILES["package_img"]["name"]);
        $target_file = $target_dir . basename($_FILES["package_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if ($_FILES['package_img']['size'] == 0 && $_FILES['package_img']['error'] == 4)
        {
            $file_name = $this->input->post('image_file');

            $data = array(
                'image' => $file_name,
                'name' => $this->input->post('name'),
                'package_description' => $this->input->post('package_description'),
                'price' => $this->input->post('price'),
                'is_available' => $this->input->post('is_available'),
            );
    
            $res = $this->packages_model->updatePackage($id, $data);
    
            if ($res) {
                $response['message'] = 'Package Updated Successfully';
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error on updating package';
                $response['success'] = FALSE;
            }
        }else{

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["package_img"]["tmp_name"]);
            if($check !== false) {
                $response['image_size'] = "File is an image - " . $check["mime"];
                $uploadOk = 1;
            } else {
                $response['image_size'] = "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["package_img"]["size"] > 5000000) {
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
                if (move_uploaded_file($_FILES["package_img"]["tmp_name"], $target_file)) {
                    $data = array(
                        'image' => $file_name,
                        'name' => $this->input->post('name'),
                        'package_description' => $this->input->post('package_description'),
                        'price' => $this->input->post('price'),
                        'is_available' => $this->input->post('is_available'),
                    );
            
                    $res = $this->packages_model->updatePackage($id, $data);
            
                    if ($res) {
                        $response['message'] = 'Package Updated Successfully';
                        $response['success'] = TRUE;
                    }else{
                        $response['message'] = 'Error on updating package';
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

        $res = $this->packages_model->delete_package($id);

        if ($res) {
            $response['success'] = TRUE;
            $response['message'] = 'Package Deleted';
        }else{
            $response['success'] = FALSE;
            $response['message'] = 'Cannot delete package, it is currently under a transaction process';
        }

        echo json_encode($response);
        exit;
    }

}

