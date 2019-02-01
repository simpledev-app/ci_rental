<?php

class KaryawanModel extends CI_Model
{
    public function create($data)
    {
        $this->db->insert('pegawai', $data);
        $id = $this->db->insert_id();
        return $this->db->get_where('pegawai', ['id' => $id])->row_array();
    }
}
