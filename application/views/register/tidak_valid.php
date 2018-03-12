<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Registrasi | Carepol</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/login/');?>css/style.css">
</head>
<body>
<?php 
// jika sudah login redirect ke halaman utama
if (null !==$this->session->userdata('logged')) {
	redirect(site_url('user'));
}?>

<div class="login-page">
	<div class="form">
		<!-- Notifikasi -->
			<?php echo $this->session->flashdata('message'); ?>
		<!-- End Notifikasi -->
	</div>
	<p class="message"><a href="<?php echo base_url('index.php/login'); ?>"><< Kembali ke halaman utama</a></p>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="<?php echo base_url('assets/login/');?>js/index.js"></script>
</body>
</html>
