<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	function __construct(){
	    parent::__construct();
            $this->load->model("users_model");
            $this->load->model("categories_model");
            $this->load->model("products_model");
            $this->load->model("transactions_model");

	    $styles = array(

			);

			$js = array(
        'assets/js/application.js',
			);

			$this->template->set_additional_css($styles);
			$this->template->set_additional_js($js);

	    //$this->_checkLogin();
	    $this->template->set_title('Admin - Transactions');
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

    
    $this->template->set_title('Admin - Transactions');
    $this->template->set_template('admin');

    $this->template->load('transactions/index');
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

        $query = $this->transactions_model->getTransactions();
        // echo '<pre>';
        // print_r($query->result());
        // echo '</pre>';
        // exit;

        $data = [];

        foreach($query->result() as $r) {

            $order_status = '';
            $id = '<a href="' . BASE_URL() . 'transactions/order/' . $r->transaction_no . '">' . $r->transaction_no . '</a>';
            $created = date('F j, Y h:i:sa', strtotime($r->created_at));
            $name = strtoupper($r->firstname) . ' ' . strtoupper($r->lastname);
            if ($r->status == 0) {
              $order_status = '<span style="color:orange;"><strong>PENDING</strong></span>';
            }elseif ($r->status == 1) {
              $order_status = '<span style="color:green;"><strong>APPROVED</strong></span>';
            }else {
              $order_status = '<span style="color:red;"><strong>DECLINED</strong></span>';
            }

            $data[] = array(

                $id,
                $name,
                $r->email,
                $created,
                $r->phone,
                $order_status

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

    public function order($id)
    {
      $this->template->set_title('Admin - ORDER #' . $id);
      $this->template->set_template('admin');


      $this->template->load_sub('order', $this->transactions_model->getTransactionDetails($id));
      $this->template->load('transactions/invoice');
    }

    public function orderPrint($id)
    {
      $this->template->set_title('Admin - ORDER #' . $id . 'PRINT');
      $this->template->set_template('print');
      $this->template->load_sub('order', $this->transactions_model->getTransactionDetails($id));
      $this->template->load('transactions/invoice-print');
    }

    public function set_order($order = NULL, $id)
    {
        if ($order != NULL) {
        
            $res = $this->transactions_model->set_order($order, $id);

            if ($res) {
            
                $this->session->set_flashdata('update', 'Order status updated');
                redirect($_SERVER['HTTP_REFERER']);

            }

        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
