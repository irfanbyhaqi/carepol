<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="materialize is a material design based mutipurpose responsive template">
    <meta name="keywords" content="material design, card style, material template, portfolio, corporate, business, creative, agency">
    <meta name="author" content="trendytheme.net">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Carepol</title>

    <style>

    </style>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!--  favicon -->
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png">
    <!--  apple-touch-icon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url() ?>assets/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() ?>assets/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() ?>assets/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>assets/img/ico/apple-touch-icon-57-precomposed.png">

    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <!-- FontAwesome CSS -->
    <link href="<?= base_url() ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Material Icons CSS -->
    <link href="<?= base_url() ?>assets/fonts/iconfont/material-icons.css" rel="stylesheet">
    <!-- magnific-popup -->
    <link href="<?= base_url() ?>assets/magnific-popup/magnific-popup.css" rel="stylesheet">
    <!-- materialize -->
    <link href="<?= base_url() ?>assets/materialize/css/materialize.min.css" rel="stylesheet">
    <!-- shortcodes -->
    <link href="<?= base_url() ?>assets/css/shortcodes/shortcodes.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/android.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
      <div id="map_test" style="height:100%;width:100%;">

      </div>
      <!-- <table class="table table-bordered text-center" style="background-color: white;">
          <thead style="text-align: center; color: white; text-align: center">
              <tr>
                  <th style="background-color: #00CC00">BAIK</th>
                  <th style="background-color: #0000CC">SEDANG</th>
                  <th style="background-color: #CCCC00">TIDAK SEHAT</th>
                  <th style="background-color: #CC0000">SANGAT TIDAK SEHAT</th>
                  <th style="background-color: black">BERBAHAYA</th>
              </tr>
          </thead>
      </table> -->


    <div id="cari" hidden>
      <div class="cari1">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
                <div class="content" style="padding:15px;">
                    <h5>Komentar anda</h5>
                    <hr><br>

                    <div class="alert alert-success alert-dismissible" hidden>
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Berhasil!</strong> komentar anda sudah terkirim.
                    </div>

                    <input type="hidden" name="jalan" id="saran_jalan" class="form-control" style="height:20px;" readonly>

                    <div class="form-group">
                      <label for="">Nama anda</label>
                      <input type="text" name="nama" id="nama" class="form-control" style="height:20px;">
                    </div>
                    <div class="form-group">
                      <label for="">Komentar</label>
                      <textarea name="komentar" rows="4" id="komentar" cols="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="button" class="waves-effect waves-light btn" id="kirim_komen" style="font-size:10px;">Send</button>
                      <button type="button" class="waves-effect waves-light btn" id="kirim_close" style="font-size:10px;">Close</button>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
   </div>



    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/materialize/js/materialize.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.sticky.min.js"></script>
    <script src="<?= base_url() ?>assets/js/smoothscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/js/imagesloaded.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.stellar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.inview.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.shuffle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/menuzord.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-tabcollapse.min.js"></script>
    <script src="<?= base_url() ?>assets/owl.carousel/owl.carousel.min.js"></script>

    <script src="<?= base_url() ?>assets/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>

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

            $.ajax({
                url:'<?= base_url() ?>index.php/C_Frontend/send_koment',
                method:'POST',
                data:{jalan:jalan,nama:nama,koment:koment},
                success:function(){
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
           'Komentar : <button class="btn btn-default btn-xs show_komen" data-jalan="'+jalan+'" style="font-size:10px;">click</button> <br/>' +
           '</p>'+
           '<p><font color="'+font_color+'">'+ saran +'</font></p>'
           '</div>'+
         '</div>';


       var infoWindow = new google.maps.InfoWindow({
           content: data, maxwidth : 400
           });

       google.maps.event.addListener(marker, 'click', function() {
         infoWindow.open(map,marker);
         $('#cari').fadeOut("normal");
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

        	$('#cari').fadeIn("slow");
       });

       $('#kirim_close').on('click', function(){
          $('#cari').fadeOut("normal");
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
