<?php /* Smarty version 2.6.26, created on 2010-03-08 22:45:36
         compiled from yazar/yazi_yonetimi/liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sprintf', 'yazar/yazi_yonetimi/liste.tpl', 45, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
	$().ready(function(){
		$(\'#tablo\').ikontooltip();
	});
</script>
'; ?>


<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazı Listesi</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		<?php if ($this->_tpl_vars['yazilar'] == ""): ?> 
		<div class="bilgi">Henüz yazı eklememişsiniz.</div>
		<?php else: ?>

			<table id="tablo" class="tablo">
			
				<thead>
					<tr>
						<th style="width: 1px;">ID</th>
						<th>Başlık</th>
						<th style="width: 1px;">Durum</th>
						<th style="width: 1px;"></th>
						<th style="width: 1px;"></th>
					</tr>
				</thead>
				
				<tbody>

				<?php $_from = $this->_tpl_vars['yazilar']->result(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['yazi']):
?>

					<tr>
						<td style="text-align:right;"><?php echo $this->_tpl_vars['yazi']->id; ?>
.</td>
						<td><?php echo $this->_tpl_vars['yazi']->baslik; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['yazi']->durum; ?>
</td>
						<td align="center"><a href="<?php echo ((is_array($_tmp=@SAYFA_YAZAR_13_1)) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['yazi']->id) : sprintf($_tmp, $this->_tpl_vars['yazi']->id)); ?>
" title="Düzenle"><img src="<?php echo @DIZIN_URL_3; ?>
/duzenle.png" /></a></td>
						<td align="center"><a href="<?php echo ((is_array($_tmp=@SAYFA_YAZAR_14)) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['yazi']->id) : sprintf($_tmp, $this->_tpl_vars['yazi']->id)); ?>
" title="Sil" onclick="Yazı ve tüm ilişkili bilgileri silinecek! Emin misiniz?"><img src="<?php echo @DIZIN_URL_3; ?>
/sil.png" /></a></td>
					</tr>
					
				<?php endforeach; endif; unset($_from); ?>

				</tbody>
			</table>

		<?php endif; ?>

	</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	