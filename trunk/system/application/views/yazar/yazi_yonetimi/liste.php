<?php $this->load->view('header1.php') ?>

<script type="text/javascript">
	$().ready(function(){
		$('#tablo').ikontooltip();
	});
</script>

<div class="post">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazı Listesi</h2>
		</div>
	</div>
	
	<div class="post-content">
	
		<?php if (empty($yazilar)) { ?>
			<div class="bilgi">Henüz yazı eklememişsiniz.</div>
		<?php } else { ?>
	
			<table id="tablo" class="tablo">
			
				<thead>
					<tr>
						<th style="width: 1px;">ID</th>
						<th>Başlık</th>
						<th style="width: 1px;">Durum</th>
						<th style="width: 1px;"></th>
						<th style="width: 1px;"></th>
					</tr>
				</thead>
				
				<tbody>
			
				<?php foreach ($yazilar as $yazi) { ?>
				
					<tr>
						<td style="text-align:right;"><?php echo $yazi->id ?>.</td>
						<td><?php echo $yazi->baslik ?></td>
						<td align="center"><?php echo $yazi->durum ?></td>
						<td align="center"><?php echo anchor(sprintf(sayfa_yazar_13_1, $yazi->id), img('resimler/ikonlar/duzenle.png'), array('title' => 'Düzenle')) ?></td>
						<td align="center"><?php echo anchor(sprintf(sayfa_yazar_14, $yazi->id), img('resimler/ikonlar/sil.png'), array('onclick' => 'return confirm(\'Yazı ve tüm ilişkileri silinecek! Emin misiniz?\');', 'title' => 'Sil')) ?></td>
					</tr>
					
				<?php } ?>
					
				
				
				</tbody>
			</table>
		
		<?php } ?>

	</div>
</div>

<?php $this->load->view('footer1.php') ?>