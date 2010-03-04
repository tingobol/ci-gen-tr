<?php

$form1['form'] = array('id' => 'form1');
$form1['hidden'] = array('id' => @$kategori->id);

$form1['adi'] = array(
					'name' => 'adi', 
					'value' => @$kategori->adi, 
					'size' => '30px', 
					'maxlength' => 50, 
					'title' => 'Adını yazınız.|Ör: Kategori Adı');
					
$form1['radi'] = array(
					'name' => 'radi', 
					'value' => @$kategori->radi, 
					'size' => '30px', 
					'maxlength' => 50, 
					'title' => 'Rewrite adını yazınız.|Ör: kategori-adi');
					
$form1['aciklama'] = array(
					'name' => 'aciklama', 
					'value' => @$kategori->aciklama, 
					'size' => '70px', 
					'maxlength' => 255, 
					'title' => 'Meta açıklamasını yazınız.');
					
$form1['arama'] = array(
					'name' => 'arama', 
					'value' => @$kategori->arama, 
					'size' => '70px', 
					'maxlength' => 255, 
					'title' => 'Meta aramasını yazınız.');

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
			<h2>Kategori Düzenle</h2>
		</div>
	</div>
	
	<div class="post-content">
	
		<?php if (isset($hata)) { ?>
		<div class="hata"><?php echo $hata ?></div>
		<?php } elseif (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } ?>
		
		<?php echo form_open(sayfa_admin_13, $form1['form'], $form1['hidden']) ?>
		
	        <p>
	            <label for="name">* Adı:</label>
	            <?php echo form_input($form1['adi']) ?>
	        </p>
			
	        <p>
	            <label for="name">* ReWrite Adı:</label>
	            <?php echo form_input($form1['radi']) ?>
	        </p>

	        <p>
	            <label for="name">Meta Açıklama:</label>
	            <?php echo form_input($form1['aciklama']) ?>
	        </p>
			
	        <p>
	            <label for="name">Meta Arama:</label>
	            <?php echo form_input($form1['arama']) ?>
	        </p>
			
	        <p>
	            <label>&nbsp;</label>
	            <?php echo form_submit($form1['submit1']) ?>
	        </p>
			
		<?php echo form_close() ?>
	</div>
</div>

<?php $this->load->view('footer1.php') ?>