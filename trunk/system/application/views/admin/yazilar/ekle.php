<?php 

$baslik = array(
	'name'	=> 'baslik', 
	'size'	=> '50px', 
	'value'	=> $yazi->baslik);

$icerik = array(
	'name'	=> 'icerik',
	'id'	=> 'icerik',
	'rows'	=> 8, 
	'cols'	=> 50, 
	'value' => $yazi->icerik);

?>

<div class="post">
	<h2 class="title">Yazı Ekle</h2>
	<div class="entry">
	
		<?php if (isset($hata)) { ?>
		
		<div class="hata">
			<ul>
				<li><?php echo $hata ?></li>
			</ul>
		</div>
		
		<?php } ?>
	
		<?php echo form_open('admin/yazilar/ekle', array('method' => 'post')) ?>
	
		<table>
			<tr>
				<th>* Kategori: </th>
				<td><?php echo form_dropdown('kategori_id', $kategoriler, $yazi->kategori_id) ?></td>
			</tr>
			<tr>
				<th>* Başlık: </th>
				<td><?php echo form_input($baslik) ?></td>
			</tr>
			<tr>
				<th>* İçerik: </th>
				<td><?php echo form_textarea($icerik) ?></td>
			</tr>
			<tr>
				<th></th>
				<td><?php echo form_submit('yazi_ekle', 'Ekle') ?></td>
			</tr>
		</table>
	
		<?php echo form_close() ?>
		
	</div>
</div>