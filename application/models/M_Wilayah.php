<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Wilayah extends CI_Model{

    public function get_all()
    {
       return $this->db->get('wilayah')->result();
    }

    public function insert($data)
    {
      return $this->db->insert('wilayah', $data);
    }

    public function get_data_where($kondis)
    {
        $this->db->where($kondis);
        return $this->db->get('wilayah')->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id_wilayah', $id);
        return $this->db->update('wilayah', $data);
    }

    public function proses_delete_data($id)
    {
        $this->db->where($id);
        return $this->db->delete('wilayah');
    }

}
