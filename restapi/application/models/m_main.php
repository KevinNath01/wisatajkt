<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class M_main extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('m_user',$q);
	}

	public function reguser($username,$password){
        $this->db->insert('m_user',['username' => $username,'password' => $password]);
        return $this->db->affected_rows();
    }

	public function cekdata($username){
		$this->db->get_where('m_user',['username' => $username]);
		return $this->db->affected_rows();
	}
}