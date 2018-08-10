<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	function __construct(){
	    parent::__construct();
            $this->load->model("users_model");
            $this->load->model("categories_model");

	    $styles = array(

			);

			$js = array(

			);

			$this->template->set_additional_css($styles);
			$this->template->set_additional_js($js);

	    //$this->_checkLogin();
	    $this->template->set_title('Admin - Categories');
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
    $this->template->set_title('Admin - Categories');
    $this->template->set_template('admin');

    $this->template->load('categories/index');
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

        $query = $this->categories_model->getCategories();

        $data = [];

        foreach($query->result() as $r) {

            $created = date('F jS Y h:i:sa', strtotime($r->created_at));
            $delete_btn = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnCategoryDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>';
            // $edit_btn = ($r->id != 1) ? '<a href="javascript:void(0);" id="btnUserDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>' : '' ;
            $action = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnCategoryEdit"><i class="fa fa-fw fa-edit"></i> Edit</a>  ' . $delete_btn;

            $data[] = array(

                $r->id,
                $r->name,
                $r->identifier,
                $created,
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

      $this->form_validation->set_rules('name','Name', 'required|is_unique[categories.name]');
      
      if ($this->form_validation->run() == FALSE) {

          $response['validation_errors'] = validation_errors();
          $response['success'] = FALSE;

      }else{
        
        $name = strtolower(preg_replace('/\s+/', '_', $this->input->post('name')));
        $identifier = preg_replace('/[^a-z0-9_\-]/', '', $name);
          
        $data = array(
            'name' => $this->input->post('name'),
            'identifier' => $identifier
        );

        $res = $this->categories_model->saveCategory($data);
        if ($res) {
            $response['message'] = 'Category Created Successfully';
            $response['success'] = TRUE;
        }else{
            $response['message'] = 'Error on creating category';
            $response['success'] = FALSE;
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

            $data = $this->categories_model->getCategoryInfo($id);
            if ($data) {
                $response['category'] = $data;
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error getting category data';
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
        $id = $this->input->post('category_id');

        $this->form_validation->set_rules('name','Name', 'required|is_unique[categories.name]');     
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{

                $name = strtolower(preg_replace('/\s+/', '_', $this->input->post('name')));
                $identifier = preg_replace('/[^a-z0-9_\-]/', '', $name);

            $data = array(
                'name' => $this->input->post('name'),
                'identifier' => $identifier
            );

            $res = $this->categories_model->updateCategory($id, $data);
            if ($res) {
                $response['message'] = 'Category Updated Successfully';
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error on updating category';
                $response['success'] = FALSE;
            }
        }

        echo json_encode($response);
        exit;

    }

}

