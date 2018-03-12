
<div class="content">
	<div class="container-fluid">
		<div class="row">
		<!-- Notifikasi -->
					<?php echo $this->session->flashdata('message'); ?>
				<!-- End Notifikasi -->
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Table posts</h4>
						<p class="category">All posts data</p>
						<div align="center">
						<a href="<?php echo base_url('index.php/C_Post/tambah_post') ?>" class="btn btn-info dropdown-toggle" type="button">+ Add data</a>
						</div>
					</div>
					<div class="content table-responsive">
						<table id="example" class="table table-striped">
							<thead>
                <th>No</th>
                <th>Image</th>
                <th>Title</th>
                <th>Action</th>
							</thead>
							<tbody>
                <?php $no=1;foreach($konten as $data){?>
  								<tr>
  									<td><?php echo $no; ?></td>
  									<td><img src="<?= base_url()  ?>assets/img/upload/<?= $data['image'] ?>" width="90px" height="50px"/></td>
                    <td><?= $data['title'] ?></td>
                    <td>
  									<div class="dropdown">
  										<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="ti-settings"></span> <span class="caret"></span></button>
  										<ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/C_Post/view_post/').$data['id']; ?>">View</a></li>
                        <li><a href="<?php echo base_url('index.php/C_Post/edit_post/').$data['id']; ?>">Edit</a></li>
                        <li><a href="<?php echo base_url('index.php/C_Post/delete_post/').$data['id']; ?>" data-toggle="confirmation" data-placement="left" data-popout="true">Delete</a></li>
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
