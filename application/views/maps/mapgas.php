<div class="content">
	<div class="container-fluid">
		<div class="btn-group">
		  <a href="<?php echo base_url('index.php/user/mapSuhu'); ?>" type="button" class="btn btn-primary">Suhu</a>
		  <a href="<?php echo base_url('index.php/user/mapGas'); ?>" type="button" class="btn btn-primary" disabled>Gas</a>
		  <a href="<?php echo base_url('index.php/user/mapKelembaban'); ?>" type="button" class="btn btn-primary">Kelembaban</a>
		  <br/>
		</div>
		<div class="card card-map">
			<div class="header">
				<h4 class="title">Map Gas (Hanya Alat Anda)</h4>
				<table>
					<tr>
						<td width="100px"><span class="glyphicon glyphicon-stop" style="color:#0061f3;"></span> < 10 &#8451;</td>
						<td width="100px"><span class="glyphicon glyphicon-stop" style="color:#00feda;"></span> 16-20 &#8451;</td>
						<td width="100px"><span class="glyphicon glyphicon-stop" style="color:#bbff00;"></span> 26-30 &#8451;</td>
						<td width="100px"><span class="glyphicon glyphicon-stop" style="color:#ef0208;"></span> 36-40 &#8451;</td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-stop" style="color:#04a0ff;"></span> 10-15 &#8451;</td>
						<td><span class="glyphicon glyphicon-stop" style="color:#0efc00;"></span> 21-25 &#8451;</td>
						<td><span class="glyphicon glyphicon-stop" style="color:#ffa800;"></span> 31-35 &#8451;</td>
						<td><span class="glyphicon glyphicon-stop" style="color:#fc96a3;"></span> > 40 &#8451;</td>
					</tr>
				</table>
			</div>
			<div class="map">
				<div id="map"></div>
			</div>
		</div>
	</div>
</div>
<script>
  // This example creates circles on the map, representing populations in North
  // America.

  // First, create an object containing LatLng and population for each city.
  var citymap = {
	  <?php foreach($konten as $data){
		if($data['gas']>40){
			$warna="#fc96a3";
		}elseif($data['gas']>35){
			$warna="#ef0208";
		}elseif($data['gas']>30){
			$warna="#ffa800";
		}elseif($data['gas']>25){
			$warna="#bbff00";
		}elseif($data['gas']>20){
			$warna="#0efc00";
		}elseif($data['gas']>15){
			$warna="#00feda";
		}elseif($data['gas']>10){
			$warna="#04a0ff";
		}elseif($data['gas']<10){
			$warna="#0061f3";
		}
		echo $data['id_parameter'].": {
		  center: {lat: ".$data['lat'].", lng: ".$data['lon']."},
		  population: 1000,
		  strokeColor: '".$warna."',
		  fillColor: '".$warna."',
		  fillOpacity: 0.35
		},";
	  } ?>
  };

  function initMap() {
	// Create the map.
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 14,
	  center: {lat: -6.9094426, lng: 107.6248946},
	  mapTypeId: 'terrain'
	});

	// Construct the circle for each value in citymap.
	// Note: We scale the area of the circle based on the population.
	for (var city in citymap) {
	  // Add the circle for this city to the map.
	  var cityCircle = new google.maps.Circle({
		strokeColor: citymap[city].strokeColor,
		strokeOpacity: 1,
		strokeWeight: 2,
		fillColor: citymap[city].fillColor,
		fillOpacity: 1,
		map: map,
		center: citymap[city].center,
		radius: Math.sqrt(citymap[city].population)
	  });
	}
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCREpNFgjfL49ehRKE-QRwQ3CAOZmF5ic&callback=initMap">
</script>