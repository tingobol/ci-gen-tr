<?php

$form1['form'] = array('id' => 'form1');

$form1['adi'] = array(
					'name' => 'adi', 
					'value' => @$kullanici->adi, 
					'size' => '30px', 
					'maxlength' => 50, 
					'title' => 'Adını yazınız.');
					
$form1['mail'] = array(
					'name' => 'mail', 
					'value' => @$kullanici->mail, 
					'size' => '30px', 
					'maxlength' => 50, 
					'title' => 'Mail adresinizi yazınız.|Yazarlığınız onaylandığında|bu mail adresine bilgiler gönderilecek.');
					
$form1['favori_konulari'] = array(
					'name' => 'favori_konulari', 
					'value' => @$kullanici->favori_konulari, 
					'rows' => 6,
					'cols' => 80, 
					'title' => 'Favori konularınızı yazınız.|Ör: PHP, Code Igniter, vs.');
					
$form1['referanslari'] = array(
					'name' => 'referanslari', 
					'value' => @$kullanici->referanslari, 
					'rows' => 6,
					'cols' => 80, 
					'title' => 'Referanslarınızı yazınız. Yazarlığınızın onaylanmasında|rol oynayacaktır. Yaptığınız projelerden ve makalelerinizden|bahsedebilirsiniz.');

$form1['submit1'] = array('value' => 'Başvuru Yap');

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
			<h2>Yazarlık Başvurusu</h2>
		</div>
	</div>
	
	<div class="post-content">
	
		<?php if (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } else {  ?>

			<?php if (isset($hata)) { ?>
			<div class="hata"><?php echo $hata ?></div>
			<?php } ?>
			
			<?php echo form_open(sayfa_yazar_5, $form1['form']) ?>
			
				<?php echo form_label('* Adınız', 'adi') ?><br />
				<?php echo form_input($form1['adi']) ?><br /><br />
				
				<?php echo form_label('* Mail Adresiniz', 'mail') ?><br />
				<?php echo form_input($form1['mail']) ?><br /><br />
				
				<?php echo form_label('* Favori Konularınız', 'favori_konulari') ?><br />
				<?php echo form_textarea($form1['favori_konulari']) ?><br /><br />
				
				<?php echo form_label('* Referanslarınız', 'referanslari') ?><br />
				<?php echo form_textarea($form1['referanslari']) ?><br /><br />
	
				<?php echo form_submit($form1['submit1']) ?>
				
			<?php echo form_close() ?>
			
		<?php } ?>
		
	</div>
</div>

<?php $this->load->view('footer1.php') ?>