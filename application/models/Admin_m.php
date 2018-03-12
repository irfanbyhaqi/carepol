<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {
	public function GetUser()
	{
		$this->db->where("status != 'Admin'");
		$data = $this->db->get("pengguna");
		return $data->result_array();
	}

	function proses_update_profile($id_pengguna,$data){
		$this->db->where(array('id_pengguna' => $id_pengguna));
		$res = $this->db->update('pengguna',$data);
		return $res;
	}

	public function get_data_where($id_pengguna)
	{

		$this->db->from('pengguna');
		$this->db->join('alat', 'pengguna.id_alat = alat.id_alat', 'left');
		$this->db->where($id_pengguna);
		$data = $this->db->get();
		
		return $data->result_array();
	}
}
