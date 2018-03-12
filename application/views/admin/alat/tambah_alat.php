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
						<form action="<?php echo base_url('index.php/adminxalat/proses_tambah_alat'); ?>" method="POST">
							<div class="col-md-12">
								<div class="form-group">
									<label>Key Alat</label>
									<input type="text" name="key_alat" disabled class="form-control border-input" placeholder="Key Alat">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Wilayah Pemakaian</label>
									<select name="wilayah" class="form-control border-input">
										<option style="color:silver;" disabled selected>Pilih Wilayah</option>
										<?php foreach ($data_wilayah as $isi): ?>
												<option value="<?= $isi->id_wilayah ?>"><?= $isi->nama_wilayah ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-info btn-fill btn-wd">Generate Key</button>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
