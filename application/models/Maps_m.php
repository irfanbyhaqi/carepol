<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_m extends CI_Model {
	public function GetParameter()
	{
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function GetSuhu()
	{
		/* $this->db->select("id_parameter, suhu, lat, lon"); */
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function GetGas()
	{
		$this->db->select("id_parameter, gas, lat, lon");
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function GetKelembaban()
	{
		$this->db->select("id_parameter, kelembaban, lat, lon");
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function GetSuhuWhere($key)
	{
		$this->db->where(array('key_alat' => $key));
		$this->db->select("id_parameter, suhu, lat, lon");
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function GetGasWhere($key)
	{
		$this->db->where(array('key_alat' => $key));
		$this->db->select("id_parameter, gas, lat, lon");
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function GetKelembabanWhere($key)
	{
		$this->db->where(array('key_alat' => $key));
		$this->db->select("id_parameter, kelembaban, lat, lon");
		$data = $this->db->get("parameter");
		return $data->result_array();
	}

	public function get_jalan($kondisi = null)
	{
		$this->db->select('jalan');

		$this->db->where('jalan !=', "Tidak Di ketahui");

		if ($kondisi != null ) {
			if ($kondisi != "all") {
				$this->db->where('jalan', $kondisi);
			}
		}

		$this->db->group_by('jalan');

		return $this->db->get('parameter')->result_array();

	}

	public function get_data($kondisi)
	{
			$this->db->where('jalan !=', "Tidak Di ketahui");

			if ($kondisi != "all") {
				$this->db->where('jalan', $kondisi);
			}

			return $this->db->get('parameter')->result_array();
	}

	public function get_avrg($kondisi)
	{
			$this->db->select(' AVG(index_akhir) as rata_rata');

			$this->db->where('jalan !=', "Tidak Di ketahui");

			$this->db->group_by('jalan');

			if ($kondisi != "all") {
				$this->db->where('jalan', $kondisi);
			}

			return $this->db->get('parameter')->result_array();
		}

		public function get_jumlah_pesan($kondisi)
		{
				$this->db->where('lokasi', $kondisi);
				return $this->db->get('komentar')->num_rows();
		}

		public function frontend_get_avrg($kondisi)
		{

				$this->db->where('jalan !=', "Tidak Di ketahui");

				if ($kondisi != "all") {
					$this->db->where('jalan', $kondisi);
				}

				return $this->db->get('parameter')->result_array();
		}

		public function send_koment($data)
		{
				$this->db->insert('komentar', $data);
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

				$response['pengukuran'] = $data->result_array();

			}else{

				$response["error"] = true;
				$response["message"] = 'Data alat kosong';

			}

			return $response;
		}
}
