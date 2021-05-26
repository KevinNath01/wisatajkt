<?php

class wisata_model extends CI_Model
{
    public function getwisata($nama = null)
    {
        if($nama === null){
        return $this->db->get('wisata')->result_array();
        } else {
            return $this->db->get_where('wisata',['nama' => $nama])->result_array(); 
        }
    }

    public function deleteWisata($nama)
    {
        $this->db->delete('wisata',['nama' => $nama]);
        return $this->db->affected_rows();
    }

    public function createWisata($data){
        $this->db->insert('wisata', $data);
        return $this->db->affected_rows();
    }

    public function updateWisata($data, $id_wisata){
        $this->db->update('wisata', $data, ['id_wisata' => $id_wisata]);
        return $this->db->affected_rows();
    }

    public function getuser($nama = null)
    {
        if($nama === null){
            $this->db->select('id, username, level');  
        return $this->db->get('m_user')->result_array();
        } else {
            return $this->db->get_where('m_user',['username' => $nama])->result_array(); 
        }
    }
}