<div class="sidebar" data-background-color="black" data-active-color="info">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <img src="<?= base_url() ?>assets/img/logo/VerWhite_LogoHead.png" alt="" width="70%" height="70%">
                </a>
            </div>

            <ul class="nav">
                <li class="<?php echo isset($active_menu_dashboard)?$active_menu_dashboard:'' ?>">
                    <a href="<?php echo base_url('index.php/adminxdashboard'); ?>">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php echo isset($active_menu_user)?$active_menu_user:'' ?>">
                    <a href="<?php echo base_url('index.php/adminxuser'); ?>">
                        <i class="ti-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <!-- <li class="<?php echo isset($active_menu_category) ? $active_menu_category:'' ?>">
                    <a href="<?php echo base_url('index.php/C_Category'); ?>">
                        <i class="glyphicon glyphicon-th"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="<?php echo isset($active_menu_post) ? $active_menu_post:'' ?>">
                    <a href="<?php echo base_url('index.php/C_Post'); ?>">
                        <i class="glyphicon glyphicon-th"></i>
                        <p>Posts</p>
                    </a>
                </li> -->
                <li class="<?php echo isset($active_menu_area)?$active_menu_area:'' ?>">
                    <a href="<?php echo base_url('index.php/C_Wilayah'); ?>">
                        <i class="glyphicon glyphicon-map-marker"></i>
                        <p>Route</p>
                    </a>
                </li>
				        <li class="<?php echo isset($active_menu_alat)?$active_menu_alat:'' ?>">
                    <a href="<?php echo base_url('index.php/adminxalat'); ?>">
                        <i class="ti-tablet"></i>
                        <p>Device</p>
                    </a>
                </li>

                <li class="<?php echo isset($active_menu_saran)?$active_menu_saran:'' ?>">
                    <a href="<?php echo base_url('index.php/C_Saran'); ?>">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <p>comment <span class="badge badge-danger" id="tempat_jumlah_pesan">0</span></p>
                    </a>
                </li>

                <li class="<?php echo isset($active_menu_order)?$active_menu_order:'' ?>">
                    <a href="<?php echo base_url('index.php/C_Order'); ?>">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <p>Order <span class="badge badge-danger" id="tempat_jumlah_order">0</span></p>
                    </a>
                </li>

				        <li class="<?php echo isset($active_menu_maps) ? $active_menu_maps:'' ?>">
                    <a href="<?php echo base_url('index.php/adminxmaps'); ?>">
                        <i class="ti-map"></i>
                        <p>Map</p>
                    </a>
                </li>
                <li class="<?php echo isset($active_menu_history) ? $active_menu_history:'' ?>">
                    <a href="<?php echo base_url('index.php/adminxdashboard/history'); ?>">
                        <i class="glyphicon glyphicon-time"></i>
                        <p>Device History</p>
                    </a>
                </li>

				<!--<li class="active-pro">
                    <a href="upgrade.html">
                        <i class="ti-export"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>-->
            </ul>
    	</div>
    </div>
