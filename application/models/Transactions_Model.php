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
        $res = $this->db->insert('transaction_details', $data);

        if ($res) {
            $this->db->set('qty', 'qty-' . $data['qty'], false);
            $this->db->where('id' , $data['product_id']);
            $update = $this->db->update('products');
            return $update;
        }else{
            return [];
        }
    }

    function getQty($id, $date)
    {
        $totalQty = array();
        $deductedQty = 0;
        // Get All transactions
        $this->db->select('*')
                ->from('transactions')
                ->where('status', 0);
        $tr = $this->db->get();

        // Get Transaction details for each transactions
        foreach ($tr->result() as $trans) {
            
            // echo $trans->transaction_no;

            $this->db->select('*')
                ->from('transaction_details')
                ->where('transaction_no', $trans->transaction_no)
                ->where('product_id', $id)
                ->where('res_date', $date);
            $td = $this->db->get();

            if($td->num_rows()){
                
                foreach ($td->result() as $tdetails) {
                    $totalQty[] = $tdetails->qty;
                }

            }else{
                $this->db->select('qty')
                    ->from('products')
                    ->where('id', $id);
                $query = $this->db->get();
                if($query->num_rows()){
                    $res = $query->row();
                    return $res->qty;
                }
            }

        }

        // Get Product Quantity
        $this->db->select('qty')
            ->from('products')
            ->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows()){
            $res = $query->row();
            $prodQty = $res->qty;
        }
        
        $deductedQty = array_sum($totalQty);

        $total_available = $prodQty - $deductedQty;

        return $total_available;

        exit;


        // $this->db->select('td.*,tr.*, p.qty as product_qty')
        //         ->from('transaction_details as td')
        //         ->join('transactions as tr', 'tr.transaction_no = td.transaction_no')
        //         ->join('products as p', 'p.id = td.product_id')
        //         ->where('td.product_id', $id)
        //         ->where('td.res_date', $date)
        //         ->where('tr.status', 0);
        // $query = $this->db->get();

        

        if($query->num_rows()){

            $total = 0;
            foreach ($query->result() as $item) {

                $total += $item->qty;
                
            }
            $total_available = $item->product_qty - $total;
            return $total_available;
        }else{
            $this->db->select('qty')
                ->from('products')
                ->where('id', $id);
            $query = $this->db->get();
            if($query->num_rows()){
                $res = $query->row();
                return $res->qty;
            }
        }
        return [];
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

    public function getTransactions()
    {
        $this->db->select('*')
                ->from('transactions');
        $query = $this->db->get();
        if($query->num_rows()){
            return $query;
        }
        return [];
    }

    public function set_order($order = NULL)
    {
        if ($order != NULL) {
            
            switch ($order) {
                case 'pending':
                    
                    break;
                
                default:
                    # code...
                    break;
            }


        }else{
            return [];
        }
    }

    

}

?>
