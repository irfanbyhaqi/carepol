
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Table Alat</h4>
						<p class="category">Semua data Alat</p>
						<div align="center">
						<a href="<?php echo base_url('index.php/adminxalat/tambah_alat') ?>" class="btn btn-info dropdown-toggle" type="button">+ Tambah Data</a>
						</div>
					</div>
					<div class="content table-responsive">
						<table id="example" class="table table-striped">
							<thead>
								<th>ID</th>
								<th>Key</th>
								<th>Wilayah Pemakaian</th>
								<th>Aksi</th>
							</thead>
							<tbody>
							<?php $no=1;foreach($konten as $data){?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $data['key_alat']; ?></td>
									<td><?php echo $data['nama_wilayah']; ?></td>
									<td>
									<div class="dropdown">
										<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="ti-settings"></span> <span class="caret"></span></button>
										<ul class="dropdown-menu">
										  <li><a href="<?php echo base_url('index.php/adminxalat/proses_delete/').$data['id_alat']; ?>" data-toggle="confirmation" data-placement="left" data-popout="true">Delete</a></li>
										</ul>
									</div>
									</td>
								</tr>
							<?php $no++;} ?>
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
