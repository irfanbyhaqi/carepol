<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Category extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    //untuk template
		$this->load->library('template');

    $this->load->library('form_validation');

		// jika belum login redirect ke login
		if ($this->session->userdata('logged') <> 1) {
			redirect(site_url('login'));
		}

    $this->load->model(array('M_Category'));

  }

  function index()
  {
    $data = array(
      "title_page" => "Category",
      "konten" => $this->M_Category->get_data(),
      "active_menu_category" => "active"
    );

    $this->template->isi('admin/category/category',$data);
  }

  public function tambah_category()
  {
    $data = array(
      "title_page" => "Category",
      "active_menu_category" => "active"
    );

    $this->template->isi('admin/category/add_category',$data);
  }

  public function proses_tambah_category()
  {
    $this->form_validation->set_rules('category', 'Category', 'required|is_unique[category.name]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata("message","
        <div class='col-md-8 alert alert-danger'>
          <button type='button' class='close' data-dismiss='alert'>
            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
          </button>
          ".validation_errors()."
        </div>
      ");

      return redirect(site_url('C_Category/tambah_category'));
    }
    else
    {
      date_default_timezone_set('Asia/Jakarta');
      $data = $this->M_Category->insert_category(array('name' => $this->input->post('category'), 'created_at' => date('Y-m-d H:i:s')));

      if ($data >= 1) {
        $this->session->set_flashdata("message","
          <div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>
              <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
            </button>
            Success insert data
          </div>
        ");

        return redirect(site_url('C_Category'));
      }
    }

  }

  public function edit_category($id)
  {
    $id_pengguna = array('id' => $id);
    $data = array(
			"title_page" => "Edit Category",
      "active_menu_category" => "active",
			"konten" => $this->M_Category->get_data_where($id_pengguna)
		);

    $this->template->isi('admin/category/edit_category',$data);

  }

  public function proses_edit_category($id)
  {

    $this->form_validation->set_rules('category', 'Category', 'required|is_unique[category.name]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata("message","
        <div class='col-md-8 alert alert-danger'>
          <button type='button' class='close' data-dismiss='alert'>
            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
          </button>
          ".validation_errors()."
        </div>
      ");

      return redirect(site_url('C_Category/edit_category/'.$id));
    }
    else
    {

      $kondisi = array(
        'id' => $id
      );

      $data = array(
        'name' => $this->input->post('category')
      );

      $data = $this->M_Category->update_category($kondisi, $data);

      if ($data >= 1) {
        $this->session->set_flashdata("message","
          <div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>
              <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
            </button>
            Success updated data
          </div>
        ");

        return redirect(site_url('C_Category'));

      }
    }
  }

  public function delete_category($id)
  {
    $kondisi = array(
      'id' => $id
    );

    $data = $this->M_Category->delete_category($kondisi);

    if ($data >= 1) {
      $this->session->set_flashdata("message","
        <div class='alert alert-success'>
          <button type='button' class='close' data-dismiss='alert'>
            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
          </button>
          Success deleted data
        </div>
      ");

      return redirect(site_url('C_Category'));

    }

  }

}
