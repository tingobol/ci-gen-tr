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
		
			<h2><span class="inpost-date">August 7th, 2009</span><a href="http://www.justskins.com/development/7-web-design-tutorials-from-psd-to-htmlcss/2262" rel="bookmark" title="Permanent Link to 7 Web Design Tutorials from PSD to HTML/CSS">Admin Girişi</a></h2>

		</div>
	</div>
	
	<div class="post-content">
											
		<?php if (isset($hata)) { ?>
		<div class="hata"><?php echo $hata ?></div>
		<?php } ?>
	
		<?php echo form_open(sayfa_admin_1, $form1['form']); ?>
		
	        <p>
	            <label for="name">* Mail Adresi:</label>
	            <?php echo form_input($form1['mail']) ?>
	        </p>
		
	        <p>
	            <label for="name">* Şifre:</label>
	            <?php echo form_password($form1['sifre']) ?>
	        </p>
			
	        <p>
	            <label>&nbsp;</label>
	            <?php echo form_submit($form1['submit1']) ?>
	        </p>
		
		<?php echo form_close() ?>
	
	</div>
	
	<div class="post-info">
			<span class="post-cat"><a href="http://www.justskins.com/themes/development" title="View all posts in Development" rel="category tag">Development</a></span> <span class="post-comments"><a href="http://www.justskins.com/development/7-web-design-tutorials-from-psd-to-htmlcss/2262#comments" title="Comment on 7 Web Design Tutorials from PSD to HTML/CSS">1 Comment &#187;</a></span>
	
	</div>
</div>

<?php $this->load->view('footer1.php') ?>