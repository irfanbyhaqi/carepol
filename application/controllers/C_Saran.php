<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Saran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //untuk template
		$this->load->library('template');

		// jika belum login redirect ke login
		if ($this->session->userdata('logged') <> 1) {
			redirect(site_url('login'));
		}

		//untuk load model
		$this->load->helper('url');
    $this->load->model('M_Saran');

  }

  function index()
  {

    $data = array(
			"title_page" => "Saran",
      "jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_saran" => "active"
		);

		$this->template->isi('admin/saran/saran',$data);
  }

  public function get_data_where()
  {
      $kondisi = $this->input->post('jalan');

      $cek_data = $this->M_Saran->get_where_sara($kondisi);

      $html = '';


      if ($cek_data->num_rows() > 0) {

        $html .= '

          <button class="btn btn-success laporkan" data-jalan="'.$kondisi.'">Laporkan</button>
          <br><br>
          <table class="table" id="example">
            <thead>
              <tr>
                <th><b>No</b></th>
                <th><b>Name</b></th>
                <th><b>Komentar</b></th>
                <th><b>Time</b></th>
                <th><b>Aksi</b></th>
              </tr>
            </thead>
            <tbody>
        ';

        $no = 1;
        foreach ($cek_data->result() as $isi) {
          $html .='
              <tr>
                <td>'.$no++.'</td>
                <td>'.$isi->nama.'</td>
                <td>'.$isi->komentar.'</td>
                <td>'.$isi->created_at.'</td>
                <td>
                  <button class="btn btn-danger btn-xs hapus" data-id="'.$isi->id_komentar.'" data-kondisi="'.$kondisi.'">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                </td>
              </tr>
          ';
        }

        $html .='
          </tbody>
        </table>

        ';

      }

    echo $html;

  }

  public function hapus_data()
  {
     $id = $this->input->post('id');
     $this->M_Saran->delete($id);
  }

  public function kirim_saran_pemerintah()
  {
      $jalan = $this->input->post('jalan');
      $saran = $this->input->post('saran');

      $data = array(
        'jalan' => $jalan,
        'saran' => $saran
      );

      $this->M_Saran->kirim_saran_pemerintah($data);

  }

  public function get_jumlah_pesan()
  {
    echo $this->M_Saran->get_jumlah();
  }

}
