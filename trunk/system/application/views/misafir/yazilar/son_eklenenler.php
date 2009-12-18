<?php foreach ($yazilar as $yazi) { ?>

<div class="post">
	<h2 class="title"><?php echo anchor(sprintf(misafir_sayfa_1, $yazi->id), $yazi->baslik) ?></h2>
	<p class="meta">
		<span class="date">
		<?php 
		
			// kategori
			echo $this->lang->line('gui_kategori');
			echo anchor(sprintf(misafir_sayfa_2, $yazi->kategori_id), $yazi->kategori_adi);
			
		?>
		</span>
		
		<span class="posted">
		<?php 
			
			// tarih
			echo $this->lang->line('gui_tarih');
			echo get_kisa_tarih_from_int($yazi->eklenme_zamani);
			
		?>
		</span>
	</p>
	<div class="entry">
		<?php echo $yazi->icerik ?>
		<p class="links"><a href="#">Read More</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Comments</a></p>
	</div>
</div>

<?php } ?>