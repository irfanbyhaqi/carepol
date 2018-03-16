<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Frontend extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('maps_m');
    $this->load->model('user_m');
    $this->load->model('alat_m');
    $this->load->model('receiver_alat_m');


  }

  function index()
  {
      $this->load->view('user/dashboard');
  }

  public function get_data()
	{
		$kondisi = $this->input->post('kondisi');

		$data = array(
			'data' => $this->maps_m->frontend_get_avrg($kondisi)
		);

		echo json_encode($data);

	}

  public function get_jalan()
	{
		$data = $this->maps_m->get_jalan();

		$data = array(
			'jalan' =>  $data
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

  public function send_koment()
  {

    $jalan = $this->input->post('jalan');
    $nama = $this->input->post('nama');
    $koment = $this->input->post('koment');

    $data = array(
      'nama' => $nama,
      'lokasi' => $jalan,
      'komentar' => $koment
    );

    $this->maps_m->send_koment($data);

  }

  public function view_android()
  {
    $this->load->view('user/view_android');
  }

  public function get_android()
  {
    $data = $this->maps_m->get_data_alat();

    echo json_encode($data);
  }

  public function proses_tambah_user(){

		$tgl_lahir = $this->input->post('tahun')."/".$this->input->post('bulan')."/".$this->input->post('tanggal');

		$data['tgl_lahir']=$tgl_lahir;
		$data['password'] = md5($this->input->post('password'));
    $data['pekerjaan'] = $this->input->post('pekerjaan');
    $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
    $data['alamat'] = $this->input->post('alamat');
    $data['no_kontak'] = $this->input->post('no_kontak');
    $data['email'] = $this->input->post('email');
    $data['nama_pengguna'] = $this->input->post('nama_pengguna');
    $data['username'] = $this->input->post('username');
    $data['id_alat'] = $this->input->post('key_alat');
		$data['status']="User";

		$res = $this->user_m->proses_input_data($data);

    $data['id_pengguna'] = $this->db->insert_id();

    $response = array();

		if($res >= 1){
      $response['error'] = false;
      $response['message'] = "Berhasil insert";
      $response['data'] = $data;
		}
		else{
      $response['error'] = true;
      $response['message'] = "Gagal insert";
		}

    echo json_encode($response);
	}

  public function get_keyalat()
  {
    $data = $this->alat_m->get_key_alat();

    echo json_encode($data);
  }

  public function get_radius_android()
  {
    $response = array();

    $lat = $this->input->post('lat');
    $lon = $this->input->post('lon');

    $jalan = $this->Get_Address_From_Google_Maps($lat, $lon);

    if ($jalan != 'Tidak Di ketahui') {

       $get_where = $this->receiver_alat_m->cek_jalan_ada_enggak($jalan);

       if ($get_where['pesan']) {
          $data = $this->receiver_alat_m->get_rata_rata_jalan($lat, $lon, $jalan);
          $nama_data = $data['data']->row_array();
          $response['error'] = false;
          $response['message'] = "Berhasil";
          $response['data'] = array(
            ''
          );

       }else{
         $response['error'] = true;
         $response['message'] = "Tidak ada data";
       }
    }else{
      $response['error'] = true;
      $response['message'] = "Jalan tidak diketahui";
    }

    echo json_encode($response);

  }

  public function android_login()
  {
    $kondisi = array(
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password'))
    );

    $data = $this->user_m->android_login($kondisi);

    echo json_encode($data);
  }


  function Get_Address_From_Google_Maps($lat, $lon) {

  		$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";

  		// Make the HTTP request
  		$data = @file_get_contents($url);
  		// Parse the json response
  		$jsondata = json_decode($data,true);

  		// If the json data is invalid, return empty array
  		if (!$this->check_status($jsondata))   return "Tidak Di ketahui";

  			return $this->google_getStreet($jsondata);
  	}

  	function check_status($jsondata) {
      if ($jsondata["status"] == "OK") return true;
      return false;
  	}

  	function google_getStreet($jsondata) {
      	return $this->Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
  	}

  	function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
      foreach( $array as $value) {
          if (in_array($type, $value["types"])) {
              if ($short_name)
                  return $value["short_name"];
              return $value["long_name"];
          }
      }
  	}

    public function send_notif()
    {
      $lat = $this->input->post('lat');
      $lon = $this->input->post('lon');

      $data = $this->receiver_alat_m->get_notif($lat,$lon);

      if ($data['pesan']) {
          if ($data['data']->num_rows() == 1) {
            $get_data = $data['data']->row();
            $index_akhir = $get_data->index_akhir;

            $status = $this->cek_index($index_akhir);

            if ($index_akhir >= 101 and $index_akhir <= 299) {

               gcm('Keadaan '.$status,'Kadar CO di '.$get_data->jalan);
            }else if ($index_akhir >= 300) {
              gcm('Keadaan '.$status,'Kadar CO di '.$get_data->jalan);
            }

          }else{
            foreach ($data['data']->result() as $isi) {

                $status = $this->cek_index($isi->index_akhir);

                if ($isi->index_akhir >= 101 and $isi->index_akhir <= 299) {
                  gcm('Keadaan '.$status,'Kadar CO di '.$isi->jalan);
                }else if ($isi->index_akhir >= 300) {
                  gcm('Keadaan '.$status,'Kadar CO di '.$isi->jalan);
                }
            }
          }
      }

    }

    public function cek_index($index_akhir)
    {
        switch (true) {
          case $index_akhir >= 1 && $index_akhir <= 50:
               return "BAIK";
            break;

          case $index_akhir >= 51 && $index_akhir <= 100:
              return "SEDANG";
            break;

          case $index_akhir >= 101 && $index_akhir <= 199:
              return "TIDAK SEHAT";
            break;

          case $index_akhir >= 200 && $index_akhir <= 299:
              return "SANGAT TIDAK SEHAT";
           break;

          case $index_akhir >= 300:
              return "BERBAHAYA";
           break;

        }
    }

    public function latihan_kirim()
    {

      $nim = $this->input->post('nim');
      $mahasiswa = $this->input->post('mahasiswa');
      $prodi = $this->input->post('prodi');
      $jurusan = $this->input->post('jurusan');

      $data = array(
        'nim' => $nim,
        'mahasiswa' => $mahasiswa,
        'prodi' => $prodi,
        'jurusan' => $jurusan
      );

      $res = $this->db->insert('coba', $data);

      $response = array();

  		if($res >= 1){
        $response['error'] = false;
        $response['message'] = "Berhasil insert";
        $response['data'] = $data;
  		}
  		else{
        $response['error'] = true;
        $response['message'] = "Gagal insert";
  		}

      echo json_encode($response);

    }

    public function update_android()
    {
      $kondis['id_pengguna'] = $this->input->post('id_pengguna');

      $data['tgl_lahir']= $this->input->post('tgl_lahir');
  		$password = $this->input->post('password');
      $data['pekerjaan'] = $this->input->post('pekerjaan');
      $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
      $data['alamat'] = $this->input->post('alamat');
      $data['no_kontak'] = $this->input->post('no_kontak');
      $data['email'] = $this->input->post('email');
      $data['nama_pengguna'] = $this->input->post('nama_pengguna');
      $data['username'] = $this->input->post('username');

      $hasil = $this->user_m->update_android($kondis, $data);

      echo json_encode($hasil);

    }

    public function update_image()
    {
      $kondisi = array(
        'id_pengguna' => $this->input->post('id_pengguna')
      );

      $image = $_POST['image'];

      $name = time();

      $path = "assets/img/android_gambar/".$name.".png";
      $actualpath = 'https://ergunikom.com/assets/img/android_gambar/'.$name;

      $data = array(
        'image' => $actualpath
      );

      $hasil = $this->user_m->update_android($kondisi, $data);

      if (!$hasil['error']) {
        file_put_contents($path,base64_decode($image));
        echo json_encode($hasil);
      }else{
        echo json_encode($hasil);
      }
    }

}
