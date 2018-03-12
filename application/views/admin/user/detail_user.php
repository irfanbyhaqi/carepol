
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Detail User</h4>
					</div>
					<div class="content table-responsive">
						<table class="table table-striped">
							<tbody>
							<?php foreach($konten as $data){?>
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?php echo $data['nama_pengguna']; ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td><?php echo $data['jenis_kelamin']; ?></td>
								</tr>
								<tr>
									<td>Tanggal Lahir</td>
									<td>:</td>
									<td><?php echo $data['tgl_lahir']; ?></td>
								</tr>
								<tr>
									<td>Pekerjaan</td>
									<td>:</td>
									<td><?php echo $data['pekerjaan']; ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data['alamat']; ?></td>
								</tr>
								<tr>
									<td>No. Kontak</td>
									<td>:</td>
									<td><?php echo $data['no_kontak']; ?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $data['email']; ?></td>
								</tr>
								<tr>
									<td>Key Alat</td>
									<td>:</td>
									<td><?php echo $data['key_alat']; ?></td>
								</tr>
								<tr>
									<td>Username</td>
									<td>:</td>
									<td><?php echo $data['username']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
