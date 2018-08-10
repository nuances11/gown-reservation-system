<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
	    parent::__construct();
			$this->load->model("users_model");

	    $styles = array(

			);

			$js = array(

			);

			$this->template->set_additional_css($styles);
			$this->template->set_additional_js($js);

	    //$this->_checkLogin();
	    $this->template->set_title('Admin - Dashboard');
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
        $this->template->set_title('Admin - Users');
        $this->template->set_template('admin');

		$this->template->load('users/index');
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

        $query = $this->users_model->getUsers();

        $data = [];
				$group = "";

        foreach($query->result() as $r) {

            $created = date('F jS Y h:i:sa', strtotime($r->created_at));
            $delete_btn = ($r->id != 1) ? '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnUserDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>' : '' ;
            // $edit_btn = ($r->id != 1) ? '<a href="javascript:void(0);" id="btnUserDelete"><i class="fa fa-fw fa-trash"></i> Delete</a>' : '' ;
            $action = '<a href="javascript:void(0);" data-id="' . $r->id . '" class="btnUserEdit"><i class="fa fa-fw fa-edit"></i> Edit</a>  ' . $delete_btn;

            if ($r->user_group == '1') {
                $group = '<strong>Admin</strong>';
            }elseif ($r->user_group == '2') {
                $group = 'Staff';
            }

            $data[] = array(

                $group,
                $r->name,
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

    * Create user on this method.

    *

    * @return Response

   */

    public function save()
    {
        $response = array();

        $this->form_validation->set_rules('name','Name', 'required');
        $this->form_validation->set_rules('user_group','User Group', 'required|numeric');
        $this->form_validation->set_rules('username','Username', 'required|is_unique[users.username]',
            array('is_unique' => '%s already used. Please provide a unique one.'));
        $this->form_validation->set_rules('password','Password', 'required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|matches[password]');
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{
            
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'user_group' => $this->input->post('user_group')
            );

            $res = $this->users_model->saveUser($data);
            if ($res) {
                $response['message'] = 'User Created Successfully';
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error on creating user';
                $response['success'] = FALSE;
            }
        }

        echo json_encode($response);
        exit;
    }

    /**

    * Delete user on this method.

    *

    * @return Response

   */

   public function delete()
   {
        $response = array();

        $res = $this->users_model->deleteUser($this->input->post('id'));
        if ($res) {
            $response['message'] = 'User Successfully Deleted';
            $response['success'] = TRUE;
        }else{
            $response['message'] = 'Error on Deleting User';
            $response['success'] = FALSE;
        }

        echo json_encode($response);
        exit;

   }

   /**

    * Show User details on this method.

    *

    * @return Response

   */

   public function edit()
   {
        $response = array();
        $id = $this->input->get('id');

        $data = $this->users_model->getUserInfo($id);
        if ($data) {
            $response['user'] = $data;
            $response['success'] = TRUE;
        }else{
            $response['message'] = 'Error getting user data';
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
        $id = $this->input->post('user_id');
        $this->form_validation->set_rules('name','Name', 'required');
        $this->form_validation->set_rules('user_group','User Group', 'required|numeric');
        if($this->input->post('password')){
            $this->form_validation->set_rules('password','Password', 'required|min_length[8]');
            $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|matches[password]');
        }       
        
        
        if ($this->form_validation->run() == FALSE) {

            $response['validation_errors'] = validation_errors();
            $response['success'] = FALSE;

        }else{

            $data = array(
                'name' => $this->input->post('name'),
                'user_group' => $this->input->post('user_group')
            );

            $res = $this->users_model->updateUser($id, $data);
            if ($res) {
                $response['message'] = 'User Updated Successfully';
                $response['success'] = TRUE;
            }else{
                $response['message'] = 'Error on updating user';
                $response['success'] = FALSE;
            }
        }

        echo json_encode($response);
        exit;

    }

}
