<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Tambah User</h4>
					</div>
					<div class="content">
						<form action="<?php echo base_url('index.php/adminxuser/proses_tambah_user'); ?>" method="POST">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="nama_pengguna" class="form-control border-input" placeholder="Nama">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="jenis_kelamin">Jenis Kelamin</label>
										<select name="jenis_kelamin" class="form-control  border-input">
											<option selected disabled style="color:silver;">Jenis Kelamin</option>
											<option value="Laki-laki">Laki-laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label>Tgl Lahir</label>
										<select name="tanggal" id="tanggal" class="form-control border-input">
											<option selected disabled style="color:silver;">Tanggal</option>
											<?php
												for($i=1;$i<=31;$i++){
													echo "<option value='$i'>$i</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Bulan Lahir</label>
										<select name="bulan" id="bulan" class="form-control  border-input">
											<option selected disabled style="color:silver;">Bulan</option>
											<option value="1">Januari</option>
											<option value="2">Februari</option>
											<option value="3">Maret</option>
											<option value="4">April</option>
											<option value="5">Mei</option>
											<option value="6">Juni</option>
											<option value="7">Juli</option>
											<option value="8">Agustus</option>
											<option value="9">September</option>
											<option value="10">Oktober</option>
											<option value="11">November</option>
											<option value="12">Desember</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Tahun Lahir</label>
										<input type="text" name="tahun" class="form-control border-input" placeholder="Tahun">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Pekerjaan</label>
										<input type="text" name="pekerjaan" class="form-control border-input" placeholder="Pekerjaan">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Alamat</label>
										<input type="text" name="alamat" class="form-control border-input" placeholder="Alamat">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>No Kontak</label>
										<input type="text" name="no_kontak" class="form-control border-input" placeholder="No Kontak">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control border-input" placeholder="Email">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Key Alat</label>
									<select name="id_alat" class="form-control  border-input">
										<option selected disabled style="color:silver;">Key alat</option>
										<?php foreach ($data_alat as $isi): ?>
												<option value="<?= $isi['id_alat']; ?>"><?= $isi['key_alat']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control border-input" placeholder="Username">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Password</label>
									<input type="password" id="password" name="password" class="form-control border-input" placeholder="Password">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" id="confirm_password" class="form-control border-input" onkeyup='check();' placeholder="Confirm Password">
									<span id='message' class="message" align="left"></span>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" id="myBtn" disabled class="btn btn-info btn-fill btn-wd">Tambah Profile</button>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
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
