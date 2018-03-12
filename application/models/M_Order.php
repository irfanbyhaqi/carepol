<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Order extends CI_Model{

  public function get_data()
  {
    $this->db->from('order');
    $this->db->join('pengguna', 'order.id_pengguna = pengguna.id_pengguna', 'left');
    return $this->db->get()->result_array();
  }

  public function insert_pengguna($data)
  {
    return $this->db->insert('pengguna', $data);
  }

  public function insert_order($data)
  {
    return $this->db->insert('order', $data);
  }

  public function get_data_where($kondisi)
  {
    $this->db->from('pengguna');
    $this->db->join('order', 'pengguna.id_pengguna = order.id_pengguna', 'left');
    $this->db->join('alat', 'pengguna.id_alat = alat.id_alat', 'left');
    $this->db->where($kondisi);
    return $this->db->get()->row();
  }

  public function update_order($kondisi, $data)
  {
    $this->db->where($kondisi);
    return $this->db->update('order', $data);
  }

  public function delete_order($kondisi)
  {
    $this->db->where($kondisi);
    return $this->db->delete('order');
  }

  public function get_jumlah_order()
  {
    $this->db->from('order');
    $this->db->where('konfirmasi', 0);

    return $this->db->get()->num_rows();
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
	  $this->db->select("id_alat, key_alat");
	  $this->db->from('alat');
	  $this->db->where_not_in('id_alat', $ids);
	  $query = $this->db->get();
	  return $query;
  }

  public function get_all_wilayah()
  {
    $this->db->select('id_wilayah');
    return $this->db->get('wilayah')->row()->id_wilayah;

  }

  public function konfirmasi($kondisi, $data)
  {
    $this->db->where($kondisi);
    return $this->db->update('order', $data);

  }

  public function cek_db($kondisi)
  {
    $this->db->from('order');
    $this->db->join('pengguna', 'order.id_pengguna = pengguna.id_pengguna', 'left');
    $this->db->where($kondisi);
    return $this->db->get();
  }

  public function update_status_bayar($kondisi, $data)
  {
    $this->db->where($kondisi);
    return $this->db->update('order', $data);
  }

  public function cek_data_order($kondisi)
  {
    $this->db->from('pengguna');
    $this->db->join('order', 'pengguna.id_pengguna = order.id_pengguna', 'left');
    $this->db->join('alat', 'pengguna.id_alat = alat.id_alat', 'left');
    $this->db->where($kondisi);
    return $this->db->get()->row();
  }



}
