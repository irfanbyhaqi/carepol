<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminxuser extends CI_Controller {
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
		$this->load->model('admin_m');
		$this->load->model('alat_m');
		$this->load->model('user_m');
		$this->load->model('M_Saran');

	}

	public function index(){
		$data = array(
			"title_page" => "User",
			"konten" => $this->admin_m->GetUser(),
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_user" => "active"
		);

		$this->template->isi('admin/user/user',$data);
	}

	function tambah_user(){
		$data = array(
			"title_page" => "Tambah User",
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"data_alat" => $this->alat_m->get_key_alat()
		);

		$this->template->isi('admin/user/tambah_user',$data);
	}

	public function proses_tambah_user(){

		$tgl_lahir = $this->input->post('tahun')."/".$this->input->post('bulan')."/".$this->input->post('tanggal');
		$data = $this->input->post(null, true);

		unset($data['tahun'],$data['bulan'],$data['tanggal']);

		$data['tgl_lahir']=$tgl_lahir;
		$data['password'] = md5($this->input->post('password'));
		$data['status']="User";

		$res = $this->user_m->proses_input_data($data);

		if($res >= 1){

			$this->session->set_flashdata("message","
						<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
							</button>
							<span><b> Success - </b> 1 Data telah ditambah.</span>
						</div>
			");

			redirect('adminxuser');
		}
		else{
			$this->session->set_flashdata("message","
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>
						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
					</button>
					<span><b> Failed - </b> Data tidak ditambah.</span>
				</div>
			");
			redirect('adminxuser');
		}
	}

	function detail_user($id){
		$id_pengguna = array('id_pengguna' => $id);
		$data = array(
			"title_page" => "Detail User",
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"konten" => $this->admin_m->get_data_where($id_pengguna)
		);
		$this->template->isi('admin/user/detail_user',$data);
	}

	function edit_user($id){
		$id_pengguna = array('id_pengguna' => $id);
		$data = array(
			"title_page" => "Edit User",
			"jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"konten" => $this->admin_m->get_data_where($id_pengguna)
		);
		$this->template->isi('admin/user/edit_user',$data);
	}

	public function proses_edit_user(){
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
					<span><b> Success - </b> Data telah diubah.</span>
				</div>
			");
			redirect('adminxuser/edit_user/'.$id_pengguna);
		}
		else{
			$this->session->set_flashdata("message","
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>
						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
					</button>
					<span><b> Failed - </b> Data tidak diubah.</span>
				</div>
			");
			redirect('adminxuser/edit_user/'.$id_pengguna);
		}
	}

	function proses_delete($id){
		$id_pengguna = array( 'id_pengguna' => $id );
		$res = $this->user_m->proses_delete_data($id_pengguna);
		if($res>=1){
			$this->session->set_flashdata("message","
				<div class='alert alert-success'>
					<button type='button' class='close' data-dismiss='alert'>
						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
					</button>
					<span><b> Success - </b> 1 data telah dihapus.</span>
				</div>
			");
			redirect('adminxuser');
		}
		else{
			$this->session->set_flashdata("message","
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>
						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
					</button>
					<span><b> Failed - </b> Data tidak dihapus.</span>
				</div>
			");
			redirect('adminxuser');
		}
	}
}
