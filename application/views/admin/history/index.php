
<div class="content">
	<div class="container-fluid">
		<div class="row">
		<!-- Notifikasi -->
					<?php echo $this->session->flashdata('message'); ?>
				<!-- End Notifikasi -->
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">History alat</h4>
						<p class="category">Semua data alat</p>
						<br>
					</div>
					<div class="content table-responsive">
						<table id="example" class="table table-striped">
							<thead>
								<th>ID Alat</th>
								<th>Suhu</th>
								<th>CO 2</th>
								<th>CO</th>
								<th>Kelembaban</th>
								<th>ISPU</th>
                <th>Jalan</th>
                <th>Waktu</th>
							</thead>
							<tbody>
                <?php foreach ($data_alat as $isi): ?>
										<tr>
											<td><?= $isi->key_alat ?></td>
											<td><?= $isi->suhu ?></td>
											<td><?= $isi->co2 ?></td>
											<td><?= $isi->co ?></td>
											<td><?= $isi->kelembaban ?></td>
											<td><?= $isi->index_akhir ?></td>
											<td><?= $isi->jalan ?></td>
											<td><?= $isi->created_at ?></td>
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
