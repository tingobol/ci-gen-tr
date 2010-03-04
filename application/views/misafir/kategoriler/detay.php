<?php foreach ($yazilar as $yazi) { ?>

<div class="post">
	<h2 class="title"><?php echo anchor(sprintf(misafir_sayfa_1, $yazi->id), $yazi->baslik) ?></h2>
	<p class="meta">
	<?php 
	
		// kategori
		echo $this->lang->line('gui_kategori');
		echo anchor(sprintf(misafir_sayfa_2, $yazi->kategori_id), $yazi->kategori_adi);
		
		echo ', ';
		
		// tarih
		echo $this->lang->line('gui_tarih');
		echo get_kisa_tarih_from_int($yazi->eklenme_zamani); 
	?>
	<div class="entry">
		<?php echo $yazi->icerik ?>
		<p class="linkler">Yorum: 32, Hit: 12</p>
	</div>
</div>

<?php } ?>