<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <img src="<?= base_url() ?>assets/img/logo/VerWhite_LogoHead.png" alt="">
                </a>
            </div>

            <ul class="nav">
                <li class="<?php echo isset($active_menu_dashboard)?$active_menu_dashboard:'' ?>">
                    <a href="<?php echo base_url('index.php/user/dashboard'); ?>">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php echo isset($active_menu_user)?$active_menu_user:'' ?>">
                    <a href="<?php echo base_url('index.php/user'); ?>">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
				<li class="<?php echo isset($active_menu_maps)?$active_menu_maps:'' ?>">
                    <a href="<?php echo base_url('index.php/user/mapsuhu'); ?>">
                        <i class="ti-map"></i>
                        <p>Map</p>
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
