<?php $this->load->view('header1.php') ?>

<?php if (empty($yazilar)) { ?>
		<div class="post">
			<div class="entrytop">
				<div class="entry">
					<h2>Yazı Bulunmadı</h2>
				</div>
			</div>
			
			<div class="post-content">
				<div class="bilgi">Yazı bulunamadı.</div>
			</div>
		</div>
<?php } else { ?>

	<?php foreach ($yazilar as $yazi) { ?>
		<div class="post">
			<div class="entrytop">
				<div class="entry">
				
					<h2><span class="inpost-date"><?php echo mdate('%d/%m/%Y - %h:%i %a', $yazi->eklenme_zamani) ?></span><a href="<?php echo site_url(sprintf(sayfa_misafir_23, $yazi->id)) ?>" rel="bookmark"><?php echo $yazi->baslik ?></a></h2>
		
				</div>
			</div>
			
			<div class="post-content">
			
				<?php echo $yazi->ozet ?>
				<?php echo $yazi->icerik ?>
			
			</div>
			
			<!--
			<div class="post-info">
					<span class="post-cat"><a href="http://www.justskins.com/themes/development" title="View all posts in Development" rel="category tag">Development</a></span> <span class="post-comments"><a href="http://www.justskins.com/development/7-web-design-tutorials-from-psd-to-htmlcss/2262#comments" title="Comment on 7 Web Design Tutorials from PSD to HTML/CSS">1 Comment &#187;</a></span>
			
			</div>-->
		</div>
		
	<?php } ?>

		<div class="navigation">
			<span class="previous-entries"> 
			<?php 
			
				if ($eski_yazilar_varmi) {
					echo anchor(sprintf(sayfa_misafir_32, $kategori_id, $sayfa + 1), 'Eski Yazılar');
				}
			
			 ?>
			</span>
			<span class="next-entries">
			<?php 
			
				if ($yeni_yazilar_varmi) {
					echo anchor(sprintf(sayfa_misafir_32, $kategori_id, $sayfa - 1), 'Yeni Yazılar');
				}
			
			 ?>
			</span>
		</div>

<?php } ?>

<?php $this->load->view('footer1.php') ?>