<?php /* Smarty version 2.6.26, created on 2010-03-08 16:25:35
         compiled from yazar/panel/mailler/sifreyi_sifirla.tpl */ ?>
<?php echo '
<style>

body, p {
	font-family: Arial;
	font-size:13px;
	line-height:20px;
}

</style>
'; ?>


<p>Merhaba <b><?php echo $this->_tpl_vars['kullanici']->adi; ?>
</b></p>

<p>Yeni giriş bilgileriniz aşağıdaki gibidir:</p>
<p>
Mail Adresi: <?php echo $this->_tpl_vars['kullanici']->mail; ?>
<br />
Şifre: <?php echo $this->_tpl_vars['temp_sifre']; ?>

</p>

<p>Sisteme giriş yapmak için: </p>
<p><a href="<?php echo $this->_tpl_vars['url1']; ?>
"><?php echo $this->_tpl_vars['url1']; ?>
</a></p>