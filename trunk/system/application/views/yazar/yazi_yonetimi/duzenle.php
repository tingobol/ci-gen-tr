<?php

$form1['form'] = array('id' => 'form1');
$form1['hidden'] = array('id' => @$yazi->id);

$form1['baslik'] = array(
					'name' => 'baslik', 
					'value' => @$yazi->baslik, 
					'size' => 60, 
					'maxlength' => 255, 
					'title' => 'Yazının başlığını yazınız. Ör: Yazı Başlığı');
					
$form1['ozet'] = array(
					'name' => 'ozet', 
					'value' => @$yazi->ozet, 
					'rows' => 10, 
					'cols' => 60, 
					'title' => 'Yazının özetini yazınız. Yazınız uzun değilse|sadece özet alanı yeterlidir. İçerik yazmayınız.');
					
$form1['icerik'] = array(
					'name' => 'icerik', 
					'value' => @$yazi->icerik, 
					'rows' => 10, 
					'cols' => 60, 
					'title' => 'Yazı içeriğini yazınız. Özet ana sayfada|görünen yazıdır. İçerik ise özet ile birlikte|yazının devamını okumak isteyene gösterilir.');
					
$form1['kategori_id'] = array(
					'name' => 'kategori_id', 
					'value' => @$yazi->kategori_id, 
					'size' => 10, 
					'maxlength' => 3, 
					'title' => 'Yazı kategorisini seçiniz.');

$form1['submit1'] = array('value' => 'Kaydet');

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
			<h2>Yazı Düzenle</h2>
		</div>
	</div>
	
	<div class="post-content">
	
		<?php if (isset($hata)) { ?>
		<div class="hata"><?php echo $hata ?></div>
		<?php } elseif (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } ?>
		
		<div class="bilgi">Özet ve İçerik yazarken HTML kullanabilirsiniz.</div>
		
		<?php echo form_open(sayfa_yazar_13, $form1['form'], $form1['hidden']) ?>
	
		<p>
			<?php echo form_label('* Başlık', 'baslik') ?>
			<?php echo form_input($form1['baslik']) ?>
		</p>
		
		<p>
			<?php echo form_label('* Özet', 'ozet') ?>
			<?php echo form_textarea($form1['ozet']) ?>
		</p>
		
		<p>
			<?php echo form_label('* İçerik', 'icerik') ?>
			<?php echo form_textarea($form1['icerik']) ?>
		</p>
		
		<p>
			<?php echo form_label('* Kategori', 'kategori_id') ?>
			<?php echo form_dropdown('kategori_id', $kategori_listesi, $yazi->kategori_id) ?>
		</p>
		
		<p>
			<?php echo form_label('&nbsp;') ?>
			<?php echo form_submit($form1['submit1']) ?>
		</p>
			
		<?php echo form_close() ?>
	</div>
</div>

<?php $this->load->view('footer1.php') ?>