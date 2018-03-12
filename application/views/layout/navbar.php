<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <p class="navbar-brand"><?php echo isset ($title_page)?$title_page:'' ?></p>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-user"></i>
                									<p><?php echo $this->session->userdata('username');?></p>
                									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <!--<li><a href="#">Akun</a></li>-->
                                <li><a href="<?php echo site_url('login/logout'); ?>">Logout</a></li>
                              </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
