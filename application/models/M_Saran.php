<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Saran extends CI_Model{

  public function get_where_sara($kondisi)
  {
      $this->db->from('komentar');
      $this->db->where('lokasi',$kondisi);
      $this->db->order_by('created_at','desc');

      return $this->db->get();
  }

  public function get_jumlah()
  {
    return $this->db->get('komentar')->num_rows();
  }

  public function delete($id)
  {
      $this->db->where('id_komentar', $id);
      $this->db->delete('komentar');

  }

  public function kirim_saran_pemerintah($data)
  {
     $this->db->insert('pemerintah', $data);
  }

}
