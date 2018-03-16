<div class="content">
	<div class="container-fluid">
		<div class="card card-map">
			<div class="header">
				<h4 class="title">Map</h4>
			</div>
			<div id="cari" style="width:500px;margin-top:10px;">
					<div class="row">
						<div class="col-md-8">
							<div class="card">
									<div class="content">
											<div class="form-group">
												<label for="">Cari lokasi</label>
												<select class="form-control  border-input" id="form_cari">

												</select>
											</div>
									</div>
				 			</div>
						</div>
				</div>
				<div class="row">
						<div class="col-md-8">
							<div class="panel panel-info">
									<div class="panel-heading">
											<h4 class="panel-title">Nilai rata2 kadar co </h4>
									</div>
									<div class="panel-body" style="padding:10px !important;height:260px;overflow-y:scroll;">
											<table class="table table-bordered table-striped table-hover">
												<thead>
														<tr>
															<th><b>Jalan</b></th>
															<th><b>Ispu</b></th>
															<th><b>Parameter</b></th>
														</tr>
												</thead>
												<tbody id="tempat_body">

												</tbody>

											</table>
									</div>
							</div>
						</div>
				</div>
			</div>
			<div class="map">
				<div id="map"></div>
			</div>
		</div>
	</div>
</div>

<script>
					$(document).ready(function(){
							get_avrg()
					});

					var map, infoWindow, bounds;
					var markers = [];

					function initMap() {

								var cari = document.getElementById('cari');

								var mapCanvas = document.getElementById('map');

							  var mapOptions = {
					          mapTypeId: google.maps.MapTypeId.ROADMAP,
							  		center:new google.maps.LatLng(-6.9094426,107.6248946),
										zoom:10,
										mapTypeControl: false
				        }

				        map = new google.maps.Map(mapCanvas, mapOptions);

								map.controls[google.maps.ControlPosition.TOP_LEFT].push(cari);

								infoWindow = new google.maps.InfoWindow;
				        bounds = new google.maps.LatLngBounds();

								get_data();



	        } // Tutup function initMap

					function addMarker(Lat, Lng, jalan, created_at,suhu,gas,kelembaban,suara,index_akhir1) {
						 var pt = new google.maps.LatLng(Lat, Lng);
						 var marker;
             marker = 0;

						 bounds.extend(pt);
						 var index_akhir = parseInt(index_akhir1);
						 var url_icon = '';
						 var status = '';
						 var saran = 'Di anjurkan memakai masker';
						 var color = '#3d3d3d';
						 var saran = '';
						 var status_suara = fun_suara(suara);
						 var font_color = '';

						 switch (true) {
							 case index_akhir >= 1 && index_akhir <= 50:
								 url_icon = '<?= base_url() ?>assets/img/icon/marker_Green.png';
								 status = "BAIK";
								 saran = 'Area yang anda lalui dinyatakan Bersih dari pencemaran udara Carbonmonoksida';
		             font_color = 'green';


								 break;
							 case index_akhir >= 51 && index_akhir <= 100:
								 url_icon ='<?= base_url() ?>assets/img/icon/marker_Blue.png';
								 status = "SEDANG";
								 saran = 'Siaga, anda memasuki Area yang mengalami pencemaran udara Carbonmonoksida dalam kadar rendah, kurangi aktifitas diluar rumah. Kami sarankan menggunakan masker saat berpergian. ';
		             font_color = 'blue';


								 break;
							 case index_akhir >= 101 && index_akhir <= 199:
								 url_icon = '<?= base_url() ?>assets/img/icon/marker_Yellow.png';
								 status = "TIDAK SEHAT";
								 saran='Area ini dalam kondisi tercemar, gunakan masker saat berpergian, hindari Area ini';
		             font_color = 'yellow';


								 break;
							 case index_akhir >= 200 && index_akhir <= 299:
								 url_icon ='<?= base_url() ?>assets/img/icon/marker_Red.png';
								 status = "SANGAT TIDAK SEHAT";
								 saran = 'Area TIDAK SEHAT, segera keluar dari Area ini.';
		             font_color = 'red';


								 break;
							 case index_akhir >= 300 :
								 url_icon ='<?= base_url() ?>assets/img/icon/marker_Black.png';
								 status = "BERBAHAYA";
								 color = "white";
								 saran = 'BERBAHAYA. Area ini memiliki kandungan pencemaran carbonmonoksida kadar tinggi. Tinggalkan area ini.';
		             font_color = 'black';

								 break;

							 default:console.log('gagal');

						 }


						 marker = new google.maps.Marker({
								 map: map,
								 position: pt,
								 title : jalan,
								 label: {
									 	text: ''+index_akhir+'',
										color: color
									},
								 icon: {
									 url: url_icon, // image is 512 x 512
									 scaledSize : new google.maps.Size(75, 75)
								 }
						 });

						 // if (status  === "SANGAT TIDAK SEHAT" || status  === "BERBAHAYA") {
							//  	marker.setAnimation(google.maps.Animation.BOUNCE);
						 // }


						 map.fitBounds(bounds);

						 var data = '<div class="content_info">'+
							 '<h3 class="firstHeading">'+ created_at +'</h3>'+
							 '<div id="bodyContent">'+
							 '<p>CO2 : ' + gas + '<br/>' +
							 'Suhu : ' + suhu + ' &#8451;<br/>' +
							 'Kelembaban : ' + kelembaban + ' RH<br/>' +
							 'CO : ' + index_akhir + '<br/>' +
							 'Status : ' + status + ' <br/>' +
							 'Status Kebisingan : ' + status_suara + ' <br/>' +
							 '</p>'+
							 '<p><font color="'+font_color+'">'+ saran +'</font></p>'
							 '</div>'+
						 '</div>';


					 var infoWindow = new google.maps.InfoWindow({
							 content: data, maxwidth : 400
							 });

					 google.maps.event.addListener(marker, 'click', function() {
						 infoWindow.open(map,marker);
					 });



						 google.maps.event.addListener(marker,'dblclick',function() {
							 map.setZoom(13);
							 map.setCenter(marker.getPosition());
						 });

						 markers.push(marker);

						 return marker;

					 } // Tutup function addMarker

					 function cek($data) {
						 	alert($data);
					 }

					 function fun_suara(suara) {
						 var status = '';

						 switch (true) {
							 case suara >= 50 && suara <= 84:

								 status = "AMAN";

								 break;
							 case suara >= 85 && suara <= 104:

								 status = "SEDANG";
								 break;
							 case suara >= 105 && suara <= 129:

								 status = "WASPADA";


								 break;
							 case suara >= 130 && suara <= 160:

								 status = "BERBAHAYA";

								 break;

								 case suara >160:

									 status = "BERBAHAYA";

									 break;

						 }

						 return status;

					 }

					function get_data($data = null) {

							clear_lokasi();

							var kondisi = '';

							if ($data == null || $data == "all") {
								kondisi = "all";
							}else{
								kondisi = $data;
							}

							$.ajax({
									url:'<?= base_url() ?>index.php/Adminxmaps/get_data',
									method:'POST',
									data:{kondisi:kondisi},
									dataType:'JSON',
									success:function(data){
										if (data.data.length > 0) {
											for (var i = 0; i < data.data.length; i++) {
												addMarker(data.data[i]['lat'], data.data[i]['lon'], data.data[i]['jalan'], data.data[i]['created_at'], data.data[i]['suhu'], data.data[i]['co2'],data.data[i]['kelembaban'],data.data[i]['suara'],data.data[i]['index_akhir']);
											}
										}else{
											console.log('Kosong');
										}
									}
							})
					}

					function clear_lokasi() {
						if (markers.length > 0) {
							// infoWindow = new google.maps.InfoWindow();
							infoWindow.close();
							for (var i = 0; i < markers.length; i++) {
									markers[i].setMap(null);
							}
							markers.length = 0;
						}
					}

					function get_avrg($data = null) {

						var select_tbody = $('#tempat_body');
					  var html = "";

						var kondisi = '';

						if ($data == null || $data == "all") {
							kondisi = "all";
						}else{
							kondisi = $data;
						}

						$.ajax({
							url:'<?= base_url() ?>index.php/adminxmaps/get_avrg',
							method:'POST',
							dataType:'JSON',
							data:{kondisi:kondisi},
							success:function(data){
									if (data.jalan.length > 0) {
										for (var i = 0; i < data.jalan.length; i++)
										 {

											 var color = getColor(data.avrg[i].rata_rata);

												html +="<tr>";
														html +="<td>"+data.jalan[i].jalan+"</td>";
														html +="<td><span class='badge' style='background-color:"+color+";'>"+parseInt(data.avrg[i].rata_rata)+"</span></td>";
														html +="<td>co2</td>";
												html +="</tr>";
										}
									}else{
										html +="<tr>";
												html +="<td>Data kosong</td>";
										html +="</tr>";
									}

									select_tbody.html(html).fadeIn("slow");
							}
						});
					}

					function getColor(d) {

						return d >= 1 && d <= 50 ? 'green' :
								d >= 51 && d <= 100  ? 'blue' :
								d >= 101 && d <= 199  ? 'yellow' :
								d >= 200 && d <= 299  ? 'red' :
								d >= 300  ? 'black':'white';

					}

					$('#form_cari').on('change', function() {
							var data = $(this).val();
							get_data(data);
							get_avrg(data);
					});


    </script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpALWzkNO7VH_pCSX30bt43_7h3sIeqQI&libraries=places&callback=initMap&libraries=places&sensor=false">
</script>
