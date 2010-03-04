<?php 

$form1['form'] = array('id' => 'form1');

$form1['mail'] = array(
					'name' => 'mail', 
					'value' => @$kullanici->mail, 
					'size' => '30px', 
					'title' => 'Mail adresinizi yazınız.', );
					
$form1['sifre'] = array('name' => 'sifre', 'title' => 'Şifrenizi yazınız.');

$form1['submit1'] = array('value' => 'Giriş Yap');

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
		
			<h2>Admin Girişi</h2>

		</div>
	</div>
	
	<div class="post-content">
											
		<?php if (isset($hata)) { ?>
		<div class="hata"><?php echo $hata ?></div>
		<?php } ?>
	
		<?php echo form_open(sayfa_admin_1, $form1['form']); ?>
		
	        <p><label>* Mail Adresi: </label><?php echo form_input($form1['mail']) ?></p>
		
	        <p><label>* Şifre: </label><?php echo form_password($form1['sifre']) ?></p>
	        
	        <p><label>&nbsp;</label><?php echo form_submit($form1['submit1']) ?></p>
			
		<?php echo form_close() ?>
	
	</div>
</div>

<?php $this->load->view('footer1.php') ?>