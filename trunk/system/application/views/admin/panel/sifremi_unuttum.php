<?php

$form1['mail'] = array(
					'name' => 'mail', 
					'value' => @$kullanici->mail, 
					'size' => '30px');

$form1['submit1'] = array('value' => 'Gönder');

?>

<div class="post">
	<h2 class="title">Şifremi Unuttum</h2>
	<div class="entry">
	
		<?php if (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } else { ?>
	
			<?php if (isset($hata)) { ?>
			<div class="hata"><?php echo $hata ?></div>
			<?php } ?>
			
			<div class="bilgi">Şifrenizi sıfırlamanız için size mail gönderilecektir.</div>
		
			<?php echo form_open(sayfa_admin_3) ?>
		
			<table>
				<tr>
					<th>* Mail Adresi: </th>
					<td><?php echo form_input($form1['mail']) ?></td>
				</tr>
				<tr>
					<th></th>
					<td><?php echo form_submit($form1['submit1']) ?></td>
				</tr>
			</table>
		
			<?php echo form_close() ?>
			
		<?php } ?>
		
	</div>
</div>