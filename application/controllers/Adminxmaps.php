<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminxmaps extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//untuk template
		$this->load->library('template');

		// jika belum login redirect ke login
		if ($this->session->userdata('logged') <> 1) {
			redirect(site_url('login'));
		}

		//untuk load model
		$this->load->helper('url');
		$this->load->model('maps_m');
		$this->load->model('M_Saran');

	}

	public function index(){

		$data = array(
			"title_page" => "Maps",
			"konten" => $this->maps_m->GetParameter(),
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_maps" => "active"
		);

		$this->template->isi('admin/maps/map',$data);
	}

	public function mapGas(){
		$data = array(
			"title_page" => "Maps",
			"konten" => $this->maps_m->GetGas(),
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_maps" => "active"
		);
		$this->template->isi('admin/maps/mapgas',$data);
	}

	public function mapKelembaban(){
		$data = array(
			"title_page" => "Maps",
			"konten" => $this->maps_m->GetKelembaban(),
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_maps" => "active"
		);
		$this->template->isi('admin/maps/mapkelembaban',$data);
	}

	public function get_jalan()
	{
		$data = $this->maps_m->get_jalan();

		$data = array(
			'jalan' =>  $data
		);

		echo json_encode($data);
	}

	public function get_data()
	{
		$kondisi = $this->input->post('kondisi');

		$data = array(
			'data' => $this->maps_m->get_data($kondisi)
		);

		echo json_encode($data);

	}

	public function get_avrg()
	{
		$kondisi = $this->input->post('kondisi');

		$data = array(
			'avrg' => $this->maps_m->get_avrg($kondisi),
			'jalan' => $this->maps_m->get_jalan($kondisi)
		);

		echo json_encode($data);
	}

	public function get_data_jalan()
	{
		$data1 = $this->maps_m->get_jalan();

		$data = array(
			'jalan' =>  $data1,
			'pesan' => array()
		);

		foreach ($data1 as $key) {
			array_push($data['pesan'], $this->get_jumlah_data($key['jalan']));
		}


		echo json_encode($data);
	}

	public function get_jumlah_data($jalan)
	{
		return $this->maps_m->get_jumlah_pesan($jalan);
	}
}
