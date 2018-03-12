<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Wilayah extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //untuk template
		$this->load->library('template');

		// jika belum login redirect ke login
		if ($this->session->userdata('logged')<>1) {
			redirect(site_url('login'));
		}

		//untuk load model
		$this->load->helper('url');
		$this->load->model('M_Wilayah');
    $this->load->model('M_Saran');

  }

  function index()
  {

    $data = array(
			"title_page" => "Area",
			"data" => $this->M_Wilayah->get_all(),
      "jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"active_menu_area" => "active"
		);

		$this->template->isi('admin/wilayah/wilayah',$data);
  }

  public function tambah_wilayah()
  {
      $data = array(
        "title_page" => "Add Area",
        "jumlah_pesan" => $this->M_Saran->get_jumlah(),
      );

      $this->template->isi('admin/wilayah/tambah_wilayah',$data);
  }

  public function proses_tambah_wilayah()
  {
      $dari = $this->input->post('dari');
      $sampai = $this->input->post('sampai');
      $nama_angkutan = $this->input->post('nama_angkutan');

      $wilayah = $dari.' - '.$sampai;

      $data = array(
        'nama_wilayah' => $wilayah,
        'nama_angkutan' => $nama_angkutan
      );

      $cek = $this->M_Wilayah->insert($data);

      if($cek>=1){
  			$this->session->set_flashdata("message","
  				<div class='alert alert-success'>
  					<button type='button' class='close' data-dismiss='alert'>
  						<span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
  					</button>
  					<span><b> Success - </b> 1 Data telah ditambah.</span>
  				</div>
  			");

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

  		}

      redirect(site_url('C_Wilayah'));
  }

  public function edit_wilayah($id)
  {
    $id_wilayah= array('id_wilayah' => $id);

    $data = array(
			"title_page" => "Edit Area",
      "jumlah_pesan" => $this->M_Saran->get_jumlah(),
			"konten" => $this->M_Wilayah->get_data_where($id_wilayah)
		);

		$this->template->isi('admin/wilayah/edit_wilayah',$data);

  }

  public function proses_update_wilayah()
  {

    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $id = $this->input->post('id_wilayah');

    $nama_angkutan = $this->input->post('nama_angkutan');

    $wilayah = $dari.' - '.$sampai;

    $data = array(
      'nama_wilayah' => $wilayah,
      'nama_angkutan' => $nama_angkutan
    );

    $cek = $this->M_Wilayah->update($id, $data);

    if($cek>=1){
      $this->session->set_flashdata("message","
        <div class='alert alert-success'>
          <button type='button' class='close' data-dismiss='alert'>
            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
          </button>
          <span><b> Success - </b> Data telah diubah.</span>
        </div>
      ");

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

    }

    redirect(site_url('C_Wilayah'));
  }

  public function delete_wilayah($id)
  {

    $id_wilayah = array( 'id_wilayah' => $id );
    $res = $this->M_Wilayah->proses_delete_data($id_wilayah);

     if($res>=1){
       $this->session->set_flashdata("message","
         <div class='alert alert-success'>
           <button type='button' class='close' data-dismiss='alert'>
             <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
           </button>
           <span><b> Success - </b> 1 data telah dihapus.</span>
         </div>
       ");

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

     }

     redirect(site_url('C_Wilayah'));
  }

}
