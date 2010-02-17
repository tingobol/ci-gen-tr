<?php $this->load->view('header1.php') ?>

<div class="post">
	<div class="entrytop">
		<div class="entry">
			<h2>İletişim</h2>
		</div>
	</div>
	
	<div class="post-content">
		<p style="text-align: center;"><?php echo safe_mailto('ci@bulsam.net') ?></p>
	</div>
</div>
		
<?php $this->load->view('footer1.php') ?>