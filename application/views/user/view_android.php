<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Carepol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/android.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <div style="width:100%;">
        <div id="map_test" style="height:660px;">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Komentar anda</h4>
          </div>
          <div class="modal-body">

            <div class="alert alert-success alert-dismissible" hidden>
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Berhasil!</strong> komentar anda sudah terkirim.
            </div>

            <input type="hidden" name="jalan" id="saran_jalan" class="form-control" readonly>

            <div class="form-group">

              <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama anda ..">
            </div>
            <div class="form-group">
              
              <textarea name="komentar" rows="4" id="komentar" cols="6" class="form-control" placeholder="Komentar .."></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Sending .." id="kirim_komen">Send</button>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">

      $(document).on('click','#kirim_komen', function(){
          var jalan = $('#saran_jalan').val();
          var nama = $('#nama').val();
          var koment = $('#komentar').val();


          if(nama == ''){
            $('#nama').focus();
          }else if(koment == ''){
            $('#komentar').focus();
          }else{
            var $this = $(this);

            $.ajax({
                url:'<?= base_url() ?>index.php/C_Frontend/send_koment',
                method:'POST',
                data:{jalan:jalan,nama:nama,koment:koment},
                beforeSend:function(){
                  $this.button('loading');
                },
                success:function(){

                  $this.button('reset');

                    $('#nama').val('');
                    $('#komentar').val('');
                    $('.alert').fadeIn("slow");


                }

            })
          }

      });

      var map, infoWindow, bounds;
      var markers = [];

      function initMap() {
        var cari = document.getElementById('cari');

        var mapCanvas = document.getElementById('map_test');

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

      }

      function addMarker(Lat, Lng, jalan, created_at,suhu,gas,kelembaban,index_akhir1,suara,rata_rata) {
         var pt = new google.maps.LatLng(Lat, Lng);
         var marker;
         marker = 0;

         bounds.extend(pt);
         var index_akhir = parseInt(index_akhir1);
         var url_icon = '';
         var status = '';
         var saran = '';
         var color = '#3d3d3d';
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
             font_color = 'black';

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
             saran = 'BERBAHAYA. Area ini memiliki kandungan pencemaran carbonmonoksida kadar tinggi. Tinggalkan area ini.';
             font_color = 'black';

             color = "white";

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
           '<h3 class="firstHeading">'+ jalan +'</h3>'+
           '<div id="bodyContent">'+
           '<p>CO2 : ' + gas + '<br/>' +
           'Suhu : ' + suhu + ' &#8451;<br/>' +
           'Kelembaban : ' + kelembaban + ' RH<br/>' +
           'CO : ' + index_akhir + ' RH<br/>' +
           'Status : ' + status + ' <br/>' +
           'Status Kebisingan : ' + status_suara + ' <br/>' +
           'Komentar : <button class="btn btn-success btn-xs show_komen" data-jalan="'+jalan+'" style="font-size:10px;">click</button> <br/>' +
           '</p>'+
           '<p><font color="'+font_color+'">'+ saran +'</font></p>'
           '</div>'+
         '</div>';


       var infoWindow = new google.maps.InfoWindow({
           content: data, maxwidth : 400
           });

       google.maps.event.addListener(marker, 'click', function() {
         infoWindow.open(map,marker);

         // komentar(jalan);
       });


         google.maps.event.addListener(marker,'dblclick',function() {
           map.setZoom(13);
           map.setCenter(marker.getPosition());
         });

         markers.push(marker);

         return marker;

       } // Tutup function addMarker

       $(document).on('click','.show_komen', function(){

          var jalan = $(this).data('jalan');

          $('#saran_jalan').val(jalan);

        	$('#myModal').modal({show:'true'});
       });



      function get_data($data = null) {

          clear_lokasi();

          var kondisi = '';

          if ($data == null || $data == "all") {
            kondisi = "all";
          }else{
            kondisi = $data;
          }


          $.ajax({
              url:'<?= base_url() ?>index.php/C_Frontend/get_data',
              method:'POST',
              data:{kondisi:kondisi},
              dataType:'JSON',
              success:function(data){
                if (data.data.length > 0) {
                  for (var i = 0; i < data.data.length; i++) {
                    addMarker(data.data[i]['lat'], data.data[i]['lon'], data.data[i]['jalan'], data.data[i]['created_at'], data.data[i]['suhu'], data.data[i]['co2'],data.data[i]['kelembaban'],data.data[i]['index_akhir'], data.data[i].suara, data.data[i]['rata_rata']);
                  }
                }else{
                  console.log('Kosong');
                }
              }
          })
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



      function getColor(d) {

        return d >= 1 && d <= 50 ? 'green' :
            d >= 51 && d <= 100  ? 'blue' :
            d >= 101 && d <= 199  ? 'yellow' :
            d >= 200 && d <= 299  ? 'red' :
            d >= 300  ? 'black':'white';

      }


      function get_alamat() {
    	  var select_alamat = $('#form_cari');
    	  var html = "";

    	  $.ajax({
    	    url:'<?= base_url() ?>index.php/C_Frontend/get_jalan',
    	    method:'GET',
    	    dataType:'JSON',
    	    success:function(data){
    	        html +="<option value='0' selected disabled style='color:silver;'>Choose a street ..</option>";
    	        for (var i = 0; i < data.jalan.length; i++) {
    	            html +="<option value='"+data.jalan[i].jalan+"'>"+data.jalan[i].jalan+"</option>";
    	        }

    					html +="<option value='all'>View all</option>";

    	        select_alamat.html(html);
    	    }
    	  });

    	}

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpALWzkNO7VH_pCSX30bt43_7h3sIeqQI&libraries=places&callback=initMap&libraries=places&sensor=false"
    async defer></script>

  </body>
</html>
