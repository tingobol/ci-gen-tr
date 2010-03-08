<?php /* Smarty version 2.6.26, created on 2010-03-08 17:59:58
         compiled from yazar/panel/giris.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
	$().ready(function(){
		$(\'#form1\').formtooltip();	
	});
</script>
'; ?>


<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazar Girişi</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		<?php if ($this->_tpl_vars['hata'] != ""): ?>
		<div class="hata"><?php echo $this->_tpl_vars['hata']; ?>
</div> 
		<?php endif; ?>
	
		<form action="<?php echo @SAYFA_YAZAR_1; ?>
" class="form1" method="post" id="form1">
			
			<p>
				<label for="mail">* Mail Adresiniz:</label>
				<input type="text" name="mail" size="40" maxlength="255" title="Mail adresinizi yazınız." value="<?php echo $this->_tpl_vars['kullanici']->mail; ?>
"></input>
			</p>
			
			<p>
				<label for="mail">* Şifre:</label>
				<input type="password" name="sifre" size="30" title="Şifrenizi yazınız."></input>
			</p>

			<p>
				<label>&nbsp;</label>
				<input type="submit" value="Giriş Yap"></input>
			</p>
		
		</form>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	