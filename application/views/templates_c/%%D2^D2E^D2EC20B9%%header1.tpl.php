<?php /* Smarty version 2.6.26, created on 2010-03-08 17:59:58
         compiled from header1.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		
		<title><?php echo $this->_tpl_vars['meta_baslik']; ?>
</title>
	
		<meta name="description" content="<?php echo $this->_tpl_vars['meta_aciklama']; ?>
" />
		<meta name="keywords" content="<?php echo $this->_tpl_vars['meta_arama']; ?>
" />
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link type="text/css" rel="stylesheet" href="<?php echo @DIZIN_URL_2; ?>
/css/style.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo @DIZIN_URL_2; ?>
/css/form.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo @DIZIN_URL_2; ?>
/css/eburhan.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo @DIZIN_URL_2; ?>
/css/jquery.form.tooltip.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo @DIZIN_URL_2; ?>
/css/tablo.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo @DIZIN_URL_2; ?>
/css/site.css" />
		
		<script type="text/javascript" src="<?php echo @DIZIN_URL_2; ?>
/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo @DIZIN_URL_2; ?>
/js/jquery.form.tooltip.js"></script>

	</head>

	<body>

		<!-- header -->

		<div id="header">
			<div id="headerimg">
				<h1><a href="#">Code Igniter Türkiye</a></h1>
				<div class="description">paylaşım platformu</div>
				
				<div id="search">
					<form method="get" id="searchform" action="#"> 
						<div>
							<input type="text" value="" name="s" id="s" /> 
							<input type="submit" id="searchsubmit" value="" />
						</div>
					</form>
				</div>
			</div>
		
			<div id="navi">
		
				<ul id="nav">
				
					<?php if ($this->_tpl_vars['k_t'] == @SABIT_GIRIS_YAPACAK_ADMIN): ?> 
						<li class="page_item"><a href="<?php echo @SAYFA_ADMIN_1; ?>
">Admin Girişi</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_ADMIN_2; ?>
">Şifremi Unuttum</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
					<?php elseif ($this->_tpl_vars['k_t'] == @SABIT_GIRIS_YAPMIS_ADMIN): ?>
						<li class="page_item"><a href="<?php echo @SAYFA_ADMIN_0; ?>
">Panel</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_ADMIN_3; ?>
">Çıkış</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
					<?php elseif ($this->_tpl_vars['k_t'] == @SABIT_GIRIS_YAPACAK_EDITOR): ?>
						<li class="page_item"><a href="<?php echo @SAYFA_EDITOR_1; ?>
">Editör Girişi</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_EDITOR_2; ?>
">Şifremi Unuttum</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_EDITOR_5; ?>
">Editörlük Başvurusu</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
					<?php elseif ($this->_tpl_vars['k_t'] == @SABIT_GIRIS_YAPMIS_EDITOR): ?>
						<li class="page_item"><a href="<?php echo @SAYFA_EDITOR_0; ?>
">Panel</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_EDITOR_3; ?>
">Çıkış</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
					<?php elseif ($this->_tpl_vars['k_t'] == @SABIT_GIRIS_YAPACAK_YAZAR): ?>
						<li class="page_item"><a href="<?php echo @SAYFA_YAZAR_1; ?>
">Yazar Girişi</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_YAZAR_2; ?>
">Şifremi Unuttum</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_YAZAR_5; ?>
">Yazarlık Başvurusu</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
					<?php elseif ($this->_tpl_vars['k_t'] == @SABIT_GIRIS_YAPMIS_YAZAR): ?>
						<li class="page_item"><a href="<?php echo @SAYFA_YAZAR_0; ?>
">Panel</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_YAZAR_6; ?>
">Şifre Değiştir</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_YAZAR_3; ?>
">Çıkış</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
					<?php else: ?>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_0; ?>
">Ana Sayfa</a></li>
						<li class="page_item"><a href="<?php echo @SAYFA_MISAFIR_41; ?>
">İletişim</a></li>
					<?php endif; ?>
		
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