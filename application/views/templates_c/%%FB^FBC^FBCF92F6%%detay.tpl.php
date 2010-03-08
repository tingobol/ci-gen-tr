<?php /* Smarty version 2.6.26, created on 2010-03-08 15:47:22
         compiled from misafir/yazilar/detay.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'misafir/yazilar/detay.tpl', 23, false),array('modifier', 'sprintf', 'misafir/yazilar/detay.tpl', 30, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
<div class="yazi">

	<div class="entrytop">
		<div class="entry">
		
			<h2><?php echo $this->_tpl_vars['yazi']->baslik; ?>
</h2>

		</div>
	</div>			
	
	<div class="post-content">
	
		<?php echo $this->_tpl_vars['yazi']->ozet; ?>

		<?php echo $this->_tpl_vars['yazi']->icerik; ?>

	
	</div>
	
	<div class="alt_bilgi">
	
		<span class="kategori">Kategori: <a href="<?php echo @DIZIN_URL_21; ?>
/<?php echo $this->_tpl_vars['yazi']->kategori_id; ?>
"><?php echo $this->_tpl_vars['yazi']->kategori_adi; ?>
</a></span>
		<span class="tarih">Eklenme: <?php echo ((is_array($_tmp=$this->_tpl_vars['yazi']->eklenme_zamani)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e.%m.%Y") : smarty_modifier_date_format($_tmp, "%e.%m.%Y")); ?>
</span>
		<?php if ($this->_tpl_vars['yazi']->eklenme_zamani < $this->_tpl_vars['yazi']->guncellenme_zamani): ?> 
		<span class="tarih">Güncellenme: <?php echo ((is_array($_tmp=$this->_tpl_vars['yazi']->guncellenme_zamani)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e.%m.%Y") : smarty_modifier_date_format($_tmp, "%e.%m.%Y")); ?>
</span>
		<?php endif; ?>
		<span class="hit">Okunma: <?php echo $this->_tpl_vars['yazi']->hit; ?>
</span>
		<span class="taglar">Etiketler: 
		<?php $_from = $this->_tpl_vars['yazi_etiketleri']->result(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['yazi_etiketi']):
?>
			<a href="<?php echo ((is_array($_tmp=@SAYFA_MISAFIR_51)) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['yazi_etiketi']->id) : sprintf($_tmp, $this->_tpl_vars['yazi_etiketi']->id)); ?>
"><?php echo $this->_tpl_vars['yazi_etiketi']->adi; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
		</span>
		
	</div>
	
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>