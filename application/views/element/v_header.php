<!DOCTYPE html>
<html lang="en" class="fixed"> 
 
<head>
<!-- Basic -->
<meta charset="utf-8"/>

<title><?php echo $title?></title>  
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="Inventory system pt indepay indonesia" name="description"/>
<meta content="PT Indepay Indonesia" name="author"/>  

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />

<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/magnific-popup/magnific-popup.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-datepicker/css/datepicker3.css')?>" /> 

<link rel="stylesheet" href="<?php echo base_url('assets/chosen.css')?>">
<script src="<?php echo base_url('assets/jquery.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>/>
<script src="<?php echo base_url('assets/chosen.jquery.js');?>"></script>
 
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')?>" /> 
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/select2.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" /> 
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/dropzone/css/basic.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/dropzone/css/dropzone.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/summernote/summernote.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/summernote/summernote-bs3.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/codemirror/lib/codemirror.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/codemirror/theme/monokai.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')?>" />
		
   
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')?>" /> 
<link rel="stylesheet" href="<?php echo base_url('assets/vendor/pnotify/pnotify.custom.css')?>" /> 

<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme.css')?>" />

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/skins/default.css')?>" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme-custom.css')?>">
 
<!-- Head Libs -->
<script src="<?php echo base_url('assets/vendor/modernizr/modernizr.js')?>"></script> 
   
<script type="text/javascript">
        $(function(){
            $('.chzn-select').chosen();
            $('.chzn-select-deselect').chosen({allow_single_deselect:true});
        });

</script>   
   
</head>

<body  class="loading-overlay-showing" data-loading-overlay>
		<div class="loading-overlay dark">
			<div class="loader white"></div>
		</div>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="<?php echo base_url('assets/images/logo.png')?>" height="35" alt="Logo" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			 
             		<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo base_url('assets/images/!logged-user.jpg')?>" alt="Foto" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg">
							</figure>
							<div class="profile-info">
								<span class="name"><?php echo $this->session->userdata('NAME'); ?></span>
								<span class="role"><?php echo $this->session->userdata('LEVEL'); ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<!--<a role="menuitem" tabindex="-1" href="<?php echo site_url('user')?>/<?php echo $this->session->userdata('ID'); ?>"><i class="fa fa-user"></i> My Profile</a>-->
								</li> 
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo site_url('login/logout')?>"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
					
                    <!--========================= Header + Navbar ==============================--> 
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-<?php if(isset($active_dashboard)){echo $active_dashboard ;}?>">
										<a href="<?php echo site_url('dashboard')?>">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
                                    <?php if ($this->session->userdata('LEVEL') <> 'sales') { ?>
									<li class="nav-<?php if(isset($active_item_in)){echo $active_item_in ;}?>">
										<a href="<?php echo site_url('item_in')?>">
											<span class="pull-right label label-primary"><?php echo $jumlah_item_in ; ?></span>
											<i class="fa fa-inbox" aria-hidden="true"></i>
											<span>Item In</span>
										</a>
									</li>
									<li class="nav-<?php if(isset($active_item_out)){echo $active_item_out ;}?>">
										<a href="<?php echo site_url('item_out')?>">
											<span class="pull-right label label-primary"><?php echo $jumlah_item_out ; ?></span>
											<i class="fa fa-send" aria-hidden="true"></i>
											<span>Item Out</span>
										</a>
									</li>
									<li class="nav-<?php if(isset($active_item_list)){echo $active_item_list ;}?>">
										<a href="<?php echo site_url('item_list')?>">
											<span class="pull-right label label-primary"><?php echo $jumlah_item ; ?></span>
											<i class="fa fa-list" aria-hidden="true"></i>
											<span>Item List</span>
										</a>
									</li>
                                    <?php } ?>
									<li class="nav-<?php if(isset($active_agen)){echo $active_agen ;}?>">
										<a href="<?php echo site_url('agen_list')?>">
											<span class="pull-right label label-primary"><?php echo $jumlah_agen ; ?></span>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Agent List</span>
										</a>
									</li>
									<li class="nav-<?php if(isset($active_master_data)){echo $active_master_data ;}?>">
										<a href="<?php echo site_url('master_data')?>">
											<span class="pull-right label label-primary"></span>
											<i class="fa fa-connectdevelop" aria-hidden="true"></i>
											<span>Master Data</span>
										</a> 
									</li> 
								</ul>
							</nav>
						</div>
					</div> 
                    
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">  
					</header>

				

