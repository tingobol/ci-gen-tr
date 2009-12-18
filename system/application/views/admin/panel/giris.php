<?php 

$mail = array(
	'name'	=> 'mail', 
	'size'	=> '30px', 
	'value'	=> $kullanici->mail);

$sifre = array(
	'name'	=> 'sifre');
	
$submit = array('value' => 'Giriş Yap');

?>

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
	
		<?php echo form_open(sayfa_admin_1); ?>
		
		<table class="form">
			<tr>
				<th>* Mail Adresi</th>
				<td><?php echo form_input($mail) ?></td>
			</tr>
			<tr>
				<th>* Şifre</th>
				<td><?php echo form_password($sifre) ?></td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><?php echo form_submit($submit) ?></td>
			</tr>
		</table>
		
		<?php echo form_close() ?>
	</div>
	
	<div class="post-info">
			<span class="post-cat"><a href="http://www.justskins.com/themes/development" title="View all posts in Development" rel="category tag">Development</a></span> <span class="post-comments"><a href="http://www.justskins.com/development/7-web-design-tutorials-from-psd-to-htmlcss/2262#comments" title="Comment on 7 Web Design Tutorials from PSD to HTML/CSS">1 Comment &#187;</a></span>
	
	</div>
</div>