<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
      <!-- Notifikasi -->
  					<?php echo $this->session->flashdata('message'); ?>
  				<!-- End Notifikasi -->
			<div class="col-lg-8 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Add Category</h4>
					</div>
					<div class="content">
						<form action="<?php echo base_url('index.php/C_Category/proses_tambah_category'); ?>" method="POST">
							<div class="col-md-12">
								<div class="form-group">
									<label>Category</label>
									<input type="text" name="category" id="category" value="<?= set_value('category') ?>" class="form-control border-input" placeholder="Category name">
								</div>
							</div>
							<div class="text-center">
								<input type="submit" class="btn btn-info" value="Store" />
                <a href="<?= site_url('C_Category') ?>" class="btn btn-danger btn-fill">Back</a>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
