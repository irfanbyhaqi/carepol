
<div class="content">
	<div class="container-fluid">
		<div class="row">
		<!-- Notifikasi -->
					<?php echo $this->session->flashdata('message'); ?>
				<!-- End Notifikasi -->
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Route Table</h4>
						<p class="category">Semua route data</p>
						<div align="center">
						<a href="<?php echo base_url('index.php/C_Wilayah/tambah_wilayah') ?>" class="btn btn-info dropdown-toggle" type="button">+ Tambah Data</a>
						</div>
					</div>
					<div class="content table-responsive">
						<table id="example" class="table table-striped">
							<thead>
								<th>No</th>
								<th>Nama Angkutan</th>
								<th>Nama Wilayah</th>
								<th>Aksi</th>
							</thead>
							<tbody>
							<?php
							$no = 1;

							foreach ($data as $isi): ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $isi->nama_angkutan ?></td>
										<td><?= $isi->nama_wilayah ?></td>
										<td>
										<div class="dropdown">
											<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="ti-settings"></span> <span class="caret"></span></button>
											<ul class="dropdown-menu">

											  <li><a href="<?php echo base_url('index.php/C_Wilayah/edit_wilayah/').$isi->id_wilayah; ?>">Edit</a></li>
											  <li><a href="<?php echo base_url('index.php/C_Wilayah/delete_wilayah/').$isi->id_wilayah; ?>"  data-toggle="confirmation" data-placement="left" data-popout="true">Delete</a></li>
											</ul>
										</div>
										</td>
									</tr>
							<?php endforeach; ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
  $('[data-toggle=confirmation]').confirmation({
	rootSelector: '[data-toggle=confirmation]',
	container: 'body',
	title: 'Ingin menghapus data ini ?',
	btnOkIcon: 'glyphicon glyphicon-trash'
  });
</script>
