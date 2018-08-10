<?php

class Users_Model extends CI_Model
{
    function __construct(){
        parent::__construct();
            $this->load->database();
    }

    function saveUser($data)
    {
        return $this->db->insert('users', $data);
    }

    function deleteUser($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    function getUserInfo($id)
    {
        $this->db->select('*')
                ->from('users')
                ->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->row();
        }
        return [];
    }

    function updateUser($id, $data)
    {
        if ($this->input->post('password')) {
            $pass = array(
                "password" => md5($this->input->post('password'))
            );
    
            $this->db->where('id', $id);
            $this->db->update('users', $pass);
        }
        
        $this->db->where('id',$id);
        return $this->db->update('users', $data);
    }

    public function getUsers()
    {
        return $this->db->get("users");
    }

}

?>
