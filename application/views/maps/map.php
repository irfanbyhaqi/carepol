<div class="content">
	<div class="container-fluid">
		<div class="card card-map">
			<div class="header">
				<h4 class="title">Map</h4>
			</div>
			<div class="map">
				<div id="map"></div>
			</div>
		</div>
	</div>
</div>
<script>
 function initMap() {
	        var mapCanvas = document.getElementById('map');
	        var mapOptions = {
	          mapTypeId: google.maps.MapTypeId.terrain,
			  center:new google.maps.LatLng(-6.9094426,107.6248946),
				zoom:5,
	        }     
	        var map = new google.maps.Map(mapCanvas, mapOptions);
	        var infoWindow = new google.maps.InfoWindow;      
	        var bounds = new google.maps.LatLngBounds();
	 		
	         function addMarker(Lat, Lng, created_at,suhu,gas,kelembaban,status,saran) {
	            var pt = new google.maps.LatLng(Lat, Lng);
	            bounds.extend(pt);
	            var marker = new google.maps.Marker({
	                map: map,
	                position: pt,
	                title : created_at,
					icon: {url: '<?php echo base_url(); ?>assets/img/S_6963293472970.png', // image is 512 x 512
						scaledSize : new google.maps.Size(33, 33)}
	            });       
	            map.fitBounds(bounds);

	            var data = '<div id="content">'+
								'<h3 class="firstHeading">'+ created_at +'</h3>'+
								'<div id="bodyContent">'+
								'<p>Gas : ' + gas + '<br/>' +
								'Suhu : ' + suhu + ' &#8451;<br/>' +
								'Kelembaban : ' + kelembaban + ' RH<br/>' +
								'Status : ' + status + ' <br/>' +
								'</p>'+
								'<p>'+ saran +'</p>'
								'</div>'+
							'</div>';

       
	          var infowindow = new google.maps.InfoWindow({
	              content: data, maxwidth : 400
	              });
	           
	          google.maps.event.addListener(marker, 'click', function() {
	            infowindow.open(map,marker);
	          });

	            google.maps.event.addListener(marker,'dblclick',function() {
	              map.setZoom(13);
	              map.setCenter(marker.getPosition());
	            });
	          } 
	 
	          <?php
				foreach($konten as $data){
				    if($data['gas']>400){
						$status = "Tercemar";
						$saran = "Diharapkan sementara waktu tidak melalui area ini, dikarenakan kondisi udara dalam keadaan tercemar ";
					}else{
						$status = "Baik";
						$saran = "Kondisi udara dalam keadaan baik, tetap lakukan penanganan dini seperti penggunaan masker untuk menghindari kondisi buruk";
					}
					$suhu = $data['suhu'];
					$gas = $data['gas'];
					$kelembaban = $data['kelembaban'];
					$lat = $data['lat'];
					$lon = $data['lon'];
					$created_at = $data['created_at'];
					echo ("addMarker($lat,$lon,'$created_at','$suhu','$gas','$kelembaban','$status','$saran');");                       
				}
	          ?>
	        }
	      google.maps.event.addDomListener(window, 'load', initMap);
    </script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCREpNFgjfL49ehRKE-QRwQ3CAOZmF5ic&callback=initMap">
</script>