<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Tambah Area</h4>
					</div>
					<div class="content">
						<form action="<?php echo base_url('index.php/C_Wilayah/proses_tambah_wilayah'); ?>" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama angkutan</label>
										<input type="text" name="nama_angkutan" class="form-control border-input" placeholder="Nama angkutan .." required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Dari rute</label>
										<input type="text" name="dari" class="form-control border-input" placeholder="Dari rute .." required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="jenis_kelamin">Sampai rute</label>
										<input type="text" name="sampai" class="form-control border-input" placeholder="Sampai rute .. " required>
									</div>
								</div>
							</div>

							<div class="text-center">
								<button type="submit" id="myBtn" class="btn btn-info btn-fill btn-wd">Tambah Area</button>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
