<?php

class Transactions_Model extends CI_Model
{
    function __construct(){
        parent::__construct();
            $this->load->database();
    }

    function saveTransaction($data)
    {
        return $this->db->insert('transactions', $data);
    }

    function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }

        return $str;
    }

    function getTransNumber()
    {
        $trans_no = $this->randString(7);

        $this->db->select('*')
                ->from('transactions')
                ->where('transaction_no', $trans_no);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $this->randString(7);
        }
        return $trans_no;
    }

    function saveTransactionDetails($data)
    {
        return $this->db->insert('transaction_details', $data);
    }

    public function getTransactionDetails($id)
    {
        $transaction = [];
        $this->db->select('*')
                ->from('transactions')
                ->where('transaction_no', $id);
        $trans = $this->db->get();
        if($trans->num_rows() > 0){
            $_trans = $trans->row();

            foreach ($trans->result() as $item) {
                $this->db->select('p.*, td.*, td.qty as tdqty')
                    ->from('transaction_details as td')
                    ->join('products as p', 'p.id = td.product_id')
                    ->where('transaction_no', $id);
                $trans_details = $this->db->get();
                $_trans_details = $trans_details->result();
                $item->transDetails = $_trans_details;
            }

            return $trans->row();

        }
        return [];
    }

    public function getSearchQuery($key)
    {
        $this->db->select('*')
                ->from('transactions')
                ->like('transaction_no', $key);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result();
        }
        return [];
    }

    

}

?>
