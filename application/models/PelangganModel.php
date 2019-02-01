<?php

class PelangganModel extends CI_Model
{
    public function create($data)
    {
        $this->db->insert('pelanggan',$data);
        $id = $this->db->insert_id();
        return  $this->db->get_where('pelanggan', ['id' => $id])->row_array();
    }
    
}
