<?php 

$form1['form'] = array('id' => 'form1');
					
$form1['eski_sifre'] = array('name' => 'eski_sifre', 'title' => 'Eski şifrenizi yazınız.');
$form1['yeni_sifre'] = array('name' => 'yeni_sifre', 'title' => 'Yeni şifrenizi yazınız.');
$form1['yeni_sifre_tekrar'] = array('name' => 'yeni_sifre_tekrar', 'title' => 'Yeni şifrenizi tekrar yazınız.');

$form1['submit1'] = array('value' => 'Şifre Değiştir');

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
			<h2>Şifre Değiştir</h2>
		</div>
	</div>
	
	<div class="post-content">

		<?php if (isset($tamam)) { ?>
		<div class="bilgi"><?php echo $tamam ?></div>
		<?php } else { ?>
		
			<?php if (isset($hata)) { ?>
			<div class="hata"><?php echo $hata ?></div>
			<?php } ?>
		
			<?php echo form_open(sayfa_yazar_6, $form1['form']); ?>
				
				<p>
					<?php echo form_label('* Eski Şifreniz:', 'eski_sifre') ?>
					<?php echo form_password($form1['eski_sifre']) ?>
				</p>
				
				<p>
					<?php echo form_label('* Yeni Şifreniz:', 'yeni_sifre') ?>
					<?php echo form_password($form1['yeni_sifre']) ?>
				</p>
				
				<p>
					<?php echo form_label('* Yeni Şifreniz (t):', 'yeni_sifre_tekrar') ?>
					<?php echo form_password($form1['yeni_sifre_tekrar']) ?>
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