<?php /* Smarty version 2.6.26, created on 2010-03-08 22:45:05
         compiled from yazar/yazi_yonetimi/ekle.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'yazar/yazi_yonetimi/ekle.tpl', 31, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script src="<?php echo @DIZIN_URL_2; ?>
/js/ckeditor/ckeditor.js" type="text/javascript"></script>
	



<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazı Ekle</h2>
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
	
			<form action="<?php echo @SAYFA_YAZAR_12; ?>
" class="form1" method="post" id="form1">
				
				<p>
					<b>* Kategori:</b><br />
					<select name="kategori_id" title="Yazı kategorisini seçiniz.">
					   <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['kategori_ids'],'output' => $this->_tpl_vars['kategori_names'],'selected' => $this->_tpl_vars['kategori_selected_id']), $this);?>

					</select>
				</p>
				
				<p>
					<b>* Başlık:</b><br />
					<input type="text" name="baslik" size="60" maxlength="255" title="Yazının başlığını yazınız. Ör: Yazı Başlığı" value="<?php echo $this->_tpl_vars['yazi']->baslik; ?>
" />
				</p>
				
				<p>
					<b>* Özet:</b><br />
					<textarea id="ozet" rows="10" cols="60" name="ozet" title="Yazının özetini yazınız. Yazınız uzun değilse|sadece özet alanı yeterlidir. İçerik yazmayınız."><?php echo $this->_tpl_vars['yazi']->ozet; ?>
</textarea>
				</p>
				
				<p>
					<b>İçerik:</b><br />
					<textarea rows="10" cols="60" name="icerik" title="Yazı içeriğini yazınız. Özet ana sayfada|görünen yazıdır. İçerik ise özet ile birlikte|yazının devamını okumak isteyene gösterilir."><?php echo $this->_tpl_vars['yazi']->icerik; ?>
</textarea>
				</p>
				
				<p>
					<b>Etiketler:</b><br />
					<input name="etiketler" size="60" title="Etiketleri aralarında virgül (,) kullanarak ayırınız|Ör: php, mysql, code igniter" value="<?php echo $this->_tpl_vars['etiketler']; ?>
" />
				</p>
		
				<p>
					<input type="submit" value="Ekle" />
				</p>

			</form>
			
		<?php endif; ?>

	</div>

</div>

<?php echo '

<script type="text/javascript">

	CKEDITOR.replace(\'ozet\', {customConfig: \'tr.gen.ci.js\'});
	CKEDITOR.replace(\'icerik\', {customConfig: \'tr.gen.ci.js\'});

	$().ready(function(){
		$(\'#form1\').formtooltip();	
	});
	
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	