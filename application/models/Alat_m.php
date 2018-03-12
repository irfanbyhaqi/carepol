<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_m extends CI_Model {
	public function GetAlat()
	{
		$this->db->from("alat");
		$this->db->join('wilayah', 'alat.wilayah = wilayah.id_wilayah', 'left');

		$data = $this->db->get();

		return $data->result_array();
	}

	public function get_data_where($key_alat)
	{
		$this->db->where($key_alat);

		$this->db->from("alat");
		$this->db->join('wilayah', 'alat.wilayah = wilayah.id_wilayah', 'left');

		$data = $this->db->get();

		return $data->result_array();
	}

	function proses_input_data($data){
		$res = $this->db->insert("alat",$data);
		return $res;
	}

	function proses_delete_data($where){
		$this->db->where($where);
		$res = $this->db->delete("alat");
		return $res;
	}

	public function get_key_alat()
	{
		$query1 = $this->db->query("select id_alat from pengguna ");
	  $query1_result = $query1->result();
	  $key_alat= array();
	  foreach($query1_result as $row){
	     $key_alat[] = $row->id_alat;
	   }
	  $room = implode(",",$key_alat);
	  $ids = explode(",", $room);
	  $this->db->select("key_alat, id_alat");
	  $this->db->from('alat');
	  $this->db->where_not_in('id_alat', $ids);
	  $query = $this->db->get();
	  return $query->result_array();
	}
}
