<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {
	public function GetUser($id_pengguna)
	{
		$data = $this->db->get_where("pengguna", array('id_pengguna' => $id_pengguna));
		return $data->result_array();
	}

	function proses_update_profile($id_pengguna,$data){
		$this->db->where(array('id_pengguna' => $id_pengguna));
		$res = $this->db->update('pengguna',$data);
		return $res;
	}

	function proses_delete_data($where){
		$this->db->where($where);
		$res = $this->db->delete("pengguna");
		return $res;
	}

	function proses_input_data($data){
		$res = $this->db->insert("pengguna",$data);
		return $res;
	}

	public function android_login($kondisi)
	{
		$response = array();

		$this->db->where($kondisi);
		$data = $this->db->get('pengguna');

		if ($data->num_rows() > 0) {

			$response['error'] = false;
			$response['data'] = $data->row();
			$response['message'] = 'Berhasil login';

		}else{
			$response['error'] = true;
			$response['message'] = 'Kombinasi usernama dan password salah';
		}

		return $response;
	}

	public function update_android($kondisi, $data)
	{
		$response = array();

		$this->db->where($kondisi);
		$data1 = $this->db->update('pengguna', $data);

		$this->db->where($kondisi);
		$get_data = $this->db->get('pengguna')->row();

		if($data1 >= 1) {
			$response['error'] = false;
			$response['data'] = $get_data;
			$response['message'] = 'Berhasil update';

		}else{
			$response['error'] = true;
			$response['message'] = 'Gagal update';
		}

		return $response;

	}
}
