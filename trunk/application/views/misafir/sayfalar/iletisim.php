<?php 

$form1['form'] = array('id' => 'form1');

$form1['adi'] = array(
					'name' => 'adi', 
					'value' => @$iletisim_mesaji->adi, 
					'size' => 30, 
					'maxlength' => 255, 
					'title' => 'Adınızı yazınız.');

$form1['mail'] = array(
					'name' => 'mail', 
					'value' => @$iletisim_mesaji->mail, 
					'size' => 40, 
					'maxlength' => 255, 
					'title' => 'Mail adresinizi yazınız.');
		
$form1['mesaj'] = array(
					'name' => 'mesaj', 
					'value' => @$iletisim_mesaji->mesaj, 
					'rows' => 10, 
					'cols' => 60, 
					'title' => 'Mesajınızı yazınız. En kısa zamanda|mesajınız kontrol edilecektir.');

$form1['submit1'] = array('value' => 'Gönder');

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
			<h2>İletişim</h2>
		</div>
	</div>
	
	<div class="post-content">

		<?php if (isset($tamam)) { ?>
		<div class="bilgi"><?php echo $tamam ?></div>
		<?php } else { ?>
		
			<?php if (isset($hata)) { ?>
			<div class="hata"><?php echo $hata ?></div>
			<?php } ?>
		
			<?php echo form_open(sayfa_misafir_41, $form1['form']); ?>
				
				<p>
					<?php echo form_label('* Konu:', 'iletisim_konu_id') ?>
					<?php echo form_dropdown('iletisim_konu_id', $iletisim_konusu_listesi, $iletisim_mesaji->iletisim_konu_id) ?>
				</p>
				
				<p>
					<?php echo form_label('* Adınız:', 'adi') ?>
					<?php echo form_input($form1['adi']) ?>
				</p>
				
				<p>
					<?php echo form_label('* Mail Adresiniz:', 'mail') ?>
					<?php echo form_input($form1['mail']) ?>
				</p>
				
				<p>
					<?php echo form_label('* Mesajınız:', 'mesaj') ?>
					<?php echo form_textarea($form1['mesaj']) ?>
				</p>
				
				<p>
					<?php echo form_label('&nbsp;') ?>
					<?php echo form_submit($form1['submit1']) ?>
				</p>
			
			<?php echo form_close() ?>
		
		<?php } ?>

	</div>

</div>

<?php $this->load->view('footer1.php') ?>