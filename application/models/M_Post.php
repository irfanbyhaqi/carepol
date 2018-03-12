<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Post extends CI_Model{

  public function get_data()
  {
    return $this->db->get('post')->result_array();
  }

  public function insert_post($data)
  {
    return $this->db->insert('post', $data);
  }

  public function get_data_where($id)
  {
    $this->db->where($id);
    return $this->db->get('post')->row_array();
  }

  public function update_post($kondisi, $data)
  {
    $this->db->where($kondisi);
    return $this->db->update('post', $data);
  }

  public function delete_post($kondisi)
  {
    $this->db->where($kondisi);
    return $this->db->delete('post');
  }

  public function get_category()
  {
    return $this->db->get('category')->result_array();
  }

  public function cek_jumlah_category()
  {
    return $this->db->get('category')->num_rows();
  }



}
