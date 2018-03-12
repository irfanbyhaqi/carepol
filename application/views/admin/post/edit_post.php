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
						<form action="<?= site_url('C_Post/proses_edit_post/'.$konten['id']) ?>" method="POST" enctype="multipart/form-data">
							<div class="col-md-12">
								<div class="form-group">
									<label>Title</label>
									<input type="text" name="title" id="title" value="<?= $konten['title'] ?>" class="form-control border-input" placeholder="Category name">
								</div>
							</div>
              <div class="col-md-12">
								<div class="form-group">
									<label>Image</label><br>
									<img src="<?= base_url() ?>assets/img/upload/<?= $konten['image'] ?>" width="100px" height="100px" class="img-thumbnail img-responsive">
                   <br><br>
                  <input type="file" name="gambar" class="form-control border-input" >
                </div>
							</div>
              <div class="col-md-12">
								<div class="form-group">
									<label>Category</label>
									<select class="form-control border-input" name="category">
                    <option selected disabled style="color:silver;">Select a category</option>
                    <?php foreach ($category as $isi){ ?>
                        <?php if ($isi['id'] == $konten['category_id']){?>
                            <option value="<?= $isi['id'] ?>" selected><?= $isi['name'] ?></option>
                        <?php }else{ ?>
                            <option value="<?= $isi['id'] ?>"><?= $isi['name'] ?></option>
                      <?php } ?>

                    <?php } ?>
                  </select>
								</div>
							</div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="5" cols="5" class="form-control"><?= $konten['content'] ?></textarea>
                </div>
              </div>
							<div class="text-center">
                <input type="submit" class="btn btn-info" value="Update" />
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
