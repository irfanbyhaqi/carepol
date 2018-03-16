<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
	<link rel="shortcut icon" href="<?= base_url() ?>assets/images/Logo/Carepol-ico.png"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo isset ($title_page)?$title_page." | ":'' ?>Carepol</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />

		<link rel="stylesheet" href="<?= base_url() ?>assets/css/android.css">

		<style media="screen">
		.jalan{
			margin: auto auto;
			width: 0;
			padding: 100px;
			font-size: 70px;
			opacity: 0.2;
		}
		.sementara{
			margin: auto auto;
			width: 0;
			padding: 200px;
			font-size: 70px;
			opacity: 0.2;
		}
		</style>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/themify-icons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>

	<!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="<?php echo base_url(); ?>assets/bootstrap-confirmation.js"></script>

</head>
<body>
	<!-- Modal -->
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
	  <div class="modal-dialog modal-sm">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Loprkan</h4>
	      </div>
	      <div class="modal-body">
		        <div class="form-group">
							<label for="">Jalan</label>
							<input type="text" name="jalan" id="saran_jalan" disabled class="form-control">
		        </div>
						<div class="from-group">
							<label for="">Saran</label>
							<textarea name="saran" rows="4" cols="6" class="form-control"></textarea>
						</div>
	      </div>
	      <div class="modal-footer">
					<button type="button" class="btn btn-success" id="saran_pemerintah">Send</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<div id="detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
	  <div class="modal-dialog modal-md">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Detail</h4>
	      </div>
	      <div class="modal-body">
		        <div class="row">
							<div class="col-md-4 text-center">
									<img src="<?= base_url() ?>assets/img/konfirmasi/banner.png" class="img-thumbnail" id="tempat_gambar" alt="Cinque Terre" width="200px" height="200px">
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Device ID : <span id="tempat_key_alat"></span> </label>
								</div>
								<div class="form-group">
									<label>Address : <span id="tempat_alamat"></span> </label>
								</div>
								<div class="form-group">
									<label>Contact : <span id="tempat_kontak"></span> </label>
								</div>
								<div class="form-group">
									<label>Email : <span id="tempat_email"></span> </label>
								</div>
							</div>


		        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

<div class="wrapper" >
	<?php echo $sidebar; ?>

    <div class="main-panel">
		<?php echo $navbar; ?>


        <?php echo $content;?>


        <?php echo $footer;?>

    </div>
</div>


</body>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="<?php echo base_url(); ?>assets/js/paper-dashboard.js"></script>


	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
	<script>
	$(document).ready(function() {
			$('#example').DataTable();
			get_alamat();
			get_jumlah_pesan();
			get_jumlah_order();

	});

	function get_alamat() {
	  var select_alamat = $('#form_cari');
	  var html = "";

	  $.ajax({
	    url:'<?= base_url() ?>index.php/adminxmaps/get_jalan',
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

	function get_jumlah_pesan() {

		var tempat_saran = $('#tempat_jumlah_pesan');

		$.ajax({
				url:'<?php echo base_url()  ?>index.php/C_Saran/get_jumlah_pesan',
				method:"GET",
				success:function(data){
						tempat_saran.text(data);
				}
		})
	}

	function get_jumlah_order() {

		var tempat_order = $('#tempat_jumlah_order');

		$.ajax({
				url:'<?php echo base_url()  ?>index.php/C_Order/get_jumlah_order',
				method:"GET",
				success:function(data){
						tempat_order.text(data);
				}
		})
	}


	</script>

</html>
