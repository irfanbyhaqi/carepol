<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_m extends CI_Model {
	public function GetParameter($wilayah)
	{
		$this->db->where(array('a.wilayah'=>$wilayah));
		$this->db->select('a.wilayah,b.*');
		$this->db->from('alat as a');
		$this->db->join('parameter as b', 'a.key_alat = b.key_alat');
		$data = $this->db->get();
		return $data->result_array();
	}

	public function get_data($kondisi, $waktu)
	{


			if ($kondisi != "all") {
				$this->db->where('jalan', $kondisi);
			}


				if ($waktu == 'bulan') {
					$this->db->select('AVG(index_akhir) as rata2_co, AVG(suhu) as rata2_suhu, AVG(kelembaban) as rata2_kelembaban,AVG(co2) as rata2_co2, created_at');
					$this->db->group_by('MONTH(created_at), YEAR(created_at)');
				}else if($waktu == 'tahun'){
					$this->db->select('AVG(index_akhir) as rata2_co, AVG(suhu) as rata2_suhu, AVG(kelembaban) as rata2_kelembaban,AVG(co2) as rata2_co2, created_at');
					$this->db->group_by('YEAR(created_at)');
				}else{
					$this->db->select('AVG(index_akhir) as rata2_co, AVG(suhu) as rata2_suhu, AVG(kelembaban) as rata2_kelembaban,AVG(co2) as rata2_co2, suhu, kelembaban, co2, index_akhir, co, created_at');
					$this->db->group_by('DAY(created_at)');
				}


			return $this->db->get('parameter')->result_array();

	}

	public function get_data_alat()
	{
			$this->db->from('parameter');
			$this->db->select('key_alat, suhu, kelembaban,co2,co,  jalan, index_akhir, created_at');
			$this->db->order_by('id_parameter','desc');

			return $this->db->get()->result();
	}

}
