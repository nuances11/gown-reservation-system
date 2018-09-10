<?php

class Packages_Model extends CI_Model
{
    function __construct(){
        parent::__construct();
            $this->load->database();
    }

    public function getPackages()
    {
        $this->db->select('*')
                ->from('package')
                ->where('is_archive', 0);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query;
        }
        return [];
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

    function getAllPackages()
    {
        $this->db->select('*')
                ->from('package')
                ->where('is_available', 1)
                ->where('is_archive', 0);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result();
        }
        return [];
    }

    function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }

        return $str;
    }

    function getPackageNumber()
    {
        $trans_no = $this->randString(7);

        $this->db->select('*')
                ->from('package')
                ->where('package_number', $trans_no);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $this->randString(7);
        }
        return $trans_no;
    }

    public function delete_package($id)
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
                    $this->db->where('package_number',$id);
                    return $this->db->update('package', $data);
                }
            }

        }else{
            $this->db->where('package_number',$id);
            return $this->db->update('package', $data);
        }
        return [];
    }


}

?>
