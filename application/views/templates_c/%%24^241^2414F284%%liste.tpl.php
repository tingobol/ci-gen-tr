<?php /* Smarty version 2.6.26, created on 2010-03-07 21:32:23
         compiled from misafir/yazilar/liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sprintf', 'misafir/yazilar/liste.tpl', 26, false),array('modifier', 'date_format', 'misafir/yazilar/liste.tpl', 41, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['yazilar'] == ""): ?>

	<div class="post">
		<div class="entrytop">
			<div class="entry">
				<h2>Yazı Bulunmadı</h2>
			</div>
		</div>
		
		<div class="post-content">
			<div class="bilgi">Yazı bulunamadı.</div>
		</div>
	</div>

<?php else: ?>

	<?php $_from = $this->_tpl_vars['yazilar']->result(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['yazi']):
?>
	
		<div class="yazi_ozet">
		
			<div class="entrytop">
				<div class="entry">
				
					<h2><a href="<?php echo ((is_array($_tmp=@SAYFA_MISAFIR_23)) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['yazi']->id) : sprintf($_tmp, $this->_tpl_vars['yazi']->id)); ?>
" rel="bookmark"><?php echo $this->_tpl_vars['yazi']->baslik; ?>
</a></h2>
		
				</div>
			</div>			
			
			<div class="post-content">
			
				<?php echo $this->_tpl_vars['yazi']->ozet; ?>

			
			</div>
			
			<div class="alt_bilgi">
				<span class="devami"><a href="<?php echo ((is_array($_tmp=@SAYFA_MISAFIR_23)) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['yazi']->id) : sprintf($_tmp, $this->_tpl_vars['yazi']->id)); ?>
">Devamı</a></span>
				<span class="kategori"><a href="<?php echo @DIZIN_URL_21; ?>
/<?php echo $this->_tpl_vars['yazi']->kategori_id; ?>
"><?php echo $this->_tpl_vars['yazi']->kategori_adi; ?>
</a></span>
				<span class="hit">Okunma: <?php echo $this->_tpl_vars['yazi']->hit; ?>
</span>
				<span class="tarih"><?php echo ((is_array($_tmp=$this->_tpl_vars['yazi']->eklenme_zamani)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e.%m.%Y") : smarty_modifier_date_format($_tmp, "%e.%m.%Y")); ?>
</span>
			</div>

		</div>
		
	<?php endforeach; endif; unset($_from); ?>

		<div class="navigation">
			<span class="previous-entries"> 
				 
				<?php if ($this->_tpl_vars['sayfalama_lib']->is_eski_kayit_var()): ?> 
					<a href="<?php echo @DIZIN_URL_12; ?>
/<?php echo $this->_tpl_vars['sayfalama_lib']->get_eski_sayfa(); ?>
">Eski Yazılar</a>
				<?php endif; ?>
				
			</span>
			<span class="next-entries">
			
				<?php if ($this->_tpl_vars['sayfalama_lib']->is_yeni_kayit_var()): ?> 
					<a href="<?php echo @DIZIN_URL_12; ?>
/<?php echo $this->_tpl_vars['sayfalama_lib']->get_yeni_sayfa(); ?>
">Yeni Yazılar</a>
				<?php endif; ?>
				
			</span>
		</div>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>