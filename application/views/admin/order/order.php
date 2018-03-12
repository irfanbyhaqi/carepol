
<div class="content">
	<div class="container-fluid">
		<div class="row">
		    <!-- Notifikasi -->
					<?php echo $this->session->flashdata('message'); ?>
				<!-- End Notifikasi -->
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Table orders</h4>
						<p class="category">All orders data</p>

					</div>
					<div class="content table-responsive">
						<table id="example" class="table table-striped">
							<thead>
								<th>No</th>
								<th>Name</th>
                <th>Amount</th>
                <th>Total</th>
                <th>Status</th>
								<th>Confirmation</th>
							</thead>
							<tbody>
                <?php $no=1;foreach($konten as $data){?>
  								<tr>
  									<td><?php echo $no; ?></td>
  									<td><?php echo $data['nama_pengguna']; ?></td>
                    <td><?= $data['jumlah'] ?></td>
                    <td>Rp. <?php echo number_format($data['total']) ?></td>
  									<td>
                      <?php if ($data['status_bayar'] != "kosong"){ ?>
                        <button type="button" data-id="<?= $data['id_pengguna'] ?>" class="btn btn-success btn-xs show_detail">alredy paid</button>
                      <?php }else{ ?>
                        <span class="label label-danger">not yet paid</span>
                      <?php } ?>
  									</td>
                    <td>
                      <?php if ($data['konfirmasi']){ ?>
                        <span class="label label-success">Confirmed</span>
                      <?php }else{
												$disabled = '';
											$link = '';

											if ($data['status_bayar'] == "kosong") {
												$disabled = 'disabled';
												$link = '#';
											}else{
													$link = site_url('C_Order/konfirmasi/'.$data['id_order']);
											}

										?>
										<a href="<?= $link ?>" class="btn btn-danger btn-xs"
											<?= $disabled ?>
										>Confirmation</button>
                      <?php } ?>
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
	$('.show_detail').on('click', function(){
			var id = $(this).data('id');
			$.ajax({
				url:'<?= base_url() ?>index.php/C_Order/get_where_pengguna',
				method:"POST",
				data:{id_pengguna:id},
				dataType:'JSON',
				success:function(data){
					$('#tempat_alamat').text(data.alamat);
					$('#tempat_kontak').text(data.no_kontak);
					$('#tempat_email').text(data.email);
					$('#tempat_key_alat').text(data.key_alat);
					$('#tempat_gambar').prop('src', '<?= base_url() ?>assets/img/upload/'+data.status_bayar);
					$('#detail').modal({show:true});
				}
			});
	});

  $('[data-toggle=confirmation]').confirmation({
	rootSelector: '[data-toggle=confirmation]',
	container: 'body',
	title: 'Ingin menghapus data ini ?',
	btnOkIcon: 'glyphicon glyphicon-trash'
  });
</script>
