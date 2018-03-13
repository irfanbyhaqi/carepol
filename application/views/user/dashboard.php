<?php
  include('template/header.php');
?>
<?php
  include('template/topbar.php');
?>

<header class="bg-gradient" id="home">
    <div class="container mt-5">
        <h1>Carepol</h1>
        <p class="tagline">is an integrated monitoring system used to monitor air pollution levels in an urban area which then the levels will be mapped as a zone based on pollutant level </p>
    </div>
    <div class="img-holder mt-3"><img src="<?= base_url() ?>assets/frontend/images/blackrev.png" alt="phone" class="img-fluid"></div>
</header>
<div class="client-logos my-5">
    <div class="container text-center">
        <img src="<?= base_url() ?>assets/frontend/images/Logooo.png" alt="client logos" width="400px" class="img-fluid">
    </div>
</div>
<div class="section light-bg" id="features">
    <div class="container">
        <div class="section-title">
            <small>HIGHLIGHTS</small>
            <h3>Ways of working</h3>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-harddrive gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Hardware System</h4>
                                <p class="card-text"> CAREPOL device is used to detect environment parameter data (Co2) </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-cloud gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Clouds</h4>
                                <p class="card-text"> The data will be sent automatically to the cloud/server to be then analyzed in real time </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-mobile gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">User Interface Android</h4>
                                <p class="card-text"> Produce an information for the user example pollutant record data, the division of safe. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // end .section -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <h2>Carepol</h2>
                <p class="mb-4">device is used to detect environment parameter data (Co2 and CO), the data will be sent automatically to the cloud/server Azure to be then analysed in real time to produce an information for the user. </p>
            </div>
        </div>
        <div class="perspective-phone">
            <img src="<?= base_url() ?>assets/frontend/images/App/1.png" width="400px" alt="perspective phone" class="img-fluid">
        </div>
    </div>
</div>
<!-- // end .section -->
<div class="section light-bg">
    <div class="container">
        <div class="section-title">
            <h3>Carepol Features </h3>
        </div>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#communication">Hardware Segment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#schedule">Clouds</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#livechat">Android Apps</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="communication">
                <div class="d-flex flex-column flex-lg-row">
                    <img src="<?= base_url() ?>assets/frontend/images/App/2.png"width="300px" height="400px" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    <div>

                        <h2>Components placement / Device’s schematic</h2>
                        <p class="lead"> CAREPOL system is designed as a portable device for users by making it small and dock-able. </p>
                        <p>
                            •   Measure C02 level produced by vehicles<br>
                            •   Measure the temperature and humidity of the environment around the user<br>
                            •   Sending the position of the system in the form of GPS coordinates<br>
                            •   measure carbon monoxide<br>
                            •   measuri carbon dioxide<br>
                            •   noise level<br>
                            •   battery<br>
                            •   Solar Panel<br>
                            •   Fortable
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="schedule">
                <div class="d-flex flex-column flex-lg-row">
                    <img src="<?= base_url() ?>assets/frontend/images/App/cloudserver.jpg" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    <div>
                        <h2>Clouds Segment</h2>
                        <p class="lead">CAREPOL Architecture System. </p>
                        <p>
                            •   Center of Data Storage<br>
                            •   Power BI<br>
                            •   Microsoft Azure<br>
                            •   Digital mapping (Divide zone based on air pollution value)<br>
                            •   IoT HUB feature
                        </p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="livechat">
                <div class="d-flex flex-column flex-lg-row">
                    <img src="<?= base_url() ?>assets/frontend/images/App/3apps.png" style="width: 500px; height: 500px;" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    <div>
                        <h2>Android Segment</h2>
                        <p class="lead">Carepol. </p>
                        <p>CAREPOL is an IoT (Internet of Thing) based device, which means that every data collected by CAREPOL will be sent to cloud/server Microsoft Azure to be analyzed in real time.
                        </p>
                        <p>
                            •   Account Registration<br>
                            •   Integrated with database system<br>
                            •   User feedback<br>
                            •   Sharing
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // end .section -->
<div class="section light-bg">
    <div class="container">
        <div class="section-title">
            <h3>User Feedback</h3>
        </div>
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <ul class="list-unstyled ui-steps">
                    <li class="media">
                        <div class="circle-icon mr-4">1</div>
                        <div class="media-body">
                            <h5>Digital mapping</h5>
                            <p>Produce maps that provide accurate representation for areas prone to mapping. </p>
                        </div>
                    </li>
                    <li class="media my-4">
                        <div class="circle-icon mr-4">2</div>
                        <div class="media-body">
                            <h5>Monitoring air pollution in every region</h5>
                            <p>Can monitor air pollution in each region to know where are the areas that are prone to pollution. </p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="circle-icon mr-4">3</div>
                        <div class="media-body">
                            <h5>Position based on GPS</h5>
                            <p>Sending the position of the system in the form of GPS coordinates. </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <img src="<?= base_url() ?>assets/frontend/images/App/HP3.png" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
            </div>
        </div>
    </div>
