<?php /* Smarty version 2.6.26, created on 2010-03-08 16:25:44
         compiled from yazar/panel/sifreyi_sifirla.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Şifreyi Sıfırla</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		<?php if ($this->_tpl_vars['hata'] != ""): ?>
		<div class="hata"><?php echo $this->_tpl_vars['hata']; ?>
</div> 
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['tamam'] != ""): ?>
		<div class="tamam"><?php echo $this->_tpl_vars['tamam']; ?>
</div> 
		<?php endif; ?>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	