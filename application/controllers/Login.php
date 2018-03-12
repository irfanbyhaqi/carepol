<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation', 'Recaptcha'));
		
		$this->load->model('auth_model');
    }

    public function index() {
       $data = array(
            'username' => set_value('username'),
            'password' => set_value('password'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );

        $this->load->view('login', $data);
    }

    public function login() {
        // validasi form
        $this->form_validation->set_rules('username', ' ', 'trim|required');
        $this->form_validation->set_rules('password', ' ', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
            $this->session->set_flashdata("message","<font color='red'>Captcha harus diisi !!!</font>");
			$this->index();
        } else {
            // lakukan proses validasi login disini
            $this->load->model('auth_model');
			$login = $this->auth_model->login($this->input->post('username'), md5($this->input->post('password')));

			if ($login == 1) {
			// ambil detail data
				$row = $this->auth_model->data_login($this->input->post('username'), md5($this->input->post('password')));

			// daftarkan session
				$data = array(
					'logged' => TRUE,
					'id_pengguna' => $row->id_pengguna,
					'username' => $row->username,
					'status' => $row->status,
					'key_alat' => $row->key_alat
				);
				$this->session->set_userdata($data);

			// redirect ke halaman sukses
				if($this->session->userdata('status')=="Admin"){
					redirect(site_url('adminxuser'));
				}else{
					redirect(site_url('user'));
				}
			} else {
			// tampilkan pesan error
				$this->session->set_flashdata("message","<font color='red'>Username atau Password salah !!!</font>");
				redirect('login');
			}
        }
    }

    function logout() {
//        destroy session
        $this->session->sess_destroy();
        
//        redirect ke halaman login
        redirect(site_url('login'));
    }

	function cek(){
		$key = $this->input->post('key');
		$cek = $this->auth_model->cek_key_alat($key);
		if($cek>=1){
			$ambil_idalat = $this->auth_model->ambil_keyalat($key);
			foreach($ambil_idalat as $data){
				$key_alat=$data['key_alat'];
			}
			$res = $this->auth_model->cek_keyalat_pengguna($key_alat);
			if($res>=1){
				$this->session->set_flashdata("message","key tidak valid !");
				redirect(site_url('login/error'));
			}
			else{
				$this->session->set_flashdata("berhasil","Key Alat Valid ! Silahkan isi form berikut.");
				$this->session->set_flashdata("key_alat",$key_alat);
				redirect(site_url('login/registrasi'));
			}
		}
		else{
			$this->session->set_flashdata("message","key tidak valid !");
			redirect(site_url('login/error'));
		}  
	}
	
	function error(){
		$this->load->view('register/tidak_valid');
	}
	
	function registrasi(){
		if($this->session->flashdata('berhasil')){
			$this->load->view('register/registrasi');
		}
		else{
			$this->session->set_flashdata("message","Expired.. <br> Masukan Key Alat");
			redirect(site_url('login/error'));
		}
	}
	
	function proses_registrasi(){
		$data = $this->input->post(null, true);
		$data['status']="User";
		$data['password']=md5($data['password']);
		$res = $this->auth_model->proses_registrasi($data);
		if($res>=1){
			// lakukan proses validasi login disini
            $this->load->model('auth_model');
			$login = $this->auth_model->login($this->input->post('username'), md5($this->input->post('password')));

			if ($login == 1) {
			// ambil detail data
				$row = $this->auth_model->data_login($this->input->post('username'), md5($this->input->post('password')));

			// daftarkan session
				$data = array(
					'logged' => TRUE,
					'id_pengguna' => $row->id_pengguna,
					'username' => $row->username,
					'status' => $row->status
				);
				$this->session->set_userdata($data);

			// redirect ke halaman sukses
				redirect(site_url('user'));
			} else {
			// tampilkan pesan error
				$this->session->set_flashdata("message","<font color='red'>Username atau Password salah !!!</font>");
				redirect('login');
			}
		}
		else{
			$this->session->set_flashdata("message","Registrasi Gagal");
			redirect(site_url('login/error'));
		}
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */