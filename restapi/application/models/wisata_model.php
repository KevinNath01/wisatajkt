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
}