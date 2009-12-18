<style>

body, p {
	font-family: Arial;
	font-size:13px;
	line-height:20px;
}

</style>

<p>Merhaba <b><?php echo $kullanici->adi ?></b></p>

<p>Yeni giriş bilgileriniz aşağıdaki gibidir:</p>
<p>
Mail Adresi: <?php echo $kullanici->mail ?><br />
Şifre: <?php echo $temp_sifre ?>
</p>

<p>Sisteme giriş yapmak için: </p>
<p><a href="<?php echo $url1 ?>"><?php echo $url1 ?></a></p>