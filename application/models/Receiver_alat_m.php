<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiver_alat_m extends CI_Model {

	public function gel_all_data()
	{
		return $this->db->get('parameter')->result();
	}

	function input($data){
		$res = $this->db->insert("parameter",$data);
		return $res;
	}

	public function cek_key($key)
	{
			$this->db->where('key_alat', $key);
			return $this->db->get('alat')->num_rows() > 0;
	}

	public function get_data_alat()
	{
		$response = array();
		$this->db->select('*');
		$data = $this->db->get('parameter');

		if ($data->num_rows() > 0)
		{
			$response["error"] = false;
			$response["message"] = 'Data record';

			$response['pengukuran'] = $data->row_array();

		}else{

			$response["error"] = true;
			$response["message"] = 'Data alat kosong';

		}

		return $response;
	}

	public function cek_data()
	{
		return $this->db->get('parameter')->num_rows();
	}

	public function cek_jalan_ada_enggak($jalan)
	{
			$this->db->where('jalan', $jalan);
			$data = $this->db->get('parameter');

			$response = array();

			if ($data->num_rows() > 0) {

				$response['pesan'] = true;
				$response['jumlah'] = $data->num_rows();
				$response['data'] = $data;

			}else{

				$response['pesan'] = false;

			}

			return $response;
	}

	public function update_co($id, $data)
	{
		$this->db->where('id_parameter', $id);
		$this->db->update('parameter', $data);
	}

	public function get_radius_500meter($lat_alat, $lon_alat, $kondis)
	{
			$response = array();


			$data = $this->db->query("SELECT *, ( 3959 * acos( cos( radians(".$lat_alat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon_alat.") ) + sin( radians(".$lat_alat.") ) * sin( radians( lat ) ) ) ) AS distance FROM `parameter` WHERE `jalan` = '".$kondis."' HAVING distance < '0.310686'");

			if ($data->num_rows() > 0) {
				$response['pesan'] = true;
				$response['data'] = $data;
			}else{
				$response['pesan'] = false;
			}

			return $response;
	}

	public function get_rata_rata_jalan($lat_alat, $lon_alat, $kondis)
	{
		$response = array();

		$data = $this->db->query("SELECT ( 3959 * acos( cos( radians(".$lat_alat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon_alat.") ) + sin( radians(".$lat_alat.") ) * sin( radians( lat ) ) ) ) AS distance,
		AVG(index_akhir) AS rata2_ispu, AVG(co) AS rata2_co, AVG(co2) AS rata2_co2, AVG(kelembaban) AS rata2_kelembaban, AVG(suhu) AS rata2_suhu, jalan FROM `parameter` WHERE `jalan` = '".$kondis."' HAVING distance < '0.310686'");

		if ($data->num_rows() > 0) {
			$response['pesan'] = true;
			$response['data'] = $data;
		}else{
			$response['pesan'] = false;
		}

		return $response;
	}

	public function get_notif($lat_alat, $lon_alat)
	{
		$response = array();

		$data = $this->db->query("SELECT *, ( 3959 * acos( cos( radians(".$lat_alat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon_alat.") ) + sin( radians(".$lat_alat.") ) * sin( radians( lat ) ) ) ) AS distance FROM `parameter` HAVING distance < '10'");

		if ($data->num_rows() > 0) {
			$response['pesan'] = true;
			$response['data'] = $data;
		}else{
			$response['pesan'] = false;
		}

		return $response;
	}

}
