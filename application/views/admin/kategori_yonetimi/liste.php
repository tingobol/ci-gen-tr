<?php $this->load->view('header1.php') ?>

<script type="text/javascript">
	$().ready(function(){
		$('#tablo').ikontooltip();
	});
</script>

<div class="post">

	<div class="entrytop">
		<div class="entry">
			<h2>Kategori Listesi</h2>
		</div>
	</div>
	
	<div class="post-content">
	
		<table id="tablo" class="tablo">
		
			<thead>
				<tr>
					<th style="width: 1px;">S.</th>
					<th>Adı</th>
					<th style="width: 1px;"></th>
					<th style="width: 1px;"></th>
				</tr>
			</thead>
			
			<tbody>
			
			<?php $i = 0; foreach ($kategoriler as $kategori) { $i++; ?>
			
				<tr>
					<td style="text-align:right;"><?php echo $i ?>.</td>
					<td><?php echo $kategori->adi ?></td>
					<td align="center"><?php echo anchor(sprintf(sayfa_admin_13_1, $kategori->id), img('resimler/ikonlar/duzenle.png'), array('title' => 'Düzenle')) ?></td>
					<td align="center"><?php echo anchor(sprintf(sayfa_admin_14, $kategori->id), img('resimler/ikonlar/sil.png'), array('onclick' => 'return confirm(\'Kategori ve tüm ilişkileri silinecek! Emin misiniz?\');', 'title' => 'Sil')) ?></td>
				</tr>
				
			<?php } ?>
			
			</tbody>
		</table>

	</div>
</div>

<?php $this->load->view('footer1.php') ?>