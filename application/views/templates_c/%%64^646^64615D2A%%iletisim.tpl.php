<?php /* Smarty version 2.6.26, created on 2010-03-08 15:50:24
         compiled from misafir/sayfalar/iletisim.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'misafir/sayfalar/iletisim.tpl', 34, false),)), $this); ?>
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
			<h2>İletişim</h2>
		</div>
	</div>
	
	<div class="icerik">

		<?php if ($this->_tpl_vars['tamam'] != ""): ?>
		<div class="tamam"><?php echo $this->_tpl_vars['tamam']; ?>
</div>
		<?php else: ?>
		
			<?php if ($this->_tpl_vars['hata'] != ""): ?>
			<div class="hata"><?php echo $this->_tpl_vars['hata']; ?>
</div> 
			<?php endif; ?>
		
			<form action="<?php echo @SAYFA_MISAFIR_41; ?>
" class="form1" method="post" id="form1">
				
				<p>
					<label for="konu_id">* Konu: </label>
					<select name="konu_id">
					   <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['konu_ids'],'output' => $this->_tpl_vars['konu_names'],'selected' => $this->_tpl_vars['konu_selected_id']), $this);?>

					</select>
				</p>
				
				<p>
					<label for="adi">* Adınız:</label>
					<input type="text" name="adi" size="30" maxlength="255" title="Adınızı yazınız." value="<?php echo $this->_tpl_vars['iletisim_mesaji']->adi; ?>
"></input>
				</p>
				
				<p>
					<label for="mail">* Mail Adresiniz:</label>
					<input type="text" name="mail" size="40" maxlength="255" title="Mail adresinizi yazınız." value="<?php echo $this->_tpl_vars['iletisim_mesaji']->mail; ?>
"></input>
				</p>
				
				<p>
					<label for="mesaj">* Mesajınız:</label>
					<textarea name="mesaj" cols="60" rows="10" title="Mesajınızı yazınız. En kısa zamanda|mesajınız kontrol edilecektir."><?php echo $this->_tpl_vars['iletisim_mesaji']->mesaj; ?>
</textarea>
				</p>
				
				<p>
					<label>&nbsp;</label>
					<input type="submit" value="Gönder"></input>
				</p>
			
			</form>
			
		<?php endif; ?>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	