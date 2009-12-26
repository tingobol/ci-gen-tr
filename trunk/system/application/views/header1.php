<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		
		<title><?php echo @$meta_baslik ?></title>
	
		<meta name="description" content="<?php echo @$meta_aciklama ?>" />
		<meta name="keywords" content="<?php echo @$meta_arama ?>" />
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/style.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/form.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/eburhan.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/jquery.form.tooltip.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/tablo.css') ?>" />
		
		<script type="text/javascript" src="<?php echo site_url('js/jquery.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('js/jquery.form.tooltip.js') ?>"></script>

	</head>

	<body>

		<!-- header -->

		<div id="header">
			<div id="headerimg">
				<h1><a href="#">Code Igniter Türkiye</a></h1>
				<div class="description">paylaşım platformu</div>
				
				<div id="search">
					<form method="get" id="searchform" action="http://www.justskins.com/"> 
						<div>
							<input type="text" value="" name="s" id="s" /> 
							<input type="submit" id="searchsubmit" value="" />
						</div>
					</form>
				</div>
			</div>
		
			<div id="navi">
		
				<ul id="nav">
				
					<?php if (@$k_t == k_t_giris_yapacak_admin) { // admin giriş yapmak isterse ?>
						<li class="page_item"><?php echo anchor(sayfa_admin_1, 'Admin Girişi') ?></li>
						<li class="page_item"><?php echo anchor(sayfa_admin_3, 'Şifremi Unuttum') ?></li>					
					<?php } elseif (@$k_t == k_t_giris_yapmis_admin) { // admin giriş yaptıysa ?>
						<li class="page_item"><?php echo anchor(sayfa_admin_2, 'Panel') ?></li>
						<li class="page_item"><?php echo anchor(sayfa_admin_4, 'Çıkış') ?></li>
					<?php } else { // diğer durumlarda ?>
						<li class="page_item"><a href="#" title="Home">Admin Girişi</a></li>
						<li class="page_item"><a href="#" title="Home">Şifremi Unuttum</a></li>
					<?php } ?>
		
				</ul>
		
			</div>
		</div>
		
		<!-- / header -->

<!-- wrapper -->

<div id="wrapper">

	<!-- page -->

	<div id="page">
		
		<!-- content -->
		
		<div id="content">