<?php

class Categories_Model extends CI_Model
{
    function __construct(){
        parent::__construct();
            $this->load->database();
    }

    public function getAllCategories()
    {
        $this->db->select('*')
                ->from('categories');
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result();
        }
        return [];
    }

    public function getCategories()
    {
        return $this->db->get("categories");
    }

    function saveCategory($data)
    {
        return $this->db->insert('categories', $data);
    }

    function getCategoryInfo($id)
    {
        $this->db->select('*')
                ->from('categories')
                ->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->row();
        }
        return [];
    }

    function updateCategory($id, $data)
    {
        
        $this->db->where('id',$id);
        return $this->db->update('categories', $data);
    }

    public function getCategoryProducts($id)
    {
        $this->db->select('p.*, c.name as cat_name')
                ->from('products as p')
                ->join('categories as c', 'c.id = p.category_id')
                ->where('p.category_id', $id);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result();
        }
        return [];
    }

}

?>
