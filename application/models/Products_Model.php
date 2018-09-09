<?php

class Products_Model extends CI_Model
{
    function __construct(){
        parent::__construct();
            $this->load->database();
    }

    public function getProducts()
    {
        $this->db->select('p.*, c.name as catname')
                ->from('products as p')
                ->join('categories as c', 'c.id = p.category_id')
                ->where('p.is_archive', 0);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query;
        }
        return [];
    }

    function saveProduct($data)
    {
        return $this->db->insert('products', $data);
    }

    function getProductInfo($id)
    {
        $this->db->select('p.*, c.name as catname, s.size as size_name')
                ->from('products as p')
                ->join('categories as c', 'c.id = p.category_id')
                ->join('size as s', 's.id = p.size_id')
                ->where('p.id', $id);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->row();
        }
        return [];
    }

    function updateProduct($id, $data)
    {
        $this->db->where('id',$id);
        return $this->db->update('products', $data);
    }

    function getAllProducts()
    {
        $this->db->select('p.*, c.name as cat_name, c.id as cat_id, s.size as size_name')
                ->from('products as p')
                ->join('categories as c', 'c.id = p.category_id')
                ->join('size as s', 's.id = p.size_id')
                ->where('p.is_available', 1)
                ->where('p.is_archive', 0);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result();
        }
        return [];
    }

    public function record_count()
    {
        return $this->db->count_all("products");
    }

    public function getSizes()
    {
        $this->db->select('*')
                ->from('size');
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result();
        }
        return [];
    }

    public function delete_product($id)
    {

        $data = array(
            'is_archive' => 1
        );

        $this->db->select('*')
                ->from('transaction_Details')
                ->where('product_id', $id);
        $query = $this->db->get();

        
        if($query->num_rows()){
            
            foreach ($query->result() as $result) {
                $this->db->select('*')
                        ->from('transactions')
                        ->where('transaction_no', $result->transaction_no)
                        ->where('status', 0)
                        ->or_where('status', 1);
                $trans = $this->db->get();

                if ($trans->num_rows() > 0) {
                    return FALSE;
                }else{
                    $this->db->where('id',$id);
                    return $this->db->update('products', $data);
                }
            }

        }else{
            $this->db->where('id', $id);
            return $this->db->update('products', $data);
        }
        return [];
    }

}

?>