</div>
    <!-- // end .section -->
    <div class="section" id="pricing">
        <div class="container">
            <div class="section-title">
                <small>CAREPOL</small>
                <h3>Order Now</h3>
            </div>
                <div class="x_content">
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <h4><i class="fa fa-shopping-cart mr-2"></i> <a class="mr-4">Price List :</h4></a>
                      </p>
                  </div>
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <h4> <a class="mr-4">Rp 1.000.000</h4></a>
                      </p>
                  </div>
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <h4><i class="fa fa-angle-double-right mr-2"></i> <a class="mr-3">Carepol Devices</h4></a>
                      </p>
                  </div>
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <h4></span> <a class="mr-3">Free Account for 1 year</h4></a>
                      </p>
                  </div>
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <h4><a class="mr-3">Point Reward</h4></a>
                      </p>
                  </div>
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <h4><a class="mr-3">Carepol Communication</h4></a>
                      </p>
                  </div><hr>
                    <br /><center>
                        <form class="form-horizontal" action="<?= base_url('index.php/C_Order/insert_order') ?>" method="POST">
                          <div class="col-md-12">
                               <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                   <input type="text" class="form-control" name="nama_depan" id="nama_depan" placeholder="Frist Name" required>
                                               </div>
                                           </div>
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                  <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" placeholder="Last Name" required>
                                               </div>
                                           </div>
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                   <select class="form-control form-control-line" id="jenis_kelamin" name="jenis_kelamin"  required>
                                                       <option value="Laki-laki">Male</option>
                                                       <option value="Perempuan">Female</option>
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                               <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                  <input type="email" class="form-control has-feedback-left" id="email" name="email" placeholder="Email" required>
                                               </div>
                                           </div>
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                  <input type="tel" class="form-control" id="no_kontak" name="no_kontak" pattern="^\d{10,12}$" placeholder="Phone" required>
                                               </div>
                                           </div>
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                   <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Job" required>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                               <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                   <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Amount" min="1" required>
                                               </div>
                                           </div>
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                  <input type="text" class="form-control" id="total" placeholder="Total" readonly>
                                               </div>
                                           </div>
                                           <div class="col-md-4 spirat">
                                               <div class="form-group">
                                                   <select class="form-control form-control-line" id="inputSuccess3" required>
                                                       <option>-Payment-</option>
                                                       <option>Transfer</option>
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                               <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-12 spirat">
                                               <div class="form-group">
                                                   <textarea class="form-control" id="alamat" name="alamat" placeholder="Address" required></textarea>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                           <div class="form-group">
                               <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                                   <button type="submit" class="btn btn-success">Reset</button>
                               </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div></center>
            <!-- // end .pricing -->
        </div>
    </div>
    <!-- // end .section -->
    <div class="light-bg py-5" id="contact">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 text-center text-lg-left">
                  <p class="mb-2"> <i class="fa fa-map-marker mr-2"></i> Jalan Dipatiukur No. 112-116, Coblong, Lebakgede, Bandung.</p>
                  <div class=" d-block d-sm-inline-block">
                      <p class="mb-2">
                          <i class="fa fa-envelope mr-2"></i> carepolerg@gmail.com
                      </p>
                  </div><br>
                  <div class="d-block d-sm-inline-block">
                      <p class="mb-0">
                          <i class="fa fa-phone mr-2"></i>089-630-035-740
                      </p>
                  </div><br>
                  <div class="d-block d-sm-inline-block">
                      <p class="mb-0">
                          <i class="fa fa-facebook mr-2"></i> <a href="https://www.facebook.com/Carepol-System-329297554246776/?ref=br_rs">Facebook</a>
                      </p>
                  </div>

              </div>
              <div class="col-lg-5">
                  <div class="social-icons">
                      <a class="navbar-brand" href="https://play.google.com/store?hl=in">
                      <img src="assets/images/Logo/googleplay.png" class="img-fluid" alt="logo"></a>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- // end .section -->
    <?php
      include('template/footer.php');
    ?>
    <!-- jQuery and Bootstrap -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url() ?>assets/frontend/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="<?= base_url() ?>assets/frontend/js/owl.carousel.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/frontend/js/script.js"></script>
    <script src="<?php echo base_url() ?>assets/js/sweetalert/dist/sweetalert.min.js"></script>

    <?php if ($this->session->userdata('berhasil_order')): ?>
        <script>
           $(function () {
            var data = "<?php echo $this->session->userdata('berhasil_order'); ?>";
             swal("Success order",""+data+"", "success");
            });
        </script>
    <?php $this->session->unset_userdata('berhasil_order');  endif ?>
    <script type="text/javascript">

        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };

       $('#jumlah').bind('change blur', function(){
         var harga = 200000;
          var jumlah = $(this).val();
          var data = $('#total');
          var total = harga * jumlah;
          var gabung = 'Rp. '+ total.format(2, 3, '.', ',');

          if (jumlah == 0 || jumlah < 0 ) {
            data.val('Rp. -');
          }else{
            data.val(gabung);
          }
       });

    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/validation.js"></script>


</body>
</html>
