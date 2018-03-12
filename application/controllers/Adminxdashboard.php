<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminxdashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//untuk template
		$this->load->library('template');

		// jika belum login redirect ke login
		if ($this->session->userdata('logged')<>1) {
			redirect(site_url('login'));
		}

		//untuk load model
		$this->load->helper('url');
		$this->load->model('grafik_m');
		$this->load->model('M_Saran');

	}

	public function index(){
		if(null !== $this->input->post('wilayah')){
			$wilayah= $this->input->post('wilayah');
		}else{
			$wilayah= "Ciroyom - Caheum";
		}

		$data = array(
			"title_page" => "Chart",
			"konten" => $this->grafik_m->GetParameter($wilayah),
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_dashboard" => "active",
			"wilayah" => $wilayah
		);

		$this->template->isi('admin/dashboard/dashboard',$data);
	}

	public function get_data()
	{
		$kondisi = $this->input->post('kondisi');
		$waktu = $this->input->post('waktu');

		$data = $this->grafik_m->get_data($kondisi, $waktu);

		$data_co2 = array();
		$data_kelembaban = array();
		$data_co = array();
		$data_suhu = array();

		$array = array();

		$now = new DateTime(null, new DateTimeZone('Asia/Jakarta'));
		$now->format('Y-m-d H:i:s');

		foreach ($data as $key => $value)
		{


			$time = strtotime($value['created_at']) * 1000;

			$co2 =  $waktu != "all" ? $value['rata2_co2'] : $value['co2'];
			$kelembaban =  $waktu != "all" ? $value['rata2_kelembaban'] : $value['kelembaban'];
			$co =  $waktu != "all" ? $value['rata2_co'] : $value['index_akhir'];
			$suhu =  $waktu != "all" ? $value['rata2_suhu'] : $value['suhu'];

			array_push($data_co2, [$time, (int) $co2]);
			array_push($data_kelembaban, [$time, (int) $kelembaban]);
			array_push($data_co, [$time, (int) $co]);
			array_push($data_suhu, [$time, (int) $suhu]);


		}

		array_push($array, array('co2' => $data_co2, 'kelembaban' => $data_kelembaban,'co' => $data_co, 'suhu' => $data_suhu));
		echo json_encode($array);

	}

	public function history()
	{
			$data = array(
				"active_menu_history" => "active",
				"jumlah_pesan" => $this->M_Saran->get_jumlah(),
				"data_alat" => $this->grafik_m->get_data_alat()
			);

			$this->template->isi('admin/history/index',$data);

	}
}
