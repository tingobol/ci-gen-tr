<?php

$form1['form'] = array('id' => 'form1');

$form1['baslik'] = array(
					'name' => 'baslik', 
					'value' => @$yazi->baslik, 
					'size' => '60px', 
					'maxlength' => 255, 
					'title' => 'Yazının başlığını yazınız. Ör: Yazı Başlığı');
					
$form1['rbaslik'] = array(
					'name' => 'rbaslik', 
					'value' => @$yazi->rbaslik, 
					'size' => '60px', 
					'maxlength' => 255, 
					'title' => 'Rewrite yazı başlığını yazınız. Ör: yazi-basligi');
					
$form1['icerik'] = array(
					'name' => 'icerik', 
					'value' => @$yazi->icerik, 
					'rows' => 10, 
					'cols' => 80, 
					'title' => 'Yazı içeriğini yazınız.');
					
$form1['kategori_id'] = array(
					'name' => 'kategori_id', 
					'value' => @$yazi->kategori_id, 
					'size' => '10px', 
					'maxlength' => 3, 
					'title' => 'Yazı kategorisini seçiniz.');

$form1['submit1'] = array('value' => 'Ekle');

?>

<?php $this->load->view('header1.php') ?>

<script type="text/javascript">
	$().ready(function(){
		$('#form1').formtooltip();	
	});
</script>

<div class="post">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazı Ekle</h2>
		</div>
	</div>
	
	<div class="post-content">
	
		<?php if (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } else {  ?>

			<?php if (isset($hata)) { ?>
			<div class="hata"><?php echo $hata ?></div>
			<?php } ?>
			
			<?php echo form_open(sayfa_yazar_12, $form1['form']) ?>
		
				<?php echo form_label('* Başlık', 'baslik') ?><br />
				<?php echo form_input($form1['baslik']) ?><br /><br />
			
				<?php echo form_label('* ReWrite Başlık', 'rbaslik') ?><br />
				<?php echo form_input($form1['rbaslik']) ?><br /><br />

				<?php echo form_label('* İçerik', 'icerik') ?><br />
				<?php echo form_textarea($form1['icerik']) ?><br /><br />
			
				<?php echo form_label('* Kategori', 'kategori_id') ?><br />
				<?php echo form_dropdown('kategori_id', $kategori_listesi, $yazi->kategori_id) ?><br /><br />
			
				<?php echo form_submit($form1['submit1']) ?>
				
			<?php echo form_close() ?>
			
		<?php } ?>

	</div>
</div>

<?php $this->load->view('footer1.php') ?>