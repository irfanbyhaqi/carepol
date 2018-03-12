
<div class="content">
	<div class="container-fluid">
		<div class="row">
		<!-- Notifikasi -->
					<?php echo $this->session->flashdata('message'); ?>
				<!-- End Notifikasi -->
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Table categories</h4>
						<p class="category">All categories data</p>
						<div align="center">
						<a href="<?php echo base_url('index.php/C_Category/tambah_category') ?>" class="btn btn-info dropdown-toggle" type="button">+ Add data</a>
						</div>
					</div>
					<div class="content table-responsive">
						<table id="example" class="table table-striped">
							<thead>
								<th>No</th>
								<th>Name</th>
								<th>Action</th>
							</thead>
							<tbody>
                <?php $no=1;foreach($konten as $data){?>
  								<tr>
  									<td><?php echo $no; ?></td>
  									<td><?php echo $data['name']; ?></td>
  									<td>
  									<div class="dropdown">
  										<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="ti-settings"></span> <span class="caret"></span></button>
  										<ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/C_Category/edit_category/').$data['id']; ?>">Edit</a></li>
                        <li><a href="<?php echo base_url('index.php/C_Category/delete_category/').$data['id']; ?>" data-toggle="confirmation" data-placement="left" data-popout="true">Delete</a></li>
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
