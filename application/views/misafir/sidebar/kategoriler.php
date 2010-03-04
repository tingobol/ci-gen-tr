<li>
	<h2><?php echo $this->lang->line('gui_kategoriler') ?></h2>
	<ul>
	
		<?php foreach ($kategoriler as $kategori) { ?>
		
		<li><?php echo anchor(sprintf(misafir_sayfa_2, $kategori->id), $kategori->adi) ?></li>
		
		<?php }  ?>
	
	</ul>
</li>