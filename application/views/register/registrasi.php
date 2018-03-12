<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login | Carepol</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/login/');?>css/style2.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
  } );
  
  var check = function() {
	  if (document.getElementById('password').value ==
		document.getElementById('confirm_password').value) {
		document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = 'Matching';
		document.getElementById("myBtn").disabled = false; 
	  } else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'Not matching';
		document.getElementById("myBtn").disabled = true; 
	  }
	}
  </script>
</head>
<body>
<?php 
// jika sudah login redirect ke halaman utama
if (null !==$this->session->userdata('logged')) {
	redirect(site_url('user'));
}?>
<div class="login-page">
  <div class="form">
    <form action="<?php echo base_url('index.php/login/proses_registrasi'); ?>" method="POST" class="login-form">
	<input type="hidden" name="key_alat" value="<?php echo $this->session->flashdata('key_alat');?>">
	  <div class="header">Registrasi</div>
	  <p class="message"><?php echo $this->session->flashdata('berhasil');?></p><br/>
      <input type="text" name="nama_pengguna" placeholder="Nama Lengkap"/>
	  <select name="jenis_kelamin">
			<option selected disabled style="color:silver;">Jenis Kelamin :</option>
			<option value="Laki-laki">Laki-laki</option>
			<option value="Perempuan">Perempuan</option>
		</select>
      <input type="text" name="tgl_lahir" id="datepicker" placeholder="Tanggal Lahir"/>
      <input type="text" name="pekerjaan" placeholder="Pekerjaan"/>
      <textarea rows="3" name="alamat" placeholder="Alamat" ></textarea>
      <input type="text" name="no_kontak" placeholder="No. Kontak"/>
      <input type="email" name="email" placeholder="Email"/>
	  <hr/>
      <input type="text" name="username" placeholder="Username" required/>
      <input type="password" name="password" id="password" placeholder="Password" required/>
	  <span id='message' class="message" align="left"></span>
      <input type="password" id="confirm_password" placeholder="Confirm Password" onkeyup='check();' required/>
      <button type="submit" id="myBtn">Submit</button>
	  <p class="message">Already registered? <a href="<?php echo base_url('index.php/login'); ?>">Sign In</a></p>
    </form>
  </div>
</div>
</body>
</html>
