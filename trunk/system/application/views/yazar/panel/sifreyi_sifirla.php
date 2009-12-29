<?php $this->load->view('header1.php') ?>

<div class="post">

	<div class="entrytop">
		<div class="entry">
			<h2>Şifreyi Sıfırla</h2>
		</div>
	</div>
	
	<div class="post-content">
		<?php if (isset($hata)) { ?>
		<div class="hata"><?php echo $hata ?></div>
		<?php } ?>
		
		<?php if (isset($tamam)) { ?>
		<div class="tamam"><?php echo $tamam ?></div>
		<?php } ?>
	</div>
</div>

<?php $this->load->view('footer1.php') ?>