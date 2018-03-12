<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Category extends CI_Model{

  public function get_data()
  {
    return $this->db->get('category')->result_array();
  }

  public function insert_category($data)
  {
    return $this->db->insert('category', $data);
  }

  public function get_data_where($id)
  {
    $this->db->where($id);
    return $this->db->get('category')->row();
  }

  public function update_category($kondisi, $data)
  {
    $this->db->where($kondisi);
    return $this->db->update('category', $data);
  }

  public function delete_category($kondisi)
  {
    $this->db->where($kondisi);
    return $this->db->delete('category');
  }

}
