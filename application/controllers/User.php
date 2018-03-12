<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
		$this->load->model('user_m');
		$this->load->model('maps_m');
		$this->load->model('grafik_m');
	}

	public function index(){
		$id_pengguna = $this->session->userdata('id_pengguna');
		$data = array(
			"title_page" => "User",
			"profile" => $this->user_m->GetUser($id_pengguna),
			"active_menu_user" => "active"
		);
		$this->template->isi('profile/profile',$data);
	}

	public function dashboard(){
		if(null !== $this->input->post('wilayah')){
			$wilayah= $this->input->post('wilayah');
		}else{
			$wilayah= "Ciroyom - Caheum";
		}
		$data = array(
			"title_page" => "Dashboard",
			"konten" => $this->grafik_m->GetParameter($wilayah),
			"active_menu_dashboard" => "active",
			"wilayah" => $wilayah
		);
		$this->template->isi('dashboard/dashboard',$data);
	}

	public function update_profile(){
		$tgl_lahir = $this->input->post('tahun')."/".$this->input->post('bulan')."/".$this->input->post('tanggal');
		$id_pengguna= $this->input->post('id_pengguna');
		$data = $this->input->post(null, true);
		unset($data['tahun'],$data['bulan'],$data['tanggal'],$data['id_pengguna']);
		$data['tgl_lahir']=$tgl_lahir;
		$res = $this->user_m->proses_update_profile($id_pengguna,$data);
		if($res>=1){
			$this->session->set_flashdata("message","
				<div class='alert alert-success'>
					<button type='button' class='close' data-dismiss='alert'>
						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
					</button>
					<span><b> Success - </b> Profile telah diubah.</span>
				</div>
			");
			redirect('user');
		}
		else{
			$this->session->set_flashdata("message","
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>
						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
					</button>
					<span><b> Failed - </b> Profile tidak diubah.</span>
				</div>
			");
			redirect('user');
		}
	}

	public function mapSuhu(){
		$data = array(
			"title_page" => "Maps",
			"konten" => $this->maps_m->GetSuhu(),
			"active_menu_maps" => "active"
		);
		$this->template->isi('maps/mapsuhu',$data);
	}

	public function mapGas(){
		$key_alat = $this->session->userdata('key_alat');
		$data = array(
			"title_page" => "Maps",
			"konten" => $this->maps_m->GetGasWhere($key_alat),
			"active_menu_maps" => "active"
		);
		$this->template->isi('maps/mapgas',$data);
	}

	public function mapKelembaban(){
		$key_alat = $this->session->userdata('key_alat');

		$data = array(
			"title_page" => "Maps",
			"konten" => $this->maps_m->GetKelembabanWhere($key_alat),
			"active_menu_maps" => "active"
		);

		$this->template->isi('maps/mapkelembaban',$data);
	}
}
