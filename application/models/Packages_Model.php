<?php

class Packages_Model extends CI_Model
{
    function __construct(){
        parent::__construct();
            $this->load->database();
    }

    public function getPackages()
    {
        return $this->db->get("package");
    }

    function savePackage($data)
    {
        return $this->db->insert('package', $data);
    }

    function getPackageInfo($id)
    {
        $this->db->select('*')
                ->from('package')
                ->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->row();
        }
        return [];
    }

    function updatePackage($id, $data)
    {
        
        $this->db->where('id',$id);
        return $this->db->update('package', $data);
        
    }


}

?>
