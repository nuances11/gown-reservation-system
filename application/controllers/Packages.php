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
            $delete_btn = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnPackageDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>';
            // $edit_btn = ($r->id != 1) ? '<a href="javascript:void(0);" id="btnUserDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>' : '' ;
            $action = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnPackageEdit"><i class="fa fa-fw fa-edit"></i> Edit</a>  ' . $delete_btn;

            $data[] = array(

                $r->id,
                $r->name,
                $r->dress_count,
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

        $this->form_validation->set_rules('name','Name', 'required|is_unique[package.name]');
        $this->form_validation->set_rules('price','Price', 'required|is_numeric');
        $this->form_validation->set_rules('number_of_items','Number of Items', 'required|is_numeric');
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{
            
            $data = array(
                'name' => $this->input->post('name'),
                'dress_count' => $this->input->post('number_of_items'),
                'price' => $this->input->post('price'),
            );

            $res = $this->packages_model->savePackage($data);
            if ($res) {
                $response['message'] = 'Package Created Successfully';
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error on creating package';
                $response['success'] = FALSE;
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

    $this->form_validation->set_rules('name','Name', 'required|is_unique[package.name]');
    $this->form_validation->set_rules('price','Price', 'required|is_numeric');
    $this->form_validation->set_rules('number_of_items','Number of Items', 'required|is_numeric');  
      
    if ($this->form_validation->run() == FALSE) {

        $response['validation_errors'] = validation_errors();
        $response['success'] = FALSE;

    }else{

        $data = array(
            'name' => $this->input->post('name'),
            'dress_count' => $this->input->post('number_of_items'),
            'price' => $this->input->post('price'),
        );

        $res = $this->packages_model->updatePackage($id, $data);

        if ($res) {
            $response['message'] = 'Package Updated Successfully';
            $response['success'] = TRUE;
        }else{
            $response['message'] = 'Error on updating package';
            $response['success'] = FALSE;
        }
    }

    echo json_encode($response);
    exit;

  }

}

