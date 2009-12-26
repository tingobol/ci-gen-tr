<?php

$form1['form'] = array('id' => 'form1');

$form1['mail'] = array(
					'name' => 'mail', 
					'value' => @$kullanici->mail, 
					'size' => '30px', 
					'title' => 'Mail adresinizi yazınız.');

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
			<h2>Şifremi Unuttum</h2>
		</div>
	</div>
	
	<div class="post-content">
		<?php if (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } else { ?>
	
			<?php if (isset($hata)) { ?>
			<div class="hata"><?php echo $hata ?></div>
			<?php } ?>
			
			<div class="bilgi">Şifrenizi sıfırlamanız için size mail gönderilecektir.</div>
		
			<?php echo form_open(sayfa_admin_3, $form1['form']) ?>
		
	        <p>
	            <label for="name">* Mail Adresi:</label>
	            <?php echo form_input($form1['mail']) ?>
	        </p>
			
	        <p>
	            <label>&nbsp;</label>
	            <?php echo form_submit($form1['submit1']) ?>
	        </p>
		
			<?php echo form_close() ?>
			
		<?php } ?>
	</div>
</div>

<?php $this->load->view('footer1.php') ?>