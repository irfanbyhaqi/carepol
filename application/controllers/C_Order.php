<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Order extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    //untuk template
		$this->load->library('template');

    $this->load->library('form_validation');
    date_default_timezone_set('Asia/Jakarta');


    $this->load->model(array('M_Order','alat_m'));
  }

  function index()
  {

    $data = array(
      "title_page" => "Order",
      "konten" => $this->M_Order->get_data(),
      "active_menu_order" => "active"
    );

    $this->template->isi('admin/order/order',$data);
  }

  public function get_jumlah_order()
  {
    $data = $this->M_Order->get_jumlah_order();

    echo $data;
  }

  public function insert_order()
  {

    $this->kombinasi_acak();

    $key = $this->M_Order->get_key_alat();

    $pass = $this->session->userdata('kom_acak');

    $data['nama_pengguna'] = $this->input->post('nama_depan').' '.$this->input->post('nama_belakang');
    $data['id_alat'] = $key->num_rows() > 0 ? $key->row()->id_alat : $this->buat_key();
    $data['username'] = strtolower(str_replace(' ', '',$this->input->post('nama_depan').''.rand(5, 15)));
    $data['password'] = md5($pass);
    $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
    $data['tgl_lahir'] = null;
    $data['alamat'] = $this->input->post('alamat');
    $data['no_kontak'] = $this->input->post('no_kontak');
      $data['pekerjaan'] = $this->input->post('pekerjaan');
    $data['email'] = $this->input->post('email');
    $data['status'] = "User";

    $this->M_Order->insert_pengguna($data);

    $data1['id_pengguna'] = $this->db->insert_id();
    $data1['jumlah'] = $this->input->post('jumlah');
    $data1['total'] = $this->input->post('jumlah') * 200000;
    $data1['created_at'] = date('Y-m-d H:i:s');

    $cek = $this->M_Order->insert_order($data1);

    if ($cek >= 1) {
      $this->send_email($data, $data1, $this->db->insert_id());

      $this->session->set_userdata('berhasil_order','Thank you for order, please check your email to confirm payment, and activate your account');

      redirect(site_url('C_Frontend'));
    }


  }

  public function send_email($data, $data1, $id)
  {

    $this->load->library('email');
    $subject = 'Product Ordering';
    $url = base_url('index.php/C_Order/cek_konfirmasi/'.$id.'/'.$data['password']);
    $message = '
    <p>Hai '.$data['nama_pengguna'].', Thank you for ordering our products</p>
    Please transfer to the bank below:<br>
    Mandiri: 22345677554 - Muhamad irfan<br>
    BNI: 455653434 - Muhamad irfan<br>
    BCA: 455653434 - Muhamad irfan<br>
    <p>Ensure confiration through the link in this take to get the user and passwod</p>
    '.$url.'
    ';

// Get full html:
    $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
        <title>' . html_escape($subject) . '</title>
        <style type="text/css">
            body {
                font-family: Arial, Verdana, Helvetica, sans-serif;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
    ' . $message . '
    </body>
    </html>';

    $result = $this->email
    ->from('carepolerg@gmail.com','Carepol')
    ->reply_to('carepolerg@gmail.com')    // Optional, an account where a human being reads.
    ->to($data['email'])
    ->subject($subject)
    ->message($body)
    ->send();

  }

  public function buat_key()
  {
    $data['key_alat']= time();
    $data['wilayah'] = $this->M_Order->get_all_wilayah();

		$this->alat_m->proses_input_data($data);

    return $this->db->insert_id();
  }

  public function konfirmasi($id)
  {
    $kondisi = array(
      'id_order' => $id
    );
    $data = array(
      'konfirmasi' => 1
    );

    $cek = $this->M_Order->konfirmasi($kondisi, $data);

    if ($cek >= 1) {

      $cek_data = $this->M_Order->cek_data_order($kondisi);

      $this->load->library('email');

      $subject = 'Admin confirmation';
      $url = base_url('index.php/C_Login');
      $message = '
      <p>Hai <b>'.$cek_data->nama_pengguna.',</b></p>
      Your request we have received, we will immediately pack your tools and will send it.<br>
      delivery will take approximately 5 days:<br>
      <p>
      If anyone wants to inquire please contact us<br>
      phone number : 087727226272<br>
      email : carepolerg@gamail.com<br>
      </p>

      ';

  // Get full html:
      $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
          <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
          <title>' . html_escape($subject) . '</title>
          <style type="text/css">
              body {
                  font-family: Arial, Verdana, Helvetica, sans-serif;
                  font-size: 16px;
              }
          </style>
      </head>
      <body>
      ' . $message . '
      </body>
      </html>';

      $result = $this->email
      ->from('carepolerg@gmail.com','Carepol')
      ->reply_to('carepolerg@gmail.com')    // Optional, an account where a human being reads.
      ->to($cek_data->email)
      ->subject($subject)
      ->message($body)
      ->send();

      $this->session->set_flashdata("message","
        <div class='alert alert-success'>
          <button type='button' class='close' data-dismiss='alert'>
            <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span>
          </button>
          Success confirmation
        </div>
      ");

      return redirect(site_url('C_Order'));
    }
  }

  public function get_where_pengguna()
  {
    $data = array(
      'pengguna.id_pengguna' => $this->input->post('id_pengguna')
    );

    echo json_encode($this->M_Order->get_data_where($data));
  }

  public function cek_konfirmasi()
  {
    $id = $this->uri->segment(3);
    $user = $this->uri->segment(4);

    $kondisi = array(
      'order.id_order' => $id,
      'pengguna.password' => $user
    );

    $db = $this->M_Order->cek_db($kondisi);

    if ($db->num_rows() == 0) {
      $this->load->view('errors/html/buatan');
    }else{
      $this->load->view('admin/konfirmasi/konfirmasi', array('data' => $db->row()));
    }

  }

  public function send_konfirmasi($id, $user)
  {
    $this->form_validation->set_rules('tanggal', 'Date', 'required');


    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata("message","
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>".validation_errors()."</strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      ");

      return redirect(site_url('C_Order/cek_konfirmasi/'.$id.'/'.$user));
    }
    else
    {

      $nama = 'gbr_'.time();
      $config['upload_path']          = './assets/img/sementara/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 100;
      $config['max_width']            = 50000;
      $config['max_height']           = 50000;
      $config['file_name']            = $nama;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('gambar'))
      {
        $this->session->set_flashdata("message","
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>".$this->upload->display_errors()."</strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>


        ");

        return redirect(site_url('C_Order/cek_konfirmasi/'.$id.'/'.$user));
      }
      else
      {
        $gbr = $this->upload->data();

        $config2['image_library'] = 'gd2';
        $config2['source_image'] = $this->upload->upload_path.$gbr['file_name'];
        $config2['new_image'] = 'assets/img/upload/'.$gbr['file_name']; // folder tempat menyimpan hasil resize
        $config2['maintain_ratio'] = TRUE;
        $config2['width'] = 1000; //lebar setelah resize menjadi 100 px
        $config2['height'] = 1000; //lebar setelah resize menjadi 100 px
        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($config2);

        $this->image_lib->resize();

        @unlink( $this->upload->upload_path.$gbr['file_name']);

        $kondisi = array(
          'id_order' => $id,
        );

        $data = array(
          'status_bayar' => $gbr['file_name'],
          'updated_at' => $this->input->post('tanggal')
        );
        $cek_data = $this->M_Order->cek_data_order($kondisi);

        $cek = $this->M_Order->update_status_bayar($kondisi, $data);
        if ($cek >= 1) {

          $this->load->library('email');

          $subject = 'Payment confirmation';
          $url = base_url('index.php/C_Login');
          $message = '
          <p>Hai '.$cek_data->nama_pengguna.',</p>
          Thank you for confirming payment, now you can login using:<br>
          Device id : '.$cek_data->key_alat.'<br>
          Username  : '.$cek_data->username.'<br>
          password  : '.$this->session->userdata('kom_acak').'<br>
          <p>use this <a href='.$url.'>link</a> to login, hopefully be a pioneer to better maintain air quality around us.</p>

          ';

      // Get full html:
          $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
              <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
              <title>' . html_escape($subject) . '</title>
              <style type="text/css">
                  body {
                      font-family: Arial, Verdana, Helvetica, sans-serif;
                      font-size: 16px;
                  }
              </style>
          </head>
          <body>
          ' . $message . '
          </body>
          </html>';

          $result = $this->email
          ->from('carepolerg@gmail.com','Carepol')
          ->reply_to('carepolerg@gmail.com')    // Optional, an account where a human being reads.
          ->to($cek_data->email)
          ->subject($subject)
          ->message($body)
          ->send();

          redirect(site_url('C_Order/cek_konfirmasi/'.$id.'/'.$user));
        }
      }
    }
  }

  public function kombinasi_acak()
  {
    $result = "";

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ0123456789";

    $charArray = str_split($chars);

    for($i = 0; $i < 7; $i++){

      $randItem = array_rand($charArray);

      $result .= "".$charArray[$randItem];
    }

    $this->session->set_userdata('kom_acak', $result);

  }


}
