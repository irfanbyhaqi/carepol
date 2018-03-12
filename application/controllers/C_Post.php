<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Post extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('template');
    $this->load->helper('url_helper');

    $this->load->library('form_validation');


		// jika belum login redirect ke login
		if ($this->session->userdata('logged') <> 1) {
			redirect(site_url('login'));
		}

    $this->load->model(array('M_Post'));

    if ($this->M_Post->cek_jumlah_category() == 0) {
      $this->session->set_flashdata("message","
        <div class='col-md-8 alert alert-danger'>
          <button type='button' class='close' data-dismiss='alert'>
            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
          </button>
          You must fill the data category first
        </div>
      ");

      return redirect(site_url('C_Category'));
    }

  }

  function index()
  {
    $data = array(
      "title_page" => "Post",
      "konten" => $this->M_Post->get_data(),
      "active_menu_post" => "active"
    );

    $this->template->isi('admin/post/post',$data);
  }

  public function tambah_post()
  {
    $data = array(
      "title_page" => "Post",
      "category" => $this->M_Post->get_category(),
      "active_menu_post" => "active"
    );

    $this->template->isi('admin/post/add_post',$data);
  }

  public function proses_tambah_post()
  {
    $this->form_validation->set_rules('title', 'Title', 'required|max_length[50]');
    $this->form_validation->set_rules('category', 'Category', 'required');
    $this->form_validation->set_rules('content', 'Content', 'required');


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

      return redirect(site_url('C_Post/tambah_post'));
    }
    else
    {

                $nama = 'gbr_'.time();
                $config['upload_path']          = './assets/img/upload/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 50000;
                $config['max_height']           = 50000;
                $config['file_name']            = $nama;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar'))
                {

                        $this->session->set_flashdata("message","
                          <div class='col-md-8 alert alert-danger'>
                            <button type='button' class='close' data-dismiss='alert'>
                              <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
                            </button>
                            ".$this->upload->display_errors()."
                          </div>
                        ");

                        return redirect(site_url('C_Post/tambah_post'));
                }
                else
                {
                    date_default_timezone_set('Asia/Jakarta');
                    $arrayName = array(
                      'title' => $this->input->post('title'),
                      'category_id' => $this->input->post('category'),
                      'created_at' => date('Y-m-d H:i:s'),
                      'image' => $this->upload->data()['file_name'],
                      'content' => $this->input->post('content')
                    );

                    $data = $this->M_Post->insert_post($arrayName);

                    if ($data >= 1) {
                      $this->session->set_flashdata("message","
                        <div class='alert alert-success'>
                          <button type='button' class='close' data-dismiss='alert'>
                            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
                          </button>
                          Success insert data
                        </div>
                      ");

                      return redirect(site_url('C_Post'));
                    }
                }

    }
  }

  public function view_post($id)
  {

    $data = array(
      "title_page" => "Post",
      "category" => $this->M_Post->get_category(),
      "konten" => $this->M_Post->get_data_where(array('id' => $id)),
      "active_menu_post" => "active"
    );

    $this->template->isi('admin/post/view_post',$data);
  }

  public function delete_post($id)
  {
      $kondisi = array(
        'id' => $id
      );

      $get_data = $this->M_Post->get_data_where(array('id' => $id));

      if (file_exists("./assets/img/upload/".$get_data['image'])) {
        unlink("./assets/img/upload/".$get_data['image']);
      }

      $data = $this->M_Post->delete_post($kondisi);

      if ($data >= 1) {
        $this->session->set_flashdata("message","
          <div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>
              <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
            </button>
            Success deleted data
          </div>
        ");



        return redirect(site_url('C_Post'));
      }
  }

  public function edit_post($id)
  {
    $id_pengguna = array('id' => $id);
    $data = array(
			"title_page" => "Edit Post",
      "active_menu_category" => "active",
      "category" => $this->M_Post->get_category(),
			"konten" => $this->M_Post->get_data_where($id_pengguna)
		);



    $this->template->isi('admin/post/edit_post',$data);
  }

  public function proses_edit_post($id)
  {
    $this->form_validation->set_rules('title', 'Title', 'required|max_length[50]');
    $this->form_validation->set_rules('category', 'Category', 'required');
    $this->form_validation->set_rules('content', 'Content', 'required');


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

      return redirect(site_url('C_Post/edit_post/'.$id));
    }
    else
    {

      $get_data = $this->M_Post->get_data_where(array('id' => $id));


      if ($_FILES['gambar']['name'] != "") {

        if (file_exists("./assets/img/upload/".$get_data['image'])) {
  				unlink("./assets/img/upload/".$get_data['image']);
  			}

        $nama = 'gbr_'.time();
        $config['upload_path']          = './assets/img/upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 50000;
        $config['max_height']           = 50000;
        $config['file_name']            = $nama;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('gambar'))
        {

                $this->session->set_flashdata("message","
                  <div class='col-md-8 alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>
                      <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
                    </button>
                    ".$this->upload->display_errors()."
                  </div>
                ");

                return redirect(site_url('C_Post/edit_post/'.$id));
        }
        else
        {
            date_default_timezone_set('Asia/Jakarta');
            $kondisi = array(
              'id' => $id
            );

            $arrayName = array(
              'title' => $this->input->post('title'),
              'category_id' => $this->input->post('category'),
              'updated_at' => date('Y-m-d H:i:s'),
              'image' => $this->upload->data()['file_name'],
              'content' => $this->input->post('content')
            );

            $data = $this->M_Post->update_post($kondisi, $arrayName);

            if ($data >= 1) {
              $this->session->set_flashdata("message","
                <div class='col-md-8 alert alert-success'>
                  <button type='button' class='close' data-dismiss='alert'>
                    <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
                  </button>
                  Success updated data
                </div>
              ");

              return redirect(site_url('C_Post'));
            }
        }

      }else{
        date_default_timezone_set('Asia/Jakarta');
        $kondisi = array(
          'id' => $id
        );

        $arrayName = array(
          'title' => $this->input->post('title'),
          'category_id' => $this->input->post('category'),
          'updated_at' => date('Y-m-d H:i:s'),
          'content' => $this->input->post('content')
        );

        $data = $this->M_Post->update_post($kondisi, $arrayName);
        if ($data >= 1) {
          $this->session->set_flashdata("message","
            <div class='col-md-8 alert alert-success'>
              <button type='button' class='close' data-dismiss='alert'>
                <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
              </button>
              Success updated data
            </div>
          ");

          return redirect(site_url('C_Post'));
        }

      }

    }
  }

}
