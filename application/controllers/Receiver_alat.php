<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiver_alat extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('receiver_alat_m');
	}

	public function gel_all_data()
	{
		$data = $this->receiver_alat_m->gel_all_data();

		echo json_encode($data);
	}

	public function send(){
		$data = array();
		date_default_timezone_set("Asia/Jakarta");

		$data['key_alat'] =  $this->input->get('key_alat');
		$data['suhu'] =  $this->input->get('suhu');
		$data['co2'] =  $this->input->get('co2');
		$data['co'] =  $this->get_mg($this->input->get('co'));
		$data['kelembaban'] =  $this->input->get('kelembaban');
		$data['index_akhir'] =  round($this->cek_perhitungan($data['co']));
		$data['lat'] =  $this->input->get('lat');
		$data['lon'] =  $this->input->get('lon');
		$data['jalan'] = trim($this->Get_Address_From_Google_Maps($data['lat'], $data['lon']));
		$data['status_power'] =  $this->input->get('status_power');
		$data['suara'] =  $this->input->get('suara');

		if ($data['jalan'] != "Tidak Di ketahui") {
			if ($this->receiver_alat_m->cek_key($data['key_alat'])) {

				$jumlah_data = $this->receiver_alat_m->cek_data();

				switch (true) {
					case $jumlah_data > 0:

						$get_where = $this->receiver_alat_m->cek_jalan_ada_enggak($data['jalan']);

						if ($get_where['pesan']) {

							if ($get_where['jumlah'] > 1) {

								 $this->cek_bila_banyak_data($data['lat'], $data['lon'], $data['jalan'], $data);

							}else {
								$get_data_database = $get_where['data']->row();
								$get_jarak = $this->cari_jarak($get_data_database->lat, $get_data_database->lon,$data['lat'], $data['lon']);

								$data_pecah = explode(" ", $get_jarak);

								if (((int) $data_pecah[0] > 500 and $data_pecah[1] == "m") || $data_pecah[1] == "km") {
									echo $get_jarak;
									$this->inser_data($data);
								}else{
									echo $get_jarak;
									$this->update_co($get_data_database->id_parameter, array(
											'co' => $data['co'],
											'index_akhir' => $data['index_akhir'],
											'suhu' => $data['suhu'],
											'kelembaban' => $data['kelembaban'],
											'co2' => $data['co2'],
											'updated_at' => date("Y-m-d h:i:s")

										));
								}

							}

						}else{
							$this->inser_data($data);
						}

						break;

						case $jumlah_data == 0:
							$this->inser_data($data);

							break;
				}

			}else{
				echo "Key alat tidak di temukan";
			}
		}


	}

	public function cek_bila_banyak_data($lat_alat, $lon_alat, $kondis, $data)
	{
			$data1 = $this->receiver_alat_m->get_radius_500meter($lat_alat, $lon_alat, $kondis);

			if ($data1['pesan']) {
				if ($data1['data']->num_rows() == 1) {

					echo "Data di radius 500 meter hayany ada satu";

					$this->update_co($data['data']->row()->id_parameter, array(
							'co' => $data['co'],
							'index_akhir' => $data['index_akhir'],
							'suhu' => $data['suhu'],
							'kelembaban' => $data['kelembaban'],
							'co2' => $data['co2'],
							'updated_at' => date("Y-m-d h:i:s")

						));

				}else{

						$tempat = array();

						$nilai = null;
						$id_parameter = null;

						foreach ($data1['data']->result() as $isi) {

							$tempat_explod = explode(" ", $this->cari_jarak($lat_alat, $lon_alat, $isi->lat, $isi->lon));
							$jarak = $tempat_explod[1] == "km" ? floatval($tempat_explod[0]) * 1000 : (int) $tempat_explod[0];

							if ($nilai == null and $id_parameter == null) {
									$nilai = $jarak;
									$id_parameter = $isi->id_parameter;
							}

							if ($jarak < $nilai) {
								$nilai = $jarak;
								$id_parameter = $isi->id_parameter;
							}

							array_push($tempat, array(
								'id_parameter' => $isi->id_parameter,
								'jarak' => $tempat_explod[0],
								'satuan' => $tempat_explod[1]
							));
						}



							$this->update_co($id_parameter, array(
								'co' => $data['co'],
								'index_akhir' => $data['index_akhir'],
								'suhu' => $data['suhu'],
								'kelembaban' => $data['kelembaban'],
								'co2' => $data['co2'],
								'updated_at' => date("Y-m-d h:i:s")
							));

							echo $nilai.' '.$id_parameter;
							echo json_encode($tempat);

				}
			}else{
				echo "Data di radius 500 meter tidak ada";
				$this->inser_data($data);
			}
	}

	public function update_co($id, $data)
	{

		$this->receiver_alat_m->update_co($id, $data);
	}

	public function cari_jarak($lat_dari, $lon_dari,$lat_sampai,$lon_sampai)
	{
		$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$lat_dari.",".$lon_dari."&destinations=".$lat_sampai.",".$lon_sampai."&key=AIzaSyCpALWzkNO7VH_pCSX30bt43_7h3sIeqQI");

		$data = json_decode($dataJson,true);
		$nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];

		return $nilaiJarak;
	}

	public function inser_data($data)
	{

		$res = $this->receiver_alat_m->input($data);

		if($res>=1){
			$response["error"] = false;
		  $response["message"] = 'Berhasil insert';
		}
		else{
			$response["error"] = true;
		  $response["message"] = 'Gagal insert';
		}

		echo json_encode($response);

	}

    public function android()
		{
			$data = array();

			$data['key_alat'] =  $this->input->post('key_alat');
			$data['suhu'] =  $this->input->post('suhu');
			$data['co2'] =  $this->input->post('co2');
			$data['co'] =  $this->input->post('co');
			$data['kelembaban'] =  $this->input->post('kelembaban');
			$data['index_akhir'] =  round($this->cek_perhitungan($data['co']));
			$data['lat'] =  $this->input->post('lat');
			$data['lon'] =  $this->input->post('lon');
			$data['jalan'] = trim($this->Get_Address_From_Google_Maps($data['lat'], $data['lon']));

			$data['status_power'] =  $this->input->post('status_power');

	    $response = array();

			if ($this->receiver_alat_m->cek_key($data['key_alat'])) {

				$res = $this->receiver_alat_m->input($data);

				if($res>=1){
					$response["error"] = false;
				  $response["message"] = 'Berhasil insert';
				}
				else{
					$response["error"] = true;
					$response["message"] = 'Gagal insert';
				}


			}else{
				$response["error"] = true;
	        	$response["message"] = 'key alat tidak di temukan';
			}

	    echo json_encode($response);

		}


	public function get_mg($ppm)
	{
		$rumus1 = 0.0409;
		$rumus2 = 28.01;

		return $rumus1 * $ppm * $rumus2 ;

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

	public function cek_perhitungan($nilai)
	{


		$nilai_co = $nilai;

		$kesimpulan = '';
		$nilai_ia = 0;
		$nilai_ib = 0;
		$nilai_Xa = 0;
		$nilai_Xb = 0;
		$nilai_Xx = 0;

		if ($nilai_co >= 0 and $nilai_co <= 5 ) {
			$nilai_ia = 50;
			$nilai_ib = 0;
			$nilai_Xa = 5;
			$nilai_Xb = 0;
		}else if($nilai_co > 5 and $nilai_co <= 10){
			$nilai_ia = 100;
			$nilai_ib = 50;
			$nilai_Xa = 10;
			$nilai_Xb = 5;
		}else if($nilai_co > 10 and $nilai_co <= 17){
			$nilai_ia = 200;
			$nilai_ib = 100;
			$nilai_Xa = 17;
			$nilai_Xb = 10;
		}elseif ($nilai_co > 17 and $nilai_co <= 34) {
			$nilai_ia = 300;
			$nilai_ib = 200;
			$nilai_Xa = 34;
			$nilai_Xb = 17;
		}elseif ($nilai_co > 34 and $nilai_co <= 46) {
			$nilai_ia = 400;
			$nilai_ib = 300;
			$nilai_Xa = 46;
			$nilai_Xb = 34;
		}
		elseif ($nilai_co > 46 and $nilai_co <= 57.5) {
			$nilai_ia = 500;
			$nilai_ib = 400;
			$nilai_Xa = 57.5;
			$nilai_Xb = 46;
		}

		$hasil_kurang_ia_ib = $nilai_ia - $nilai_ib;
		$hasil_kurang_xa_xb = $nilai_Xa - $nilai_Xb;
		$hasil_kali_xx_xb = $nilai_co - $nilai_Xb;

		$hasil_akhir = (($hasil_kurang_ia_ib * $hasil_kali_xx_xb) / $hasil_kurang_xa_xb ) + $nilai_ib;

		return $hasil_akhir;
		// switch ($hasil_akhir) {
			// case ($hasil_akhir >= 1 and $hasil_akhir <= 50):
			// 	$kesimpulan ="Baik";
			// 	break;
			// case ($hasil_akhir >= 51 and $hasil_akhir <= 100):
			// 	$kesimpulan ="Sedang";
			// 	break;
			// case ($hasil_akhir >= 101 and $hasil_akhir <= 199):
			// 	$kesimpulan ="Tidak Sehat";
			// 	break;
			// case ($hasil_akhir >= 200 and $hasil_akhir <= 299):
			// 	$kesimpulan ="Sangat Tidak Sehat";
			// 	break;
			// case ($hasil_akhir >= 300 ):
			// 	$kesimpulan ="Berbahaya";
			// 	break;
		// }
		//
		// $data['nilai_ia'] = $nilai_ia;
		// $data['nilai_ib'] = $nilai_ib;
		// $data['nilai_xa'] = $nilai_Xa;
		// $data['nilai_xb'] = $nilai_Xb;
		//
		// $data['nilai_akhir'] = $hasil_akhir;
		// $data['kesimpulan'] = $kesimpulan;
		//
		// echo json_encode($data);

	}

}
