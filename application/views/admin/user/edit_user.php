<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
            <div class="container-fluid">
				<!-- Notifikasi -->
					<?php echo $this->session->flashdata('message'); ?>
				<!-- End Notifikasi -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit User</h4>
                            </div>
                            <div class="content">
							<?php foreach($konten as $data){?>
                                <form action="<?php echo base_url('index.php/adminxuser/proses_edit_user'); ?>" method="POST">
                                    <input type="hidden" name="id_pengguna" value="<?php echo $data['id_pengguna'];?>">
									<div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama_pengguna" class="form-control border-input" placeholder="Nama" value="<?php echo $data['nama_pengguna'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
												<select name="jenis_kelamin" class="form-control  border-input">
													<option selected disabled style="color:silver;">Jenis Kelamin</option>
													<option value="Laki-laki" <?php echo ($data['jenis_kelamin'] == 'Laki-laki' ? 'selected': '')?>>Laki-laki</option>
													<option value="Perempuan" <?php echo ($data['jenis_kelamin'] == 'Perempuan' ? 'selected': '')?>>Perempuan</option>
												</select>
											</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tgl Lahir</label>
												<select name="tanggal" id="tanggal" class="form-control border-input">
													<option selected disabled style="color:silver;">Tanggal</option>
													<?php
														$tanggal=date("d", strtotime("{$data['tgl_lahir']}"));
														$bulan=date("m", strtotime("{$data['tgl_lahir']}"));
														$tahun=date("Y", strtotime("{$data['tgl_lahir']}"));
														for($i=1;$i<=31;$i++){
															if($tanggal==$i){
																echo "<option value='$i' selected>$i</option>";
															}
															else{
																echo "<option value='$i'>$i</option>";
															}
														}
													?>
												</select>
											</div>
                                        </div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bulan Lahir</label>
												<select name="bulan" id="bulan" class="form-control  border-input">
													<option selected disabled style="color:silver;">Bulan</option>
													<option value="1" <?php echo ($bulan == '1' ? 'selected': '')?>>Januari</option>
													<option value="2" <?php echo ($bulan == '2' ? 'selected': '')?>>Februari</option>
													<option value="3" <?php echo ($bulan == '3' ? 'selected': '')?>>Maret</option>
													<option value="4" <?php echo ($bulan == '4' ? 'selected': '')?>>April</option>
													<option value="5" <?php echo ($bulan == '5' ? 'selected': '')?>>Mei</option>
													<option value="6" <?php echo ($bulan == '6' ? 'selected': '')?>>Juni</option>
													<option value="7" <?php echo ($bulan == '7' ? 'selected': '')?>>Juli</option>
													<option value="8" <?php echo ($bulan == '8' ? 'selected': '')?>>Agustus</option>
													<option value="9" <?php echo ($bulan == '9' ? 'selected': '')?>>September</option>
													<option value="10" <?php echo ($bulan == '10' ? 'selected': '')?>>Oktober</option>
													<option value="11" <?php echo ($bulan == '11' ? 'selected': '')?>>November</option>
													<option value="12" <?php echo ($bulan == '12' ? 'selected': '')?>>Desember</option>
												</select>
											</div>
                                        </div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tahun Lahir</label>
                                                <input type="text" name="tahun" class="form-control border-input" placeholder="Tahun" value="<?php echo $tahun;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pekerjaan</label>
                                                <input type="text" name="pekerjaan" class="form-control border-input" placeholder="Pekerjaan" value="<?php echo $data['pekerjaan'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" class="form-control border-input" placeholder="Alamat" value="<?php echo $data['alamat'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Kontak</label>
                                                <input type="text" name="no_kontak" class="form-control border-input" placeholder="No Kontak" value="<?php echo $data['no_kontak'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control border-input" placeholder="Email" value="<?php echo $data['email'];?>">
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Key Alat</label>
											<input type="text" name="id_alat" class="form-control border-input" placeholder="Key Alat" value="<?php echo $data['key_alat'];?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Username</label>
											<input type="text" name="username" class="form-control border-input" placeholder="Username" value="<?php echo $data['username'];?>">
										</div>
									</div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
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
