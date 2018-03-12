<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<div class="content">
	<div class="container-fluid">
		<div class="row">
      <!-- Notifikasi -->
  					<?php echo $this->session->flashdata('message'); ?>
  				<!-- End Notifikasi -->
			<div class="col-lg-8 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Add Post</h4>
					</div>
					<div class="content">
						<form action="<?php echo base_url('index.php/C_Post/proses_tambah_post'); ?>" method="POST" enctype="multipart/form-data">
							<div class="col-md-12">
								<div class="form-group">
									<label>Title</label>
									<input type="text" name="title" id="title" value="<?= set_value('category') ?>" class="form-control border-input" placeholder="Category name">
								</div>
							</div>
              <div class="col-md-12">
								<div class="form-group">
									<label>Image</label>
									<input type="file" name="gambar" id="gambar" class="form-control border-input">
								</div>
							</div>
              <div class="col-md-12">
								<div class="form-group">
									<label>Category</label>
									<select class="form-control border-input" name="category">
                    <option selected disabled style="color:silver;">Select a category</option>
                    <?php foreach ($category as $isi): ?>
                        <option value="<?= $isi['id'] ?>"><?= $isi['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
								</div>
							</div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="5" cols="5" class="form-control"><?= set_value('content'); ?></textarea>
                </div>
              </div>
							<div class="text-center">
								<input type="submit" class="btn btn-info" value="Store" />
                <a href="<?= site_url('C_Post') ?>" class="btn btn-danger btn-fill">Back</a>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote();
    });
</script>
