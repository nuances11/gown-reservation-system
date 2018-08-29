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
                ->join('categories as c', 'c.id = p.category_id');
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
        $this->db->select('p.*, c.name as cat_name, c.id as cat_id')
                ->from('products as p')
                ->join('categories as c', 'c.id = p.category_id')
                ->where('p.is_available', 1);
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

}

?>
