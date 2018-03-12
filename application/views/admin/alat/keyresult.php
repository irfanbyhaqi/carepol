<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Tambah Alat</h4>
					</div>
					<div class="content">
					<?php foreach($konten as $data){?>
						<form action="<?php echo base_url('index.php/adminxalat/proses_tambah_alat'); ?>" method="POST">
							<div class="col-md-12">
								<div class="form-group">
									<label>Key Alat</label>
									<input type="text" readonly class="form-control border-input" placeholder="Key Alat" value="<?php echo $data['key_alat'];?>">
									<p class="category">Masukan Key di atas ke alat</p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Wilayah Pemakaian</label>
									<input type="text" readonly class="form-control border-input" placeholder="Wilayah Pemakaian" value="<?php echo $data['nama_wilayah'];?>">
								</div>
							</div>
							<a href="<?php echo base_url('index.php/adminxalat'); ?>"><span class="ti-angle-double-left"></span> Kembali</a>
							<div class="text-center">
								<button type="submit" disabled class="btn btn-info btn-fill btn-wd">Generate Key</button>
							</div>
							<div class="clearfix"></div>
						</form>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
